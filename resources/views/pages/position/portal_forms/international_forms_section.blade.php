<div class="col-md-12 text-center mt-12">
  <hr>
  </div>
<div class="col-md-12 text-center mt-5">
    <h3 class="animate-charcter" style="margin-top: -52px;"><b>International Job Portals</b></h3>
  </div>

  <ul class="col-sm-12 row">
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/jobvertise.webp') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="job_vertise_inter">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/job_helper.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="facebook" name="jobPortals[]" class="checkbox" value="my_job_helper_inter">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card ">

            <div class="card__content">
                <img height="35px" src="{{ url('job-posting-assets/cv.png') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="cv_libaray_inter">
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
                <input type="checkbox" name="jobPortals[]" class="checkbox" value="adzuna_inter">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content ">
                <img height="35px" src="{{ url('job-posting-assets/whatJobs.png') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="whatjobs_inter" name="jobPortals[]" class="checkbox" value="whatjobs_inter">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">

            <div class="card__content ">
                <img height="35px" src="{{ url('job-posting-assets/zip.png') }}" alt="">

            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="ziprecruiter_inter" name="jobPortals[]" class="checkbox" value="ziprecruiter_inter"  onchange="showZiprecruiterForm();">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content ">
                <img height="35px" src="{{ url('job-posting-assets/times-ascent.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="times_ascent_inter" name="jobPortals[]" class="checkbox" value="times_ascent_inter">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
    <div class="col-sm-3">
        <li class="card disable ">
            <div class="card__content ">
                <img height="35px" src="{{ url('job-posting-assets/tanqeeb.png') }}" alt="">
            </div>
            <label class="checkbox-control">
                <input type="checkbox" id="indeed" name="jobPortals[]" class="checkbox" value="tanqeeb_inter">
                <span class="checkbox-control__target">Card Label</span>
            </label>
        </li>
    </div>
  </ul>

<div id="ziprecruiter_portals_form" class="col-sm-12">

</div>