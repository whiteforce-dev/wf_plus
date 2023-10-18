@extends('master.master')
@section('title', 'Team Section')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Show Demotion List</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('demotion-user', $id) }}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <div id="ListDatatableView_wrapper" class="dataTables_wrapper no-footer">
                                    <table class="table style-1 dataTable no-footer" id="ListDatatableView" role="grid"
                                        aria-describedby="ListDatatableView_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="ListDatatableView"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="#: activate to sort column descending"
                                                    style="width: 20.8594px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CUSTOMER: activate to sort column ascending"
                                                    style="width:180px;">UserName</th>
                                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView"
                                                    rowspan="1" colspan="1"
                                                    aria-label="COMPANY NAME: activate to sort column ascending"
                                                    style="width: 118.094px;">Select Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView"
                                                    rowspan="1" colspan="1"
                                                    aria-label="ACTION: activate to sort column ascending"
                                                    style="width: 84px;">Select parent</th>
                                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView"
                                                    rowspan="1" colspan="1"
                                                    aria-label="ACTION: activate to sort column ascending"
                                                    style="width: 84px;">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">
                                                    <h6>1</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="{{ $user->avtar }}" height="90"
                                                            width="90" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <input name="role" value="{{ $user->name }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input name="role" value="{{ $user_role }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <select name="parent_id" class="">
                                                            <option value="">--SELECT Parent--</option>
                                                            @foreach ($parentList as $parent)
                                                                <option value="{{ $parent->id }}">
                                                                    {{ ucwords($parent->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input type="submit" name="submit" value="submit"
                                                            class="btn btn-primary">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
