<style>
    body {
        background: #f2f8ff;
        color: #263238;
        font-family: "Noto Sans", sans-serif;
        margin: 0;
        padding: 1em;
    }

    @media (min-width: 50em) {
        body {
            padding: 2em;
        }
    }

    @media (min-width: 90em) {
        body {
            padding: 4em;
        }
    }

    /* Grid */
    .grid {
        display: grid;
        grid-gap: 1em;
        margin: 0;
        padding: 0;
    }

    @media (min-width: 60em) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 90em) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Card Styles */
    .card {
        background: #fff;
        border: 1px solid #e2ebf6;
        border-radius: 0.25em;
        cursor: pointer;
        display: flex;
        padding: 1em;
        position: relative;
        transition: all 0.2s;
        margin: 4px;
    }

    .card:hover {
        border-color: #c4d1e1;
        box-shadow: 0 4px 10px -4px rgba(0, 0, 0, 0.15);
        transform: translate(-4px, -4px);
    }

    .card__image {
        border-radius: 0.25em;
        height: 6em;
        min-width: 6em;
    }

    .card__content {
        flex: auto;
        padding: 0 1em;
    }

    .card h2 {
        font-weight: 700;
        margin: 0;
    }

    .card p {
        color: #546e7a;
        margin: 0;
    }

    /* Checkbox Styles */
    .checkbox {
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        background: #e2ebf6;
        border-radius: 50%;
        height: 2em;
        margin: 0;
        margin-left: auto;
        flex: none;
        outline: none;
        position: relative;
        transition: all 0.2s;
        width: 2em;
    }

    .checkbox:after {
        border: 2px solid #fff;
        border-top: 0;
        border-left: 0;
        content: "";
        display: block;
        height: 1em;
        left: 0.625em;
        position: absolute;
        top: 0.25em;
        transform: rotate(45deg);
        width: 0.5em;
    }

    .checkbox:focus {
        box-shadow: 0 0 0 2px rgba(100, 193, 117, 0.6);
    }

    .checkbox:checked {
        background: #64c175;
        border-color: #64c175;
    }

    .checkbox-control__target {
        bottom: 0;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    /* SVG Styles */
    .nude {
        fill: #f4f0ed;
    }

    .yellow {
        fill: #ffcb65;
    }

    .red {
        fill: #f96149;
    }

    .sunburn {
        fill: #fe9d7d;
    }

    .eggplant {
        fill: #422b42;
    }

    .blue {
        fill: #4473e9;
    }

    .flamingo {
        fill: #ffb3da;
    }

    .violet {
        fill: #4450c7;
    }

    .poppy {
        fill: #ffa128;
    }

    .orange {
        fill: #ff8e56;
    }

    .animate-charcter {

        background-image: linear-gradient(-225deg,
                #231557 0%,
                #44107a 29%,
                #ff1361 67%,
                #fff800 100%);
        background-size: 200% auto;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textclip 2s linear infinite;
        display: inline-block;
        font-size: 29px;
    }

    @keyframes textclip {
        to {
            background-position: 200% center;
        }
    }
</style>
          <div class="col-md-12 text-center">
            <h3 class="animate-charcter" style="margin-top: -52px;"><b>National Job Portals</b></h3>
          </div>


<ul class="col-sm-12 row">

    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/linkedin.png') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="linkedin">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/facebook.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="facebook" name="jobPortals[]" class="checkbox" value="facebook">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/jobisjob.jpg') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="jobIsJob">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/careerjet.png') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="careerJet">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content ">
                <img height="35px" src="{{ url('job-posting-assets/Indeed.png') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="indeed" name="jobPortals[]" class="checkbox" value="indeed">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/jooble.jpg') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="jooble" name="jobPortals[]" class="checkbox" value="jooble" onchange="showJoobleForm();">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/drjob.png') }}" alt="">
                <p>
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" id="drJob" class="checkbox" value="drJob">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/adzuna.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" id="adzuna_india" class="checkbox" value="adzuna_india">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/jora.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]"  id="jora" onchange="showJoraForm();" class="checkbox" value="jora">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/google.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="google" name="jobPortals[]" class="checkbox" value="google" onchange="showGoogleJobForm();">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/shine.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="shine" id="shine" onchange="showShineForm();">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/clickIndia.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" id="clickIndia"  class="checkbox" value="clickIndia" onchange="showClickIndiaForm();">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/monster.jpg') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" id="monster" class="checkbox" onchange="showMonsterForm();" value="monster">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/postjobfree.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="postJobFree">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/naukri.jpg') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="naukri" onchange="showNaukriForm();" name="jobPortals[]" class="checkbox" value="naukri">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/timesjob.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="timesjob" name="jobPortals[]" class="checkbox" value="timesjob" onchange="showTimesJobForm();">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/whatJobs.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="whatJobs" name="jobPortals[]" class="checkbox" value="whatJobs">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/ats.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" id="linkedinATS" class="checkbox" value="linkedinATS">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/happiest.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="happiest" checked>
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px"  src="{{ url('job-posting-assets/wf.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="whiteforce" checked>
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>

</ul>

<div id="shine_portals_form" class="col-sm-12">

</div>
<div id="clickindia_portals_form" class="col-sm-12">

</div>
<div id="monster_portals_form" class="col-sm-12">

</div>
<div id="jora_portals_form" class="col-sm-12">

</div>
<div id="naukri_portals_form" class="col-sm-12">

</div>
<div id="jooble_portals_form" class="col-sm-12">

</div>
<div id="timesjob_portals_form" class="col-sm-12">

</div>
<div id="googlejob_portals_form" class="col-sm-12">

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>