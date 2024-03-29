@extends('master.master')
@section('title', 'Joining Report')
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
                    <h4 class="card-title" style="color: #fff;">Joining Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="">Select Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control"
                                onchange="getChild(this.value)">
                                <option value="">Select</option>
                                @foreach($allParents as $role => $users)
                                @if(count($users))
                                <optgroup label="{{ $role }}">
                                    @foreach($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user }}</option>
                                    @endforeach
                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Select Child</label>
                            <select name="child_id" id="child_id" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0">All</option>
                                <option value="joined">Joined</option>
                                <option value="backout">Backout</option>
                                <option value="offered">Offered</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control"
                                value="{{ $pastDate }}">
                        </div>
                        <div class="col-md-2">
                            <label for="">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control"
                                value="{{ $currentDate }}">
                        </div>
                        <div class="col-md-2">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Search</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive card" id="joining_report_table" >
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
            url: "{{ url('reports/joining-report') }}",
            data: {
                _token: "{{ csrf_token() }}",
                parent_id: $("#parent_id").val(),
                child_id: $("#child_id").val(),
                start_date: $("#startDate").val(),
                end_date: $("#endDate").val(),
                status: $("#status").val(),
            },
            success: function (response) {
                document.querySelector('#loader-container').style.display="none";
                console.log(response)

                $('#joining_report_table').empty();
                $("#joining_report_table").html(response);

            }
        })
    }

    let cPrev = -1; // global var saves the previous c, used to
            // determine if the same column is clicked again

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
