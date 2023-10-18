<style>
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }


    .myCard {
        padding: 10px !important;
        border-radius: 6px !important;
        color: #ec815e !important;
        /* background: #fff; */
        background: #f2f7fa70 !important;

        height: auto !important;
        box-shadow: none;
        position: relative;
        transition: all 0.2s;

        &:hover {
            border-color: #c4d1e1;
            box-shadow: 0 4px 10px -4px rgba(0, 0, 0, 0.15);
            transform: translate(-4px, -4px);
        }
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

    label {
        position: absolute;
        right: 20px;
    }

    .a14 {
        position: fixed;
        bottom: 15px;
        right: 20px;
        cursor: pointer;
        padding: 5px;
        z-index: 999;
    }

    .font-dark {
        color: #000 !important;
    }
</style>

<div class="col-sm-12 p-4">
    <form action="#" method="GET">
        <input type="hidden" name="position_id" value="{{ $position_id }}">
        <input type="hidden" name="moreCandidate" value="" id="moreCandidate">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">
        <div id="can_search_sec">
            <ul class="grid">
                @if (count($candidateList))
                @foreach ($candidateList as $key => $candidate)
                <li class="card myCard listmai" data-id="{{ $candidate->id }}" data-name="{{ ucwords($candidate->name) }}" data-email="{{ $candidate->email }}">
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
                @endif
            </ul>
            <button style="display:none;" id="assign_id" type="submit">Submit</button>
            <div class="a14" onclick="clickSubmit();">
                <span style="font-size:80px; color: coral" class="mdi mdi-checkbox-marked-circle"></span>
            </div>
        </div>
    </form>

</div>

{{-- <button id="usersec-1" class="btn btn-primary btn-sm show-can">Aditya Shrivastava <br> <small>aadistia@gmail.com</small> <span onclick="deleteSelected(1);" class="fa fa-times-circle-o cross"></span></button>   --}}

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
    //     var position_id = "{{ $position_id }}";
    //     $.get("{{ url('get-candidate-by-query') }}", {
    //         queryString: queryString,
    //         position_id: position_id,
    //     }, function(response) {
    //         $('#can_search_sec').html(response)
    //     });
    // }
</script>