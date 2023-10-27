@extends('master.master')
@section('title', 'Analyse Job')
@section('content')
<link rel="stylesheet" href="{{ url('assets/resumeparsingassets/header.css') }}">
<section class="resume-bulk">
    
        <div class="heading-resume">
            <h2>Resume-Matching</h2>
            <div class="two-cards">
                <div class="first-card">
                    <img src="{{ url('assets/resumeparsingassets/img/cv-1.png') }}" alt="">
                    <h3>Upload Job Description</h3>
                    <div class="resume-upload" style="margin-top: -0px">
                    <form action="{{ url('multiple_resume_matching') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input id="attach" type="file" style="display: none;" accept=".pdf,.doc,.docx,.rtf,.jpg,.jpeg" name="jd">
                        <label for="attach" class="gh-widget-upload"><i class="fa-solid fa-upload"></i>Attach JD</label>
                        <div class="gh-widget-tip"></div>
                    </div>
                </div>
                <div class="second-card">
                    <img src="{{ url('assets/resumeparsingassets/img/free_cv_upload01.png') }}" alt="">
                    <h3>Upload Multiple Resume</h3>
                    <div class="cont-multi-files">
                        <div class="resume-upload" style="margin-top: -0px">
                            <input id="attacher" type="file" id="files" name="resumes[]" multiple style="display: none;">
                            <label for="attacher" class="gh-widget-upload"><i class="fa-solid fa-upload"></i>Attach CV/Resume</label>
                        </div>
                    </div>
                </div>
                
            </div>
            <button class="btn btn-primary col-md-12">Match Resume</button></form>
        </div>
    
</section>
@endsection