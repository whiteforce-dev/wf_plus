@foreach($Positions as $position)
<li class="card myCard">
    <div class="project-info">

        <div class="col-xl-9 my-2 col-lg-4 col-sm-6 row">

            <div class="col-4">
                <p class="text-primary mb-1">Position Name  </p>
                <p class="text-primary mb-1">Openings </p>
                <p class="text-primary mb-1">Job Location </p>
            </div>
            <div class="col-auto">
                <p class="text-primary mb-1 font-dark">{{ $position->position_name ?? "" }}</p>
                <p class="text-primary mb-1 font-dark">{{ $position->openings ?? "" }}</p>
                <p class="text-primary mb-1 font-dark">{{ $position->city ?? "" }}
                </p>
            </div>
        </div>

        <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
            <div class="d-flex align-items-center" style="justify-content: flex-end;">
                <label class="checkbox-control">
                    <input type="checkbox" class="checkbox candidateForSearch positionId" value="{{ $position->id }}">
                    <span class="checkbox-control__target">Card Label</span>
                </label>
            </div>

            <div class="d-flex align-items-center">
                <div class="project-media">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="">
                </div>
                <div class="ms-2">
                    <span>Created By</span>
                    <h5 class="mb-0 pt-1 font-w500 text-black">
                        {{ \App\Models\User::where('id', $position->created_by)->value('name') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

</li>
@endforeach
