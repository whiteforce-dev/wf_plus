<ul class="grid">
    @if (count($candidateList))
    @foreach ($candidateList as $key => $candidate)
    <li class="card myCard listmai" data-id="{{ $candidate->id }}" data-name="{{ ucwords($candidate->name) }}"      data-email="{{ $candidate->email }}">
        <div class="project-info">

            <div class="col-xl-8 my-2 col-lg-4 col-sm-6 row">

                <div class="col-auto">
                    <p class="text-primary mb-1">Name </p>
                    <p class="text-primary mb-1">Email </p>
                    <p class="text-primary mb-1">Mobile </p>
                </div>
                <div class="col-sm-1">
                    <p class="text-primary mb-1">-</p>
                    <p class="text-primary mb-1">-</p>
                    <p class="text-primary mb-1">-</p>
                </div>
                <div class="col-auto">
                    <p class="text-primary mb-1 font-dark">{{ ucwords($candidate->name) }} </p>
                    <p class="text-primary mb-1 font-dark">{{ ucwords($candidate->email) }} </p>
                    <p class="text-primary mb-1 font-dark">{{ ucwords($candidate->mobile) }} </p>
                </div>
            </div>

            <div class="col-xl-4 my-2 col-lg-4 col-sm-6">
                <div class="d-flex align-items-center">
                    <div class="project-media">
                        <img src="{{ !empty($candidate->createdBy) ? $candidate->createdBy->thumb() : '' }}"
                            alt="">
                    </div>
                    <div class="ms-2">
                        <span>Created By</span>
                        <h5 class="mb-0 pt-1 font-w500 text-black">
                            {{ !empty($candidate->createdBy) ? $candidate->createdBy->name : '' }}
                        </h5>
                    </div>

                </div>
            </div>
        </div>
        <label class="checkbox-control">
            <input type="checkbox" class="checkbox candidateForSearch" value="{{ $candidate->id }}">
            <span class="checkbox-control__target">Card Label</span>
        </label>
    </li>
    @endforeach
    @else
    <div class="divrow" align="center">
        <img style="height:155px;margin-top: 10px;"
            src="https://24.media.tumblr.com/b7eeca792a4511d6964b1eb72c29b5ad/tumblr_mlj6oxJMtG1rl43djo1_500.gif">
            {{-- https://i.imgur.com/3sHeIVN.gif --}}
        <div style="min-height: 15px;"></div>
        <h4 class="font-bold">Nahi Mil Rahaa Yaar :(</h4>
        <small><b>Aache se Search Kar na... </b></small>
    </div>
    @endif
</ul>
<button style="display:none;" id="assign_id" type="submit">Submit</button>
<div class="a14" onclick="clickSubmit();">
    <span style="font-size:80px; color: coral"
        class="mdi mdi-checkbox-marked-circle"></span>
</div>


<script>



    $(document).ready(function() {
        $('.listmai').click(function() {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked'));

            var id = ($(this).attr("data-id"));
            var name = ($(this).attr("data-name"));
            var email = ($(this).attr("data-email"));

             var selected = [];
            $(".show-can").each(function() {
                selected.push($(this).attr("data-candidate"));
            });



            if(checkbox.prop('checked')){
                if(selected.includes(id)){
                    return false;
                }
               var section = `
               <button data-candidate="`+id+`" id="usersec-`+id+`" class="btn btn-primary btn-sm show-can">`+name+` <br> <small>`+email+`</small> <span onclick="deleteSelected(`+id+`);" class="fa fa-times-circle-o cross"></span></button>
               `; 

                $('#sel-can-section').append(section);
            }else{
                deleteSelected(id);
            }
        });
    });

    function deleteSelected(id){
        $('#usersec-'+id).remove();
        $("input[value='" + id + "']").prop('checked', false);
    }



    var checkedInterviewCount = 0;
    var selectedCandidatesArray = [];


    function clickSubmit() {
        var position_id = "{{ $position_id }}";
        var selected = [];
        $(".show-can").each(function() {
            selected.push($(this).attr("data-candidate"));
        });
       
        $('#moreCandidate').val(selected);


        $.get("{{ url('assign_to_pipeline') }}", {
            selectedCandidate: selected,
            position_id: position_id
        }, function(result) {
            if (result == 1) {
                $('#rightModal').modal('hide');
                getCandidateAccordingStage('sourcing');
            }else{
                errorMsg('Server error')
                $('#rightModal').modal('hide');
                getCandidateAccordingStage('sourcing');
            }
        });
    }

    // function clickSubmit() {
    //     var position_id = "{{ $position_id }}";
    //     var checkedVals = $('.candidateForSearch:checkbox:checked').map(function() {
    //         return this.value;
    //     }).get();

    //     checkedInterviewCount = checkedInterviewCount + checkedVals.length
    //     selectedCandidatesArray = selectedCandidatesArray.concat(checkedVals);

    //     $('#selectedCanidateCount').html(checkedInterviewCount);
    //     $('#moreCandidate').val(selectedCandidatesArray);


    //     $.get("{{ url('assign_to_pipeline') }}", {
    //         selectedCandidate: selectedCandidatesArray,
    //         position_id: position_id
    //     }, function(result) {
    //         if (result == 1) {
    //             $('#rightModal').modal('hide');
    //             getCandidateAccordingStage('sourcing');
    //         }else{
    //             errorMsg('Server error')
    //             $('#rightModal').modal('hide');
    //             getCandidateAccordingStage('sourcing');
    //         }
    //     });
    // }



    function getCandidateBySearch() {
        var selected = [];
        $(".show-can").each(function() {
            selected.push($(this).attr("data-candidate"));
        });

        var status = $("#created_by_me").prop('checked');
        if(status){
            var checked = 1;
        }else{
            var checked = 0;
        }
        

        var queryString = $('#searchQuery').val();
        var position_id = "{{ $position_id }}";
        $.get("{{ url('get-candidate-by-query') }}", {
            queryString: queryString,
            position_id: position_id,
            checked:checked
        }, function(response) {
            $('#can_search_sec').html(response);
            $.each(selected, function(i, val){
                $("input[value='" + val + "']").prop('checked', true);
            });
        });
    }



    // function getCandidateBySearch() {

    //     var checkedVals = $('.candidateForSearch:checkbox:checked').map(function() {
    //         return this.value;
    //     }).get();

    //     checkedInterviewCount = checkedInterviewCount + checkedVals.length
    //     selectedCandidatesArray = selectedCandidatesArray.concat(checkedVals);

    //     $('#selectedCanidateCount').html(checkedInterviewCount);
    //     $('#moreCandidate').val(selectedCandidatesArray);

    //     var queryString = $('#searchQuery').val();
    //     var position_id = "{{ $position_id  }}";
    //     $.get("{{ url('get-candidate-by-query') }}", {
    //         queryString: queryString,
    //         position_id: position_id,
    //     }, function(response) {
    //         $('#can_search_sec').html(response)
    //     });
    // }
</script>