@extends('layout.main')

@section('title')
    Upload de photos
@stop

@section('content')
    <h1 class="text-center">Upload de photos</h1>
    <hr>
    <photos-upload :show-photos="true"></photos-upload>
@stop