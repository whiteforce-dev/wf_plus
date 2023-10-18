<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
?>
<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

<div id="monstertext" class="col-sm-12">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">
            <img height="25" src="{{ url('images/jobpostingportal/monster.png') }}" alt="">
        </div>
    </div>
    <form action="{{ url('send-to-newmonster') }}" method="post">
        @csrf
        @method('POST')
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label pay">Industry</label>
                <div class="col-sm-9">
                    <select name="monster_industry_id" class="form-control" id="monster_industry_id"
                        onchange="getIndustry(this.value);"  required>
                        <option value="-1" disabled selected>Select Industry type</option>

                        @if (count($industries))
                            @foreach ($industries as $industry)
                                <option value="{{ $industry->industry_id }}">
                                    {{ isset($industry->industry_name) ? $industry->industry_name : '' }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label ">Category Function
                </label>

                <div class="col-sm-9" id="category_funcion_div">
                    <select name="monster_category_function_id" class="form-control" id="monster_category_function_id"
                        onchange="getCategoryRole(this.value);" required>
                        <option value="-1" disabled selected>Select Category Function</option>

                    </select>

                </div>
            </div>
            <div class="mb-3 row" id="category_role_div">
                <label class="col-sm-3 col-form-label">Category Roles</label>
                <div class="col-sm-9">
                    <select name="monster_category_role_id" class="form-control" id="monster_category_role_id" required>
                        <option value="-1" disabled selected>Select Category Role</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Education Levels</label>
                <div class="col-sm-9">
                    <select name="monster_education_level_id" class="form-control" id="monster_education_level_id" required
                        onchange="getMonsterEducationStream(this.value);">
                        <option value="-1" disabled selected>Select Education Level</option>
                        <?php $monster_education_levels = App\Models\MonsterEducationLevel::cursor(); ?>
                        @if (count($monster_education_levels))
                            @foreach ($monster_education_levels as $monster_education_level)
                                <option value="{{ $monster_education_level->id }}">
                                    {{ isset($monster_education_level->degree) ? $monster_education_level->degree : '' }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row" id="monster_education_stream_div">

                <label class="col-sm-3 col-form-label">Education Stream</label>
                <div class="col-sm-9" id="monster_education_stream_div">
                    <select name="monster_education_stream_id" class="form-control" id="monster_education_stream_id" required>
                        <option value="-1" disabled selected>Select Education Stream</option>


                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                @php
                    $monster_locations = App\Models\MonsterLocation::get();
                @endphp

                <label class="col-sm-3 col-form-label">Location</label>
                <div class="col-sm-9">
                    <select class="form-control" name="monster_location" id="monster_location" required>
                        <option selected disabled>Select Location</option>
                        @foreach ($monster_locations as $monster_location)
                            <option value="{{ $monster_location->id }}">
                                {{ isset($monster_location->location) ? $monster_location->location : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        <button type="submit">send to newmonster</button>
    </form>
    <hr>
</div>
</body>
<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
    function getIndustry(monster_industry_id) {
        if (monster_industry_id) {
            console.log(monster_industry_id);
            $.get("{{ url('getIndustry') }}", {
                monster_industry_id: monster_industry_id,
            }, function(response) {
                console.log(response);
                $('#monster_category_function_id').empty();
                 for(res of response){
                            // console.log(res);
                            document.querySelector('#monster_category_function_id').appendChild(dynamicOptionCreate(res))
                        }
            });
        }
    }

    function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            option.text = e.category_function_name;
            option.value = e.category_function_id;
            return option;
        }


    function getCategoryRole(monster_category_function_id) {
        if (monster_category_function_id) {
            $.get("{{ url('getCategoryRole') }}", {
                monster_category_function_id: monster_category_function_id,
            }, function(response) {
                // console.log(response);
                $('#category_role_div').html(response);
            });
        }
    }

    function getMonsterEducationStream(monster_education_level_id) {
        if (monster_education_level_id) {
            $.get("{{ url('getMonsterEducationStream') }}", {
                monster_education_level_id: monster_education_level_id,
            }, function(response) {
                // console.log(response);
                $('#monster_education_stream_div').html(response);
            });
        }
    }
</script>
</html>

