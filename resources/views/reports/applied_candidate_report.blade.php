@extends('master.master')
@section('title', 'Applied Candidate Report')
@section('content')
<!-- Example file paths for DataTables CSS and JavaScript -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<style>
    .client_logoDiv {
        width: 85px;
        height: 85px;
        background: #f1f1f1;
        border-radius: 10px;
        margin: 0;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px dashed #00000049;
        padding: 8px;
    }

    .client_logoDiv img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 10px;
    }

    th {
        text-align: center;
        padding: 10px;
        font-weight: 700 !important;
        font-size: 16px !important;
    }

    td {
        text-align: center;
        font-weight: 600 !important;
        font-size: 15px !important;
    }

    thead {
        position: sticky;
        top: 0;
        background-color: #f2f2f2;
    }


    tfoot {
        position: sticky;
        bottom: 0;
        background-color: #f2f2f2;
    }

</style>
<style>
    #loader-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(8px);
    }

    .three-bounce {
        margin: 0;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .three-bounce .sk-child {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: var(--primary);
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
        animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
    }

    .three-bounce .sk-bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .three-bounce .sk-bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }
    .right-Modal {
        background: rgb(98 98 98 / 59%);
    }

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 642px;
        max-width: 642px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }


    /*Left*/
    .modal.left.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: 0;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    .between {
        justify-content: space-between;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .candidate_Information {
        width: 55%;
    }

    .position_Information {
        width: 100%;
    }

    .custom-modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #F2F7FA;
        height: 114px;
    }

    .custom-modal-header .candidate_img {
        width: 80px;
        height: 80px;
        background: #f2f7fa;
        border-radius: 50%;
    }

    .custom-modal-header .candidate_img img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
    }

    .custom-btn {
        padding: 4px 18px;
        font-size: 12px;
    }

    .custom-modal-body {
        padding: 0;
    }

    .custom-nav-modal {
        padding: 0.8rem 1.4rem !important;
        color: #858585;
    }

    .custom-tab-content {
        padding: 22px;
    }

    .custom-card {
        border: 1px solid #d2d2d2;
    }

    .card-header h6 {
        color: #555555;
    }

    .candidate_mobile h6,
    .candidate_sourcedPosition h6,
    .candidate_qualification h6,
    .candidate_email h6,
    .candidate_prefLocation h6,
    .candidate_pincode h6 {
        font-size: 14px;
        font-weight: 600;
        color: #3c3c3c;
    }

    .candidate_mobile p,
    .candidate_sourcedPosition p,
    .candidate_qualification p,
    .candidate_email p,
    .candidate_prefLocation p,
    .candidate_pincode p {
        font-size: 12px;
        font-weight: 400;
        color: #353434;
    }
    .table-container{
        position: relative;
       
    }
    table {
        width: 100%; 
        border-collapse: collapse;
    }
    thead {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 1;
    }

.table-scroll {
    max-height: 400px; 
    overflow-y: scroll;
    border-top: 1px solid #ccc; 
}
</style>
<!-- Example file paths for DataTables CSS and JavaScript -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


<div id="loader-container" style="display:none;">
    <div class="three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: #fff;">Applied Candidate Report</h4>
                    <span class="text-white card-title" style="font-size:x-large"></span>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <label for="">From Date</label>
                            <input type="date" id="fromdate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">To Date</label>
                            <input type="date" id="todate" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="">Source</label>
                            <select name="source" id="source" class="form-control">
                                <option value="">Select Source</option>
                               @foreach($source as $val)
                               <option value="{{ $val }}">{{ ucwords($val) }}
                               </option>
                               @endforeach
                            </select>
                        </div>
                       
                        <div class="col-md-3">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()" >Search</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive card table-scroll" id="applied_candidate_table" >
                       @include('master.404')
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

    function getChild(id) {
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/get-user-child') }}",
            data: {
                _token: "{{ csrf_token() }}",
                parent_id: id,
            },
            success: function (response) {
                $('#child_id').html(response);
            }
        });
    }
var res;
     function getReport() {
        document.querySelector('#loader-container').style.display="block";
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/applied-candidate-report-data') }}",
            data: {
                _token: "{{ csrf_token() }}",
                fromdate: $("#fromdate").val(),
                todate: $("#todate").val(),
                source:$("#source").val(),
            },
            success: function (response) {
                console.log(response);
                document.querySelector('#loader-container').style.display="none";
                $('#applied_candidate_table').empty();
                $("#applied_candidate_table").html(response);

            }
        })
    } 

    
    function openDetails(candidate_id){
        $.ajax({
            type: 'POST',
            url: "{{ url('candidate/details') }}",
            data: {
                _token: "{{ csrf_token() }}",
                candidate_id: candidate_id,
                display_action_button : 1
            },
            success: function (response) {
                $('#modal-section').html(response);
                $('#rightModal').modal('show');
            }
        })
    }
    let cPrev = -1; // global var saves the previous c, used to
            // determine if the same column is clicked again

            function addToPipeline(id) {
                console.log(id);
                var array = [];
                var a = document.getElementsByClassName('positionId');
                for (var i = 0; i < a.length; i++) {
                    if (a[i].checked == true) {
                        array.push(a[i].value);
                    }
                }
                if (array.length !== 0) {
                    console.log("add to pipeline");
                    console.log(array);
                    $.ajax({
                        url: "{{ url('add-candidate-to-multiple-pipeline') }}",
                        type: "POST",
                        data: {
                            _token :"{{ csrf_token() }}",
                            positionIds: array,
                            candidateId: id
                        },
                        success: function (response) {
                            console.log(response);
                                // Swal.fire(
                                // 'Candidate Added to Pipeline',
                                // 'Successfully',
                                // 'success'
                                // );
        
                        },
                        error: function (error) {
                            console.log(error);
                            // Swal.fire(
                            //     'Faild to Add ',
                            //     'Error',
                            //     'error'
                            // );
                        }
                    })
                    location.reload(true);
                } else {
                    console.log("retry");
                }
            }
        
            function showHistory(id){
                $.ajax({
                    url:"{{ url('get-candidate-history')  }}",
                    type:"POST",
                    data:{
                        _token :"{{ csrf_token() }}",
                        candidateId:id
                    },
                    success:function(response){
                        console.log(response);
                        if (response) {
                            $('.history').html("");
                            $('.history').html(response);
                        } else {
                            $('.grid').html(`<div align="center">
                            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;"
                                autoplay></lottie-player>
                            </div>`);
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                })
            }

            function showPositionList(candidateId) {
                $.ajax({
                    url: "{{ url('get-position-list') }}",
                    type: "POST",
                    data: {
                        _token :"{{ csrf_token() }}",
                        id: candidateId,
                    },
                    success: function (response) {
                        console.log(response)
                        if (response) {
                            $('.grid').html("");
                            $('.grid').html(response);
                        } else {
                            $('.grid').html(`<div align="center">
                            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;"
                                autoplay></lottie-player>
                            </div>`);
                        }
        
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }
        
        
// function sortBy(c) {
//     rows = document.getElementById("sortable").rows.length; // num of rows
//     columns = document.getElementById("sortable").rows[0].cells.length; // num of columns
//     arrTable = [...Array(rows)].map(e => Array(columns)); // create an empty 2d array

//     for (ro=0; ro<rows; ro++) { // cycle through rows
//         for (co=0; co<columns; co++) { // cycle through columns
//             // assign the value in each row-column to a 2d array by row-column
//             arrTable[ro][co] = document.getElementById("sortable").rows[ro].cells[co].innerHTML;
//         }
//     }

//     th = arrTable.shift(); // remove the header row from the array, and save it

//     if (c !== cPrev) { // different column is clicked, so sort by the new column
//         arrTable.sort(
//             function (a, b) {
//                 if (a[c] === b[c]) {
//                     return 0;
//                 } else {
//                     return (a[c] < b[c]) ? -1 : 1;
//                 }
//             }
//         );
//     } else { // if the same column is clicked then reverse the array
//         arrTable.reverse();
//     }

//     cPrev = c; // save in previous c

//     arrTable.unshift(th); // put the header back in to the array

//     // cycle through rows-columns placing values from the array back into the html table
//     for (ro=0; ro<rows; ro++) {
//         for (co=0; co<columns; co++) {
//             document.getElementById("sortable").rows[ro].cells[co].innerHTML = arrTable[ro][co];
//         }
//     }
// }

// variable to store the previously sorted column index

function sortBy(c) {
    const table = document.getElementById("sortable");
    const rows = table.rows.length; // num of rows
    const columns = table.rows[0].cells.length; // num of columns
    const arrTable = [...Array(rows)].map(e => Array(columns)); // create an empty 2d array

    for (let ro = 0; ro < rows; ro++) { // cycle through rows
        for (let co = 0; co < columns; co++) { // cycle through columns
            // assign the value in each row-column to a 2d array by row-column
            arrTable[ro][co] = table.rows[ro].cells[co].innerHTML.trim();
        }
    }

    const th = arrTable.shift(); // remove the header row from the array, and save it

    if (c !== cPrev) { // different column is clicked, so sort by the new column
        arrTable.sort((a, b) => {
            // Use localeCompare for string comparison to handle special characters and different languages
            return a[c].localeCompare(b[c], undefined, { sensitivity: 'base' });
        });
    } else { // if the same column is clicked then reverse the array
        arrTable.reverse();
    }

    cPrev = c; // save in previous c

    arrTable.unshift(th); // put the header back into the array

    // cycle through rows-columns placing values from the array back into the HTML table
    for (let ro = 0; ro < rows; ro++) {
        for (let co = 0; co < columns; co++) {
            table.rows[ro].cells[co].innerHTML = arrTable[ro][co];
        }
    }
}



</script>

@endsection
