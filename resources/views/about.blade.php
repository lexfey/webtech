<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
?>
@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/home.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
{{--<div id="main_image"><img id="main_img" src="img/mount.jpeg"> </div>--}}
    <div id="who">
        <div class="content_center">  <!---right now not needed because just one element inside-->
            <h1>Welcome to my Website, enjoy Shopping!</h1>
            <div class="card">
                <img src="img/sam.jpg"  style="width:100%">
                <h1>Samo Kozar</h1>
                <p class="title">HipHop-Artist: Samo Sam</p>
                <p>Ljublijana</p>
            </div>
            <h4>Please note that this website is still in progress (you can't order jet)</h4>
        </div>
    </div>

@endsection