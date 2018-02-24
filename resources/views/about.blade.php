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
                <p>Hi my name is Samo. </p>
                <p>I am a Slovenian Rap/Hip-Hop artist.</p>
                <p>And this is my web-store.</p>
            </div>

            <div class="card">
                <h4>Social media</h4>

                <p><a href="https://www.youtube.com/channel/UCCm_PUXcpk2eu3C4nIG8oCQ"
                    >MY YOUTUBE CHANNEL</a>
                </p>

                <p><a href="https://www.facebook.com/samo.kozar"
                    >MY FACEBOOK PAGE</a>
                </p>

                <p><a href="https://www.instagram.com/samokozar/"
                    >MY INSTAGRAM PAGE</a>
                </p>

                <p><a href="https://www.snapchat.com/add/samokozar"
                    >ADD ME ON SNAPCHAT</a>
                </p>

            </div>

            <div class="card">
                <h4>News Stories</h4>

                    <p><a href="http://www.delo.si/novice/ljubljana/vsak-najstnik-bi-moral-slisati-da-ga-imamo-radi.html"
                      target="_blank"  >DELO, 24.02.2018: Vsak najstnik bi moral slišati, da ga imamo radi</a>
                    </p>
                    <p><a href="http://www.bajta.si/od-a-do-z/samo-kozar-nogometas-in-reper-mini-intervju"
                          target="_blank" >Bajta, 25.08.2009: Samo Kozar, nogometaš in reper</a>
                    </p>
                    <p><a href="http://www.24ur.com/ekskluziv/glasba/zelenci-se-en-raperski-fenomen-tokrat-iz-koroske.html"
                          target="_blank" >24ur.com, 17.01.2011: ZELENCI: Še en raperski fenomen, tokrat iz Koroške</a>
                    </p>

            </div>

        </div>
    </div>



@endsection