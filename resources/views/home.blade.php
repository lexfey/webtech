
@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/home.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div id="main_image"><img id="main_img" src="img/mount.jpeg"> </div>
    <div id="who">
        <div class="content_center">  <!---right now not needed because just one element inside-->
            <div class="card">
                <img src="img/sam.jpg"  style="width:100%">
                <h1>Samo Kozar</h1>
                <p class="title">HipHop-Artist: Samo Sam</p>
                <p>Ljublijana</p>
                <p><a href="contact" id="contact">Contact</a></p>
            </div>
        </div>
    </div>
    <div id="news">
        <div class="content_center">  <!---right now not needed because just one element inside-->
             <div class="section_label">Whats New</div>  
        </div>
    </div>
    <div id="gallery">
        <div class="content_center">  <!---right now not needed because just one element inside-->
            <div class="section_label">Gallery</div>  
        </div>
    </div>
@endsection