<?php

namespace App\Http\Controllers\Index;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Index\NewsletterRequest;
use App\Posts\Newsletter;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    /**
     * The total number of months.
     */
	protected $nbOfMonths;
	
	protected $currentPage;
    
    /**
     * Calls the auth middleware prevent a non-auth user to access
     */
	public function __construct()
    {
    	$this->middleware('auth');
    	
    	// Set total number of pages to manage the "next / previous" buttons.
    	$this->getTotalOfMonths();
    }
	
	/**
	 * Queries all posts and puts them in an array
	 * then returns the view to list the posts (monthly)
	 * 
	 * @param Request $request
	 * @return view
	 */
	public function showIndex()
    {
    	$moreToDisplay = ($this->nbOfMonths > 6) ? true : false;
    	$limitsTable = $this->getLimOff();
    	
    	if ($this->currentPage <= 0)
    	{
    		$this->currentPage = 1;
    	}
    	$hasNext = ($this->currentPage == 1) ? false : true;
    	$hasPrevious = ($this->currentPage >= ceil($this->nbOfMonths / 6)) ? false : true;
    	
    	$months = DB::table('posts')
    		->leftJoin('articles', function ($join) {
    			$join->on('posts.type_key_id', '=', 'articles.id')
    			->on('posts.type', '=', DB::raw('\'article\''));
    		})
    		->leftJoin('articles_photo', function ($join) {
    			$join->on('posts.type_key_id', '=', 'articles_photo.id')
    			->on('posts.type', '=', DB::raw('\'photo\''));
    		})
    		->leftJoin('articles_video', function ($join) {
    			$join->on('posts.type_key_id', '=', 'articles_video.id')
    			->on('posts.type', '=', DB::raw('\'video\''));
    		})
    		->selectRaw('EXTRACT(YEAR_MONTH FROM posts.defined_date) as Date, posts.type, articles.id as article_id, articles.title as article_title,
    				articles_photo.id as photo_id, articles_photo.picsname as photo_name,
    				articles_video.id as video_id, articles_video.link as video_link, articles_video.title as video_title')
    		->orderBy('posts.defined_date', 'desc')
    		->whereBetween(DB::Raw('EXTRACT(YEAR_MONTH FROM posts.defined_date)'), [$limitsTable[1], $limitsTable[0]])
    		->get();
    		
    	$byMonths = $this->makeTheMonths($months);
    	
    	return view('index/index')->with([
    			'months' => $byMonths,
    			'moreToDisplay' => $moreToDisplay,
    			'hasPrevious' => $hasPrevious,
    			'hasNext' => $hasNext,
    			'currentPage' => $this->currentPage
    	]);
    }
    
    /**
     * Uses posts' query and returns an array ordered by months
     * 
     * @param array $months
     * @return array
     */
    private function makeTheMonths($months)
    {
    	$allMonths = [];
    	$byMonths = [];
    	 
    	// First array to recover all months (format yyyymm)
    	foreach ($months as $month)
    	{
    		array_push($allMonths, $month->Date);
    	}
    	
    	// Removes duplicated months
    	$uniqueMonths = array_unique($allMonths);
    	 
    	// Second and final array containing as many arrays as months (one month = 1 empty array)
    	// Keys are months (yyyymm)
    	foreach ($uniqueMonths as $key => $value)
    	{
    		$byMonths[$value] = [];
    	}
    	 
    	// Dispatches all posts in correct empty array
    	// If post's date == $key, add the post (object)
    	foreach ($months as $data)
    	{
    		foreach ($byMonths as $key => $value)
    		{
    			if ($data->Date == $key)
    			{
    				array_push($byMonths[$key], $data);
    			}
    		}
    	}
    	
    	return $byMonths;
    }
    
    public function postNewsletter(NewsletterRequest $request)
    {
    	if ($request->ajax())
    	{
    		$newSubTest = Newsletter::where('email_address', $request->newsletter_email)->get();
    		
    		foreach ($newSubTest as $emlExists)
    		{
    			if ($emlExists->email_address === $request->newsletter_email)
    			{
    				return '<div class="alert alert-warning alert-dismissible" role="alert">
    				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    				<strong>Erreur !</strong> L\'email : <u>'.$request->newsletter_email.'</u> est déjà enregistrée. Vous n\'avez pas besoin de l\'enregistrer à nouveau.
					</div>';
    			}
    		}
    		
    		$uniqid = 'unsus'.md5(rand());
    		$newSub = new Newsletter;
    		$newSub->email_address = $request->newsletter_email;
    		$newSub->uniqid = $uniqid;
    		$newSub->save();
    		
    		$this->mailToAdmin($request->newsletter_email);
    		$this->sendNewSubscriber($request->newsletter_email, $uniqid);
    		
    		return '<div class="alert alert-success alert-dismissible" role="alert">
    					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    					<strong>Bravo !</strong> L\'email : <u>'.$request->newsletter_email.'</u> a bien été enregistrée. Vous recevrez un email à chaque nouveautée.
						</div>';
    	}
    }
    
    /**
     * Identifies the page parameter of index.
     * Then returns an array that contains limit & offset.
     * 
     * @return array
     */
    private function getLimOff()
    {
    	if (Request::has('page'))
    	{
    		$pageNumber = (int) Request::get('page');
    		if ($pageNumber <= 0)
    		{
    			redirect(route('index'));
    		}
    		if ($pageNumber > ceil($this->nbOfMonths / 6))
    		{
    			$pageNumber = 1;
    		}
    		
    		$this->currentPage = $pageNumber;
    		return $this->getLimits($pageNumber);
    	}
    	$this->currentPage = 1;
    	return $this->getLimits(1);
    }
    
    /**
     * Returns a table that contains the limit & offset according to the page.
     * 
     * @param int $pageNumber
     * @return array
     */
    private function getLimits($pageNumber)
    {
    	$offset = ($pageNumber - 1)* 6;
    	
    	$pagination = DB::table('posts')
    	->selectRaw('DISTINCT EXTRACT(YEAR_MONTH FROM posts.defined_date) as rangeSix')
    	->orderBy('rangeSix', 'desc')
    	->skip($offset)->take(6)
    	->get();
    	 
    	 
    	$limitTable = [];
    	foreach ($pagination as $page)
    	{
    		array_push($limitTable, $page->rangeSix);
    	}
    	
    	$startEndTable = [];
    	if (empty($limitTable))
    	{
    		$limitTable = [0 => 0, 1 => 0];
    	}
    	array_push($startEndTable, $limitTable[0]);
    	array_push($startEndTable, end($limitTable));
    	
    	return $startEndTable;
    }
    
    /**
     * Returns the total number of months.
     * 
     * @return int
     */
    private function getTotalOfMonths()
    {
    	$total_number_of_months = DB::table('posts')
    	->selectRaw('COUNT(DISTINCT EXTRACT(YEAR_MONTH FROM posts.defined_date)) as total')
    	->get();
    	
    	$totalMonths = 0;
    	foreach ($total_number_of_months as $total)
    	{
    		$totalMonths = $total->total;
    	}
    	
    	$this->nbOfMonths = $totalMonths;
    }
    
    /**
     * Sends a mail to the admins to notify there is a new subscriber.
     * 
     * @param string $email
     */
    private function mailToAdmin($email)
    {
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	$message = 'Un nouvel abonné vient de s\'inscrire à la newsletter.<br>
				Voici son adresse : <strong>'.$email.'</strong><br><br>
						<a href="http://www.bleog.fr"><strong>Bleog.fr</strong></a>';
    	mail('thebestjb@gmail.com, djenyka@gmail.com', 'Nouvel abonné sur Bleog', $message, $headers);
    }
    
    /**
     * Sends a 'welcome' mail to the new subscriber.
     * 
     * @param string $email
     * @param string $uniqid
     */
    private function sendNewSubscriber($email, $uniqid)
    {
    	$to = $email;
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	$message = '<h1>Bleog.fr</h1><br><br>
				Merci de vous être inscrit à la newsletter <a href="http://www.bleog.fr"><strong>Bleog.fr</strong></a><br><br>
				Vous recevrez un email dès qu\'une nouvelle photo, vidéo ou qu\'un nouvel article paraît sur le site.<br><br>
				<hr>
				<small>Pour ne plus recevoir les newsletters, vous pouvez vous désinscrire en cliquant <a href="http://www.bleog.fr/newsletter/unsuscribe/'.$uniqid.'">ici</a></small>';
    	mail($to, 'Newsletter Bleog.fr', $message, $headers);
    }
}
