@php
    use Illuminate\Database\Eloquent\Collection;
@endphp

<div class="col-sm-12" id="timejobtext">

    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">
            <img class="img-logo" src="https://white-force.com/onrole/logo/timesjobs.png" alt="naukri" width="150">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Job Location</label>
        <div class="col-sm-9">
            <select class="form-control times_location" id="times_location" name="times_location[]" required
                multiple="multiple">
                <?php
                $Times_locations = App\Models\Times_locations::cursor();
                $collection = new Collection($Times_locations);
                $Times_locations = $collection->unique('id');
                ?>
                @if (count($Times_locations))
                    @foreach ($Times_locations as $Times_location)
                        <option value="{{ $Times_location->id }}">
                            {{ isset($Times_location->value) ? $Times_location->value : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Location (other)</label>
        <div class="col-sm-9">
            <input type="text" placeholder="Enter location if not in above list" class="form-control" name="times_location_others">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Experience</label>
        <div class="col-sm-5">
            <select name="times_minYearExp" id="times_minYearExp" onchange="setMaxValue()" class="form-control"
                placeholder="Min Experience should not empty" required>
                <option selected disabled>Select Min Experience</option>
                @for ($i = 0; $i <= 15; $i++)
                    <option value="{{ $i }}">{{ $i }} -Yrs
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-sm-4">
            <select name="times_maxYearExp" id="times_maxYearExp" class="form-control"
                placeholder="Max Experience should not empty" required>
                <option selected disabled>Select Max Experience</option>
                @for ($i = 0; $i <= 30; $i++)
                    <option value="{{ $i }}">{{ $i }} -Yrs
                    </option>
                @endfor
            </select>
        </div>
    </div>
    
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Currency</label>
        <div class="col-sm-9">
            <select class="form-control" name="times_currency" required>
                <option value="r" selected>INR</option>
                <option value="u">USD</option>
                <option value="a">AED </option>
            </select>
        </div>
    </div>
    <div class="mb-3 row" style="display: none;">
        <label class="col-sm-3 col-form-label">Show Salary</label>
        <div class="col-sm-9">
            <select class="form-control" name="times_show_salary">
                <option value="Y" selected>Yes
                </option>
                <option value="N">No
                </option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Min Salary</label>
        <div class="col-sm-5">
            <select class="form-control" name="times_min_salary_lakh" required>
                <option value="-1" selected disabled>lacs</option>
                @for ($i = 0; $i <= 100; $i++)
                    <option value="{{ $i }}">{{ $i }} lacs
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-sm-4">
            <select class="form-control" name="times_min_salary_thousand" required>
                <option value="-1" selected disabled>Thousand</option>
                @for ($i = 0; $i <= 95; $i = $i + 5)
                    <option value="{{ $i }}">{{ $i }} Thousands
                    </option>
                @endfor
            </select>
        </div>
    </div>
   
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Max Salary</label>
        <div class="col-sm-5">
            <select class="form-control" name="times_max_salary_lakh" required>
                <option value="-1" disabled selected>Lacs</option>
                @for ($i = 0; $i <= 100; $i++)
                    <option value="{{ $i }}">{{ $i }} Lacs
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-sm-4">
            <select class="form-control" name="times_max_salary_thousand" required>
                <option value="-1" disabled selected>Thousand</option>
                @for ($i = 0; $i <= 95; $i = $i + 5)
                    <option value="{{ $i }}">{{ $i }} Thousand
                    </option>
                @endfor
            </select>
        </div>
    </div>
   
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Industry</label>
        <div class="col-sm-9">
            <select class="form-control times_industry" id="times_industry" name="times_industry[]" multiple required>
               
                <?php
                $times_industries = App\Models\Times_industries::cursor();
                $collection = new Collection($times_industries);
                $times_industries = $collection->unique('id');
                ?>
                @if (count($times_industries))
                    @foreach ($times_industries as $times_industrie)
                        <option value="{{ $times_industrie->id }}">
                            {{ isset($times_industrie->value) ? $times_industrie->value : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Industry (Others)</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Enter Industry if not in above list" name="times_industry_others">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Functional area</label>
        <div class="col-sm-9">
            <select class="form-control times_farea" id="times_farea" name="times_farea[]"
                onchange="times_fareass(this.value);" multiple>
                <option value="" disabled>Select Up to 2 Functional area</option>
                <?php
                $Times_functional_areas = App\Models\Times_functional_areas::orderBy('value', 'asc')->cursor();
                $collection = new Collection($Times_functional_areas);
                $times_area = $collection->unique('id');
                ?>
                @if (count($times_area))
                    @foreach ($times_area as $area)
                        <option value="{{ $area->id }}">
                            {{ isset($area->value) ? $area->value : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        
    </div>

    <div id="times_farea_ID_div" class="row">
        
    </div>




    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Functional area (Others)</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="times_farea_others">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Graduation</label>
        <div class="col-sm-9">
            <select class="form-control" onchange="times_Graduation_Course(this.value);" name="times_Graduation"
                required>
                <option value="Any Graduate"> Any Graduate</option>
                <option value="Course"> Course</option>
            </select>
        </div>
    </div>
    <div style="display:none;" id="times_Graduation_Course">
    <div class="mb-3 row " >
        <label class="col-sm-3 col-form-label">UG Course</label>
        <div class="col-sm-9">
            <select class="form-control times_Graduation" id="times_Graduation" name="times_Graduation_Course[]"
                onchange="times_greduation(this.value)" placeholder="you have selected 3 graduation course">
                <?php
                $Times_Graduations = App\Models\Times_greduations::cursor();
                $collection = new Collection($Times_Graduations);
                $Times_Graduations = $collection->unique('id');
                ?>
                @if (count($Times_Graduations))
                    @foreach ($Times_Graduations as $Times_Graduation)
                        <option value="{{ $Times_Graduation->id }}">
                            {{ isset($Times_Graduation->value) ? $Times_Graduation->value : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
   
    </div>




    <div class="mb-3 row" >
        <label class="col-sm-3 col-form-label">UG Specialisation</label>
        <div class="col-sm-9" id="times_greduation_ID_div">
            <select name="times_Graduation_Specialisation" class="form-control example-basic-single" id="">
                <option value="" selected disabled>-Select Specialisation-</option>
            </select>
        </div>
    </div>
</div>

    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Post Graduation</label>
        <div class="col-sm-9">
            <select class="form-control" name="times_post_Graduation"
                onchange="times_post_Graduation_Course(this.value)">
                <option value="Not requird"> Not required</option>
                <option value="Any Post Graduate"> Any Post Graduate</option>
                <option value="Course"> Course</option>
            </select>
        </div>
    </div>
    <div  style="display:none" id="times_post_Graduation_Course">
    <div class="mb-3 row" >
        <label class="col-sm-3 col-form-label">PG Course</label>
        <div class="col-sm-9">
            <select class="form-control" id="times_post_Graduation" name="times_post_Graduation_Course[]"
                onchange="times_post_greduation(this.value)">
                <?php
                $Times_post_Graduations = App\Models\Times_post_greduations::cursor();
                $collection = new Collection($Times_post_Graduations);
                $Times_post_Graduations = $collection->unique('id');
                ?>
                @if (count($Times_post_Graduations))
                    @foreach ($Times_post_Graduations as $Times_post_Graduation)
                        <option value="{{ $Times_post_Graduation->id }}">
                            {{ isset($Times_post_Graduation->value) ? $Times_post_Graduation->value : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        </div>
    
    <div class="mb-3 row" >
        <label class="col-sm-3 col-form-label">PG Specialisation</label>
        <div class="col-sm-9" id="times_post_greduation_ID_div">
            <select name="times_post_Graduation_Specialisation" class="list-dt form-control example-basic-single"
                id="">
                <option value="" selected disabled>Select Specialisation</option>
            </select>
        </div>
    </div>
</div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Job Description</label>
        <div class="col-sm-9">
            <textarea name="times_job_description" id="times_job_description" class="form-control"
                onkeyup="getValueCount(this);" minlength="250" maxlength="8000" cols="5" rows="5" required></textarea>
                <p></p>
            <small id="charNum">0 characters</small>
        </div>
    </div>
</div>

<hr>

<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select-multiple-one').select2({
            tags: true,
            tokenSeparators: [',']
        });
    });
    $(document).ready(function() {
        $('.select2-container--open').hide();
    });



    function getValueCount(obj) {
        let noc = document.getElementById("times_job_description").value.length;
        console.log(noc);

        var minLength = 250;
        var strLength = obj.value.length;

        if (strLength < minLength) {
            document.getElementById("charNum").innerHTML = 'Should be more than ' +
                minLength + ' words, your current count is ' + strLength + ' words </span>';
        } else {
            document.getElementById("charNum").innerHTML = strLength + ' out of ' + minLength + ' characters';
        }
    };

    function times_fareass(times_farea_id) {

        
        $.get("{{ url('times_farea') }}", {
            times_farea_id: times_farea_id,
        }, function(response) {
            // alert(response)
            console.log(response);
            //alert(response);
            $('#times_farea_ID_div').html(response);
        });
    }
    function times_greduation(times_greduation_id) {
        //alert(times_greduation_id);
        $.get("{{ url('times_greduation') }}", {
            times_greduation_id: times_greduation_id,
        }, function(response) {
            // alert(response)
            console.log(response);
            //alert(response);
            $('#times_greduation_ID_div').html(response);
        });
    }

    function times_post_greduation(times_post_greduation_id) {
        //alert(times_post_greduation_id);

        $.get("{{ url('times_post_greduation') }}", {
            times_post_greduation_id: times_post_greduation_id,
        }, function(response) {
            // alert(response)
            console.log(response);
            //alert(response);
            $('#times_post_greduation_ID_div').html(response);
        });
    }

    function times_Graduation_Course(times_Graduation_Course) {
        //alert(times_Graduation_Course);

        var text = document.getElementById("times_Graduation_Course");

        // If the checkbox is checked, display the output text
        if (times_Graduation_Course == 'Course') {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }

    }

    function times_post_Graduation_Course(times_post_Graduation_Course) {
        //$('#times_post_Graduation_Course').show();

        var posttext = document.getElementById("times_post_Graduation_Course");

        // If the checkbox is checked, display the output text
        if (times_post_Graduation_Course == 'Course') {
            posttext.style.display = "block";
        } else {
            posttext.style.display = "none";
        }
    }
    // function times_greduation(times_greduation_id) {
    //     //alert(times_greduation_id);
    //     $.get("{{ url('times_greduation') }}", {
    //         times_greduation_id: times_greduation_id,
    //     }, function(response) {
    //         // alert(response)
    //         console.log(response);
    //         //alert(response);
    //         $('#times_greduation_ID_div').html(response);
    //     });
    // } 

    // function times_post_greduation(times_post_greduation_id) {
    //     //alert(times_post_greduation_id);

    //     $.get("{{ url('times_post_greduation') }}", {
    //         times_post_greduation_id: times_post_greduation_id,
    //     }, function(response) {
    //         // alert(response)
    //         console.log(response);
    //         //alert(response);
    //         $('#times_post_greduation_ID_div').html(response);
    //     });
    // }

    // function times_Graduation_Course(times_Graduation_Course) {
     

    //     var text = document.getElementById("times_Graduation_Course");

    //     If the checkbox is checked, display the output text
    //     if (times_Graduation_Course == 'Course') {
    //         text.style.display = "block";
    //     } else {
    //         text.style.display = "none";
    //     }

    // }

    // function times_post_Graduation_Course(times_post_Graduation_Course) {
    //     //$('#times_post_Graduation_Course').show();

    //     var posttext = document.getElementById("times_post_Graduation_Course");

    //     // If the checkbox is checked, display the output text
    //     if (times_post_Graduation_Course == 'Course') {
    //         posttext.style.display = "block";
    //     } else {
    //         posttext.style.display = "none";
    //     }
    // }

    function getMaxExp(minExp) {
        var maxExp = 0;
        var minExp = parseInt(minExp);
        if (minExp >= 1 && minExp <= 9) {
            maxExp = minExp + 5
        } else if (minExp >= 10 && minExp <= 29) {
            maxExp = minExp + 10

        } else if (minExp == 30) {
            maxExp = 30
        }
        document.getElementById("Maximum_Experience").value = maxExp
    }

    function setMaxValue() {
        var minValue = $('#times_minYearExp').val(); // 10
        minValue++ // 11
        var options = ""
        for (minValue; minValue <= 30; minValue++) {
            options += `<option value="` + minValue + `">` + minValue + `</option>`
        }
        $('#times_maxYearExp').html('');
        $('#times_maxYearExp').html(options);

    }

    $(document).ready(function() {
         $('.times_location').select2({
            maximumSelectionLength: 5,
            placeholder: "Select Location (upto 5)",
         });


         $(".times_industry").select2({
            maximumSelectionLength: 2,
            placeholder: "Select Industry  (upto 2)",
        });

         $(".times_farea").select2({
            maximumSelectionLength: 1,
            placeholder: "Select Fuctional Area",
        });

        //  $(".times_farea").select2({
        //     maximumSelectionLength: 3,
        //     placeholder: "Select Graduation",
        // });
    });

    

    // $("#times_Graduation").select2({
    //     maximumSelectionLength: 3
    // });

    // $("#times_post_Graduation").select2({
    //     maximumSelectionLength: 3
    // });

    chnageSalaryInput();

    function chnageSalaryInput() {
        var salary_type = $('#salary_inr_usd').val();
        if (salary_type == 'INR') {
            document.getElementById('minINR').style.display = "block";
            document.getElementById('maxINR').style.display = "block";
            document.getElementById('minUSD').style.display = "none";
            document.getElementById('maxUSD').style.display = "none";
        } else if (salary_type == 'USD') {
            document.getElementById('minINR').style.display = "none";
            document.getElementById('maxINR').style.display = "none";
            document.getElementById('minUSD').style.display = "block";
            document.getElementById('maxUSD').style.display = "block";
        }
    }

    function changeLocation() {
        var is_remote = $('#remote_work').val();
        if (is_remote == 'yes') {
            document.getElementById("locations").required = false;
            document.getElementById("address-input").required = false;
        } else {
            document.getElementById("locations").required = true;
            document.getElementById("address-input").required = true;
        }
    }

    function getCountry(country) {
        if (country != '')
            $.ajax({
                url: "{{ url('getCountry') }}/",
                data: {
                    country: country
                },
                success: function(response) {

                    $('#country').html(response);
                }
            });
        else
            $('#country').html('<option value="">Select state</option>');
    }

    function getState() {
        var country_id = $('#country').val();

        $.get("{{ url('getState') }}", {
            country: country_id,
        }, function(response) {
            $('#state').html(response);
        });
    }

    function getCity() {
        var state_id = $('#state').val();

        $.get("{{ url('getCity') }}", {
            state: state_id,
        }, function(response) {
            console.log(response)
            $('#locations').html(response);
        });
    }
</script>
