
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <script src="https://kit.fontawesome.com/aea6f081fa.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/aea6f081fa.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
	integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <form action="{{ url('get-shine-details') }}" method="post">
            @csrf
            @method('POST')
            <div id="shinetext">
                <div class="mb-3 row mb-4 mt-5">
                    <div class="col-sm-12">

                            <img  height="25" src="https://www.white-force.com/onrole/job-posting-assets/shine.png" alt="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Cities</label>
                    <div class="col-sm-9" id="shine_cities_id_div">
                    <select name="shine_cities_id[]" class=" form-control"
                        id="shine_cities_id" multiple >
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->Job_Locations }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Industry</label>
                    <div class="col-sm-9">
                        <select name="shine_industries_id" class="list-dt form-control"
                        id="shine_industries_id" required>
                        <option value="-1" selected disabled>Select Industry</option>
                        @foreach($industries as $industry)
                        <option value="{{ $industry->id }}">{{ $industry->job_industry }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Functional</label>
                    <div class="col-sm-9">
                        <select class="form-control select-single"
                        name="shine_functional_areas_id[]" id="shine_functional_areas_id" required multiple>
                       @foreach($fields as $field)
                        <option value="{{ $field->id }}">{{ $field->job_functional_area }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Education</label>
                    <div class="col-sm-9">
                        <select name="shine_study_field_grouping_id[]"
                        class="form-control select-single" id="shine_study_field_grouping_id"
                         onchange="getShineEducationStream(this.value)" required>
                        <option value="-1" selected disabled>Select Education Level</option>
                        @foreach($educations as $education)
                        <option value="{{ $education->id }}">{{ $education->degree }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Education Stream</label>
                    <div class="col-sm-9" id="shine_education_stream_div">
                        <select name="shine_study_id[]" class="form-control select-single"
                            id="shine_study_id" Required multiple>
                            @foreach($streams as $stream)
                            <option value="{{ $stream->id }}">{{ $stream->specialization }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Experience</label>
                    <div class="col-sm-5">
                        <select name="shine_min_experience_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_min_experience_id" Required>
                        <option value="-1" selected disabled>Select Min. Exp.</option>
                        @foreach($experience as $exp)
                        <option value="{{ $exp->id }}">{{ $exp->experience }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="shine_max_experience_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_max_experience_id" Required>
                        <option value="">Select Max. Exp.</option>
                        @foreach($experience as $exp)
                        <option value="{{ $exp->id }}">{{ $exp->experience }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Salary</label>
                    <div class="col-sm-5">
                        <select name="shine_min_salary_id"
                                    class="list-dt form-control js-example-basic-single"
                                    id="shine_min_salary_id" id="shine_minYearExp" onchange="setMaxValue()" Required>
                                    <option value="">Select Min. Salary</option>
                                    @foreach($salary as $sal)
                                    <option value="{{ $sal->id }}">{{ $sal->Salary }}</option>
                                    @endforeach
                                </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="shine_max_salary_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_max_salary_id" Required>
                        <option value="">Select Max. Salary</option>
                        @foreach($salary as $sal)
                        <option value="{{ $sal->id }}">{{ $sal->Salary }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-9 offset-3">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Submit button</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script>
         $("#shine_cities_id").select2({
            placeholder: "Select Cities",
            tags: true,
            tokenSeparators: [','],
            maximumSelectionLength: 10,
        });
         $("#shine_functional_areas_id").select2({
            placeholder: "Select Functional Areas",
            tags: true,
            tokenSeparators: [','],
            maximumSelectionLength: 2,
        });
         $("#shine_study_id").select2({
            placeholder: "Select Stream",
            tags: true,
            tokenSeparators: [','],
            maximumSelectionLength: 2,
        });


        function getShineCity(shine_cities_groups_id) {
                $.get("{{ url('getShineCity') }}", {
                    shine_cities_groups_id: shine_cities_groups_id,
                }, function(response) {
                    // console.log(response);
                    $('#shine_cities_id_div').html('');
                    $('#shine_cities_id_div').html(response);
                });

            }

            function getShineEducationStream(shine_study_field_grouping_id) {
                if (shine_study_field_grouping_id) {
                    $.get("{{ url('get-specilization') }}", {
                        shine_study_field_grouping_id: shine_study_field_grouping_id,
                    }, function(response) {
                        // console.log(response);
                        $('#shine_study_id').empty();
                        for(res of response){
                            // console.log(res);
                            document.querySelector('#shine_study_id').appendChild(dynamicOptionCreate(res))
                        }
                    });
                }
            }

            function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            option.text = e.specialization;
            option.value = e.id;
            return option;
        }

            function setMaxValue() {
            var minValue = $('#shine_min_salary_id').val(); // 10
            minValue++ // 11
            var options = ""
            for (minValue; minValue <= 30; minValue++) {
                options += `<option value="` + minValue + `">` + minValue + `</option>`
            }
            $('#shine_max_salary_id').html('');
            $('#shine_max_salary_id').html(options);

        }

    </script>
  </body>
</html>

