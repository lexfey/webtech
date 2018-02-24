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

            <div class="card">
                <img src="img/sam.jpg"  style="width:100%">
                <h1>Samo Kozar</h1>
                <p class="title">HipHop-Artist: Samo Sam</p>
                <p>Ljublijana</p>
            </div>

            <div class="card">
                <h4>Samo in the news</h4>

                    <p><a href="http://www.delo.si/novice/ljubljana/vsak-najstnik-bi-moral-slisati-da-ga-imamo-radi.html"
                        >DELO, 24.02.2018: Vsak najstnik bi moral slišati, da ga imamo radi</a>
                    </p>
                    <p><a href="http://www.bajta.si/od-a-do-z/samo-kozar-nogometas-in-reper-mini-intervju"
                        >bajta, 25.08.2009: Samo Kozar, nogometaš in reper</a>
                    </p>
                    <p><a href="http://www.24ur.com/ekskluziv/glasba/zelenci-se-en-raperski-fenomen-tokrat-iz-koroske.html"
                        >24ur.com, 17.01.2011: ZELENCI: Še en raperski fenomen, tokrat iz Koroške</a>
                    </p>

            </div>

            <div class="card">
                <h4>Samo on Youtube</h4>

                <p><a href="https://www.youtube.com/channel/UCCm_PUXcpk2eu3C4nIG8oCQ"
                    >CLICK HERE TO VIEW SAMO'S YOUTUBE CHANNEL</a>
                </p>


            </div>

        </div>
    </div>



@endsection