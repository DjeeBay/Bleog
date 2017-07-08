<?php
namespace App\MyLibraries;

use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\File;
class PhotoTreatment
{
	protected $picsname;

	protected $directories = [
        '/pics/',
        '/pics/mini/',
        '/pics/articles_pics/',
        '/pics/articles_pics/mini/',
    ];
	
	public function __construct()
    {
        $this->checkDirectories();
    }

    public function fileTreatment(File $file, $type)
	{
		$valid_ext = array('jpg', 'jpeg', 'png');
		$real_ext = strtolower((substr(strrchr($file->getClientOriginalName(), '.'), 1)));
		
		if ($type == 'photo')
		{
			$miniPath = '/pics/mini/';
			$largePath = '/pics/';
		}
		else if ($type == 'articles_pic')
		{
			$miniPath = '/pics/articles_pics/mini/';
			$largePath = '/pics/articles_pics';
		}
		else 
		{
			return false;
		}
		
		if ($file->getError() > 0 || $file->getSize() > 2080000 || !in_array($real_ext, $valid_ext) || !getimagesize($file->getFileInfo()))
		{
			return false;
		}
		else
		{
			$rand_name = str_shuffle(md5(uniqid(rand(), true)).''.time());
			$file_name = $rand_name.'.'.$real_ext;
			if ($real_ext == 'jpeg' || $real_ext == 'jpg')
			{
				$src_file = imagecreatefromjpeg($file->getFileInfo());
				$dest_file = imagecreatetruecolor(220, 147);
				$src_width = imagesx($src_file);
				$src_height = imagesy($src_file);
				$dest_width = imagesx($dest_file);
				$dest_height = imagesy($dest_file);
				imagecopyresampled($dest_file, $src_file, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
				imagejpeg($dest_file, public_path($miniPath).$file_name);
				$file->move(public_path($largePath), $file_name);
			}
			elseif ($real_ext == 'png')
			{
				$src_file = imagecreatefrompng($file->getFileInfo());
				$dest_file = imagecreatetruecolor(220, 147);
				$src_width = imagesx($src_file);
				$src_height = imagesy($src_file);
				$dest_width = imagesx($dest_file);
				$dest_height = imagesy($dest_file);
				imagecopyresampled($dest_file, $src_file, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
				imagepng($dest_file, public_path($miniPath).$file_name);
				$file->move(public_path($largePath), $file_name);
			}
			$this->setPicsname($file_name);
			return true;
		}
	}

	public function fileTreatmentWithIntervention(File $file, $type)
	{
		$valid_ext = array('jpg', 'jpeg', 'png');
		$real_ext = strtolower((substr(strrchr($file->getClientOriginalName(), '.'), 1)));

		if ($type == 'photo')
		{
			$miniPath = '/pics/mini/';
			$largePath = '/pics/';
		}
		else if ($type == 'articles_pic')
		{
			$miniPath = '/pics/articles_pics/mini/';
			$largePath = '/pics/articles_pics/';
		}
		else
		{
			return false;
		}

		if ($file->getError() > 0 || !in_array($real_ext, $valid_ext) || !getimagesize($file->getFileInfo()))
		{
			return false;
		}
		else
		{
			$rand_name = str_shuffle(md5(uniqid(rand(), true)).''.time());
			$file_name = $rand_name.'.'.$real_ext;

			$thumbImage = Image::make($file->getFileInfo())->resize(220, 147);
            $normalImage = Image::make($file->getFileInfo());

            $thumbImage->save(public_path($miniPath).$file_name);

            $heightNormalImage = $normalImage->height();
            $widthNormalImage = $normalImage->width();

            if ($heightNormalImage > $widthNormalImage)
            {
                $normalImage->resize(null, 1024, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            else
            {
                $normalImage->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $normalImage->save(public_path($largePath).$file_name);

			$this->setPicsname($file_name);
			return true;
		}
	}
	
	private function setPicsname($picsname)
	{
		$this->picsname = $picsname;
	}
	
	public function getPicsname()
	{
		return $this->picsname;
	}

    private function checkDirectories()
    {
        foreach ($this->directories as $directory) {
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory));
            }
        }
    }
}