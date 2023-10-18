<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
?>

<div id="naukritext" class="col-sm-12">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">
            <img class="img-logo" src="{{ url('images/jobpostingportal/Naukri.jpg') }}" alt="naukri" width="150">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">UG Qualifications</label>
        <div class="col-sm-9">
            <select name="UG_Qualifications" class="form-control" onchange="noukri_ug_qualification(this.value);"
                id="select_id" required>
                <option value="" selected disabled>Select Qualification</option>
                <?php $noukri_ugqualifications = DB::table('noukri_ugqualifications')->pluck('UG_Course', 'UG_ID');
                ?>
                @foreach ($noukri_ugqualifications as $key => $noukri_ugqualification)
                    <option value="{{ $key }}"> {{ $noukri_ugqualification }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">UG Specializations</label>
        <div class="col-sm-9" id="noukri_UG_Specializations_div">

            <select name="s" class="form-control" id="UG_Specializations" required>
                <option value="-1" selected disabled>Select Specification</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row" >
        <label class="col-sm-3 col-form-label pay">PG Qualifications</label>
        <div class="col-sm-9">

            <select name="PG_Qualifications" onchange="noukri_pg_qualification(this.value);" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <?php $noukri_pgqualifications = DB::table('noukri_pgqualifications')->pluck('PG_Course', 'PG_ID');
                ?>
                @foreach ($noukri_pgqualifications as $key => $noukri_pgqualification)
                    <option value="{{ $key }}"> {{ $noukri_pgqualification }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">PG Specializations</label>
        <div class="col-sm-9" id="noukri_PG_Specializations_div">
            <select name="PG_Specializations" class="form-control" required>
                <option value="-1" selected disabled>Select Specification</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Functional Area</label>
        <div class="col-sm-9">
            <select name="Functional_Area" onchange="noukri_FAREA_ID(this.value)" class="form-control" required>
                <option value="" selected disabled>Select Functional Area</option>
                <?php $noukri_functional_area_mappings = DB::table('noukri_functional_area_mappings')->pluck('FAREA_NAME', 'FAREA_ID');
                ?>
                @foreach ($noukri_functional_area_mappings as $key => $noukri_functional_area_mapping)
                    <option value="{{ $key }}">
                        {{ $noukri_functional_area_mapping }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Functional role</label>
        <div class="col-sm-9" id="noukri_FAREA_ID_div">
            <select name="Functional_role" class="form-control" required>
                <option value="" selected disabled>Select Functional role</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Industry Mapping</label>
        <div class="col-sm-9">
            <select name="Industry_Mapping" class="form-control" required>
                <option value="" selected disabled>Select Industry Mapping</option>
                <?php $noukri_industry_mappings = DB::table('noukri_industry_mappings')->pluck('Industry_Name', 'Industry_ID');
                ?>
                @foreach ($noukri_industry_mappings as $key => $noukri_industry_mapping)
                    <option value="{{ $key }}"> {{ $noukri_industry_mapping }}
                    </option>
                @endforeach
            </select>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Job Type</label>
        <div class="col-sm-9">
            <select name="naukri_job_type" class="form-control">
                <option value="p" selected>Private </option>
                <option value="h"> Hot </option>
            </select>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">City</label>
        <div class="col-sm-9">
            <select name="noukri_City" class="form-control" required>
                <option value="" selected disabled>Select City Field</option>
                <?php $noukri_city_national_locations = DB::table('noukri_city_national_locations')->pluck('City_Name', 'City_ID');
                ?>
                @foreach ($noukri_city_national_locations as $key => $noukri_city_national_location)
                    <option value="{{ $key }}">
                        {{ $noukri_city_national_location }}
                    </option>
                @endforeach
            </select>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Min Experience</label>
        <div class="col-sm-9">
            <select name="Minimum_Experience" class="form-control" onchange="getMaxExp(this.value)" required>
                <option value="" selected disabled>Select Minimum Experience</option>
                <?php $noukri_experience_range_mappings = DB::table('noukri_experience_range_mappings')->pluck('Minimum_Experience');
                ?>
                @foreach ($noukri_experience_range_mappings as $key => $noukri_experience_range_mapping)
                    <option value="{{ $noukri_experience_range_mapping }}">
                        {{ $noukri_experience_range_mapping }}</option>
                @endforeach
            </select>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Max Experience</label>
        <div class="col-sm-9">
            <input type="text" name="Maximum_Experience" id="Maximum_Experience" value="" readonly
                    class="form-control" required>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Min Salary</label>
        <div class="col-sm-9">
            <select name="Minimum_Salary" class="form-control">
                <option value="" selected disabled>Select Minimum Salary</option>
                <?php $noukri_indian_minsalary_mappings = DB::table('noukri_indian_minsalary_mappings')->pluck('Min_CTC');
                ?>
                @foreach ($noukri_indian_minsalary_mappings as $key => $noukri_indian_minsalary_mapping)
                    <option value="{{ $noukri_indian_minsalary_mapping }}">
                        {{ $noukri_indian_minsalary_mapping }}</option>
                @endforeach
            </select>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Max Salary</label>
        <div class="col-sm-9">
            <select name="Maximum_Salary" class="form-control" required>
                <option value="" selected disabled>Select Maximum Salary</option>
                <?php $noukri_indian_maxsalary_mappings = DB::table('noukri_indian_maxsalary_mappings')->pluck('Max_CTC');
                ?>
                @foreach ($noukri_indian_maxsalary_mappings as $key => $noukri_indian_maxsalary_mapping)
                    <option value="{{ $noukri_indian_maxsalary_mapping }}">
                        {{ $noukri_indian_maxsalary_mapping }}</option>
                @endforeach
            </select>
        </div>   
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Job Description</label>
        <div class="col-sm-9">
            <textarea name="noukri_job_description" class="form-control" maxlength="250" cols="5" rows="5"
            placeholder="Enter Job Description" required></textarea>
        </div>   
    </div>

    

  
    

    
    {{-- <div class="row">
        <div class="col-sm-4 mb-3">
            <label class="pay">UG Qualifications<small>(Naukri)</small></label>

            <select name="UG_Qualifications" class="form-control" onchange="noukri_ug_qualification(this.value);"
                id="select_id">
                <option value="" selected disabled>-Select Qualification-</option>
                <?php $noukri_ugqualifications = DB::table('noukri_ugqualifications')->pluck('UG_Course', 'UG_ID');
                ?>
                @foreach ($noukri_ugqualifications as $key => $noukri_ugqualification)
                    <option value="{{ $key }}"> {{ $noukri_ugqualification }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4" id="noukri_UG_Specializations_div">
            <label class="pay">UG Specializations <small>(Naukri)</small> </label>
            <select name="s" class="form-control" id="UG_Specializations">
                <option value="-1" selected disabled>-Select Specification-</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label class="pay">PG Qualifications <small>(Naukri)</small> </label>
            <select name="PG_Qualifications" onchange="noukri_pg_qualification(this.value);" class="form-control">
                <option value="" selected disabled>Select</option>
                <?php $noukri_pgqualifications = DB::table('noukri_pgqualifications')->pluck('PG_Course', 'PG_ID');
                ?>
                @foreach ($noukri_pgqualifications as $key => $noukri_pgqualification)
                    <option value="{{ $key }}"> {{ $noukri_pgqualification }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4 mb-3" id="noukri_PG_Specializations_div">
            <label class="pay">PG Specializations <small>(Naukri)</small> </label>

            <select name="PG_Specializations" class="form-control">
                <option value="-1">-Select Specification-</option>
            </select>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay"> Functional Area <small>(Naukri)</small> </label>
                <select name="Functional_Area" onchange="noukri_FAREA_ID(this.value)" class="form-control">
                    <option value="" selected disabled>-Select Functional Area-</option>
                    <?php $noukri_functional_area_mappings = DB::table('noukri_functional_area_mappings')->pluck('FAREA_NAME', 'FAREA_ID');
                    ?>
                    @foreach ($noukri_functional_area_mappings as $key => $noukri_functional_area_mapping)
                        <option value="{{ $key }}">
                            {{ $noukri_functional_area_mapping }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4" id="noukri_FAREA_ID_div">
            <label class="pay"> Functional role <small>(Naukri)</small> </label>
            <select name="Functional_role" class="form-control">
                <option value="" selected disabled>-Select Functional role-</option>
            </select>
        </div>
        <div class="col-sm-4 mb-3">
            <label class="pay"> Industry Mapping <small>(Naukri)</small> </label>
            <select name="Industry_Mapping" class="form-control">
                <option value="" selected disabled>-Select Industry Mapping-</option>
                <?php $noukri_industry_mappings = DB::table('noukri_industry_mappings')->pluck('Industry_Name', 'Industry_ID');
                ?>
                @foreach ($noukri_industry_mappings as $key => $noukri_industry_mapping)
                    <option value="{{ $key }}"> {{ $noukri_industry_mapping }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
                <label class="pay">Job Type <small>(Naukri)</small> </label>
                <br>
                <select name="naukri_job_type" class="form-control">
                    <option value="p" selected>Private </option>
                    <option value="h"> Hot </option>
                </select>
        </div>
        <div class="col-sm-4">
                <label class="pay">City Field Mapping( National Locations)
                </label>
                <select name="noukri_City" class="form-control">
                    <option value="" selected disabled>-Select City Field-</option>
                    <?php $noukri_city_national_locations = DB::table('noukri_city_national_locations')->pluck('City_Name', 'City_ID');
                    ?>
                    @foreach ($noukri_city_national_locations as $key => $noukri_city_national_location)
                        <option value="{{ $key }}">
                            {{ $noukri_city_national_location }}
                        </option>
                    @endforeach
                </select>
        </div>
        <div class="col-sm-3 mb-3">
            <label class="pay"> Minimum Experience <small>(Naukri)</small>
            </label>
            <select name="Minimum_Experience" class="form-control" onchange="getMaxExp(this.value)">
                <option value="" selected disabled>-Select Minimum Experience-</option>
                <?php $noukri_experience_range_mappings = DB::table('noukri_experience_range_mappings')->pluck('Minimum_Experience');
                ?>
                @foreach ($noukri_experience_range_mappings as $key => $noukri_experience_range_mapping)
                    <option value="{{ $noukri_experience_range_mapping }}">
                        {{ $noukri_experience_range_mapping }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
                <label class="pay"> Maximum Experience<small>(Naukri)</small>
                </label>
                <input type="text" name="Maximum_Experience" id="Maximum_Experience" value="" readonly
                    class="form-control">
        </div>
        <div class="col-sm-3">
                <label class="pay"> Minimum Salary<small>(Naukri)</small> </label>
                <select name="Minimum_Salary" class="form-control">
                    <option value="" selected disabled>-Select Minimum Salary-</option>
                    <?php $noukri_indian_minsalary_mappings = DB::table('noukri_indian_minsalary_mappings')->pluck('Min_CTC');
                    ?>
                    @foreach ($noukri_indian_minsalary_mappings as $key => $noukri_indian_minsalary_mapping)
                        <option value="{{ $noukri_indian_minsalary_mapping }}">
                            {{ $noukri_indian_minsalary_mapping }}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-sm-3">
                <label class="pay"> Maximum Salary<small>(Naukri)</small> </label>
                <select name="Maximum_Salary" class="form-control">
                    <option value="" selected disabled>-Select Maximum Salary-</option>
                    <?php $noukri_indian_maxsalary_mappings = DB::table('noukri_indian_maxsalary_mappings')->pluck('Max_CTC');
                    ?>
                    @foreach ($noukri_indian_maxsalary_mappings as $key => $noukri_indian_maxsalary_mapping)
                        <option value="{{ $noukri_indian_maxsalary_mapping }}">
                            {{ $noukri_indian_maxsalary_mapping }}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-sm-12">
                <label for="">Job Description *<small>(Naukri)</small></label>
                <textarea name="noukri_job_description" class="form-control" maxlength="250" cols="5" rows="5"
                    placeholder="write char 250 left"></textarea>
        </div>
    </div> --}}

</div>

<script>
       function noukri_ug_qualification(noukri_ug_qualification) {
           
            $.get("{{ url('getnoukriugspec') }}", {
                noukri_ug_qualification: noukri_ug_qualification,
            }, function(response) {
                $('#noukri_UG_Specializations_div').html(response);
            });

        }

        function noukri_pg_qualification(noukri_pg_qualification) {
           
            $.get("{{ url('getnoukripgspec') }}", {
                noukri_pg_qualification: noukri_pg_qualification,
            }, function(response) {
              
                $('#noukri_PG_Specializations_div').html(response);
            });

        }

        function noukri_FAREA_ID(noukri_FAREA_ID) {
           
            $.get("{{ url('noukri_functional_role') }}", {
                noukri_FAREA_ID: noukri_FAREA_ID,
            }, function(response) {
                
                $('#noukri_FAREA_ID_div').html(response);
            });
        }

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
</script>