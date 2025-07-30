@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <h3 class="center-align" style="color: #C41E3A; font-weight: 600; margin-bottom: 2rem;">
                    The TUP Hymn
                </h3>
            </div>
        </div>

        <!-- Credits Section -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: #C41E3A; font-weight: 600;">
                            <i class="material-icons left">music_note</i>
                            TUP HYMN CREDITS
                        </span>
                        <div class="row">
                            <div class="col s12">
                                <p class="flow-text" style="text-align: center; line-height: 1.8; font-weight: 500;">
                                    <strong>MUSIC BY PROF. ROMEO P. VERAYO, SR.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filipino Version Section -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: #C41E3A; font-weight: 600;">
                            <i class="material-icons left">translate</i>
                            FILIPINO VERSION
                        </span>
                        <div class="row">
                            <div class="col s12">
                                <p class="flow-text"
                                    style="text-align: center; line-height: 1.8; font-weight: 500; margin-bottom: 1rem;">
                                    <strong>BY PROF. EMERITA R. VERAYO</strong>
                                </p>
                                <div style="text-align: center; line-height: 2; font-size: 1.1rem;">
                                    <p><strong>Kami sa 'yo'y nagpupugay TUP</strong></p>
                                    <p>Ang 'yong tanglaw, liwanag sa aming landas</p>
                                    <p>Diwa mo'y ginto, pusong wagas</p>
                                    <p>Alay naming sa iyo'y lahat ng hirap</p>
                                    <p>Buong pag-ibig at paglilingkod na ganap</p>
                                    <br>
                                    <p>Kay dami ng anak na 'yong pinagyaman</p>
                                    <p>Dahil sa 'yo ngayo'y haligi ng bayan</p>
                                    <p>Moog ka ng laya at dangal</p>
                                    <p><strong>Teknolohikal na Unibersidad ng Pilipinas</strong></p>
                                    <p>Bantayog ka ng lahi naming minamahal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- English Version Section -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: #C41E3A; font-weight: 600;">
                            <i class="material-icons left">language</i>
                            ENGLISH VERSION
                        </span>
                        <div class="row">
                            <div class="col s12">
                                <p class="flow-text"
                                    style="text-align: center; line-height: 1.8; font-weight: 500; margin-bottom: 1rem;">
                                    <strong>LYRICS BY DR. MILAGROS F. LOMOTAN</strong>
                                </p>
                                <div style="text-align: center; line-height: 2; font-size: 1.1rem;">
                                    <p><strong>Hail to you, Alma Mater, hail TUP</strong></p>
                                    <p>Your sons unite, and labor dignity uphold,</p>
                                    <p>Strong minds, mighty hearts priceless that gold</p>
                                    <p>These we offer you and all mankind</p>
                                    <p><strong>Hail oh hail -</strong></p>
                                    <br>
                                    <p>Across the seas we'll toil for you,</p>
                                    <p>Alma Mater dear</p>
                                    <p>They're nation builders all, alumni ever true</p>
                                    <p>Workers of note, trail blazers, artists</p>
                                    <p>Selfless souls, men and women free</p>
                                    <p>We honor thee</p>
                                    <p><strong>Technological University of the Philippines</strong></p>
                                    <p>Beloved school we honor you forever more!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- YouTube Video Section -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: #C41E3A; font-weight: 600;">
                            <i class="material-icons left">play_circle</i>
                            TUP HYMN VIDEO
                        </span>
                        <div class="row">
                            <div class="col s12">
                                <div class="video-container"
                                    style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; margin-top: 1rem;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                        src="https://www.youtube.com/embed/-4EmUd1Es7U?si=DiIDAZKioh2hHolj" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                                <p class="center-align" style="margin-top: 1rem; font-style: italic; color: #666;">
                                    Listen to the official TUP Hymn performed by the TUP Chorale
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection