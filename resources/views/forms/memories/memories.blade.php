@extends('layout.main')

@section('title')
    Carnet de mémoires
@stop

@section('content')
    <div id="addedWithSuccess" class="alert alert-success alert-dismissible hidden" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-ok-circle">&nbsp;</span><span id="addedText"></span>
    </div>
    <h1 class="text-center">Carnet de mémoires</h1>
    <hr>

    <div class="panel panel-info">
        <div class="panel-heading">
            <form id="memoriesForm" class="form-inline" action="{{route('postMemories')}}" method="post">
                <div class="form-group">
                    <label for="event_date">Date</label>
                    <input type="date" class="form-control" id="event_date" name="event_date" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>
            </form>
        </div>
    </div>

    <div>
        <div id="memories-list">
            @foreach($memories as $memory)
                <div class="clearfix">
                    <div>
                        <div><b>{{$memory->event_date->formatLocalized('%A %d %B %Y')}}</b></div>
                        <div><span>{{$memory->description}}</span></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div>
        {{$memories->links()}}
    </div>
@stop
@section('addScript')
    <script type="text/javascript" src="{{URL::asset('js/memories.js')}}"></script>
@stop