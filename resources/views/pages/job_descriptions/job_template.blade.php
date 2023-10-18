@foreach($template as $temp)
<div class="card" >
    <div class="project-info">
        <div class="col-xl-4 my-2 col-lg-4 col-sm-6">
            <p class="text-primary mb-1">Designation</p>
            <h5 class="title font-w600 mb-2"><a href="post-details.html" class="text-black">{{ ucwords($temp->role ?? "") }}</a></h5>
            <div class="text-dark"> <span class="text-primary mb-1">Experience</span> {{ $temp->min_exp ?? 0 }} to {{ $temp->max_exp ?? 0 }} Years </div>
        </div>
        <div class="col-xl-7 hide my-2 jobTemplate" style="height:90px; overflow: auto;">{{ strip_tags($temp->description ?? "" ) }}</div>
        <div class="col-xl-1 my-2 col-lg-6 col-sm-6">
            <div class="d-flex project-status align-items-start">
                <span class="btn btn-xs btn-primary py-1" onclick="addTemplate(event)">Add</span>
            </div>
        </div>
    </div>
</div>
@endforeach

