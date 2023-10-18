<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
?>

<div id="joratext" class="col-sm-12">

    <img class="img-logo" src="https://white-force.com/onrole/logo/jora.png" alt="postjobfree" width=" 100">



    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Industry</label>

        <div class="col-sm-9">
            <select name="Jora_industry_id" class="form-control" id="indeed_industry_id"
                onchange="getIndustryCategoryFunction(this.value);" Required>
                <option value="-1" selected disabled>Select Industry type</option>
                @php
                    $industrycategorymappings = App\Models\MonsterIndustryCategoryMapping::cursor();
                    $collection = new Collection($industrycategorymappings);
                    $industries = $collection->unique('industry_id');
                @endphp
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
        <label class="col-sm-3 col-form-label pay">Category</label>

        <div class="col-sm-9">
            <select name="Jora_category_function_id" class="form-control js-example-basic-single"
                id="click_india_job_category" required>
                <option value="-1" selected disabled>Select Job Category</option>
                @php($JobCategory = App\Models\ClickCategory::get())
                @if (count($JobCategory))
                    @foreach ($JobCategory as $jobcategory)
                        <option value="{{ $jobcategory->id }}">
                            {{ isset($jobcategory->category_name) ? $jobcategory->category_name : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Education</label>

        <div class="col-sm-9">
            <select name="Jora_education_level_id" class="form-control" required>
                <option value="< 10th">Below 10th</option>
                <option value="10th">10th</option>
                <option value="12th">12th</option>
                <option value="Diploma">Diploma</option>
                <option value="Bachelors" selected>Bachelors</option>
                <option value="Masters">Masters</option>
            </select>
        </div>
    </div>
</div>
