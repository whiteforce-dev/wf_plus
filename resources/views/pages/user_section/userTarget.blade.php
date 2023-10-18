@extends('master.master')
@section('title', 'Team Section')
@section('content')
    <div class="content-body">
        <div class="container-fluid">

                <div class="card-body">
                    <div class="basic-form">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block">
                                <div class="me-auto mb-sm-0 mb-3">
                                    <h4 class="card-title mb-2">User List</h4>
                                </div>
                                <a href="javascript:void(0);" class="btn btn-info light me-3"><i class="las la-download scale3 me-2"></i>Import Csv</a>
                                <a href="javascript:void(0);" class="btn btn-info">+ Add Customer</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="ListDatatableView_wrapper" class="dataTables_wrapper no-footer"><table class="table style-1 dataTable no-footer" id="ListDatatableView" role="grid" aria-describedby="ListDatatableView_info">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 20.8594px;">#</th><th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-label="CUSTOMER: activate to sort column ascending" style="width: 278.719px;">CUSTOMER</th><th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-label="COUNTRY: activate to sort column ascending" style="width: 70.25px;">COUNTRY</th><th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-label="DATE: activate to sort column ascending" style="width: 75.0781px;">DATE</th><th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-label="COMPANY NAME: activate to sort column ascending" style="width: 118.094px;">COMPANY NAME</th><th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-label="STATUS: activate to sort column ascending" style="width: 72px;">STATUS</th><th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1" colspan="1" aria-label="ACTION: activate to sort column ascending" style="width: 84px;">ACTION</th></tr>
                                        </thead>
                                        <tbody>














                                        <tr role="row" class="odd">
                                                <td class="sorting_1">
                                                    <h6>1.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="images/avatar/1.jpg" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <h6>John Doe</h6>
                                                            <span>johndoe@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>England</h6>
                                                        <span>COde:En</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Abbott-Jacobs
                                                </td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="even">
                                                <td class="sorting_1">
                                                    <h6>2.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <span class="icon-name me-2 bgl-success text-success">m</span>
                                                        <div class="media-body">
                                                            <h6>Martin Chuaks</h6>
                                                            <span>martinchuaks@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>Indonasia</h6>
                                                        <span>COde:In</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">05/11/2016</h6>
                                                        <span>Pending</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Loyto-Farik
                                                </td>
                                                <td><span class="badge badge-danger">Danger</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="odd">
                                                <td class="sorting_1">
                                                    <h6>3.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="images/avatar/2.jpg" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <h6>Oliver Jean</h6>
                                                            <span>oliverjean@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>Malesia</h6>
                                                        <span>COde:Ml</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">08/15/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Uno-Matrics
                                                </td>
                                                <td><span class="badge badge-info">Info</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="even">
                                                <td class="sorting_1">
                                                    <h6>4.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="images/avatar/3.jpg" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <h6>John Doe</h6>
                                                            <span>johndoe@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>England</h6>
                                                        <span>COde:En</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">11/05/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Walter-Cummings
                                                </td>
                                                <td><span class="badge badge-success">Success</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="odd">
                                                <td class="sorting_1">
                                                    <h6>5.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <span class="icon-name me-2 bgl-info text-info">p</span>
                                                        <div class="media-body">
                                                            <h6>Post Melone</h6>
                                                            <span>postmelone@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>China</h6>
                                                        <span>COde:Ch</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Approved</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Abbott-Jacobs
                                                </td>
                                                <td><span class="badge badge-danger">Danger</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="even">
                                                <td class="sorting_1">
                                                    <h6>6.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="images/avatar/5.jpg" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <h6>Kevin Mandala</h6>
                                                            <span>kevinmandala@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>Africa</h6>
                                                        <span>COde:Af</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Pending</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Abbott-Jacobs
                                                </td>
                                                <td><span class="badge badge-danger">Canceled</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="odd">
                                                <td class="sorting_1">
                                                    <h6>7.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <span class="icon-name me-2 bgl-danger text-danger">m</span>
                                                        <div class="media-body">
                                                            <h6>Mc. Kowalski</h6>
                                                            <span>johndoe@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>England</h6>
                                                        <span>COde:En</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Abbott-Jacobs
                                                </td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="even">
                                                <td class="sorting_1">
                                                    <h6>8.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="images/avatar/7.jpg" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <h6>John Doe</h6>
                                                            <span>johndoe@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>England</h6>
                                                        <span>COde:En</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Dare-Conn
                                                </td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="odd">
                                                <td class="sorting_1">
                                                    <h6>9.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <span class="icon-name me-2 bgl-warning text-warning">t</span>
                                                        <div class="media-body">
                                                            <h6>Thomas Djons</h6>
                                                            <span>thomasdjons@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>England</h6>
                                                        <span>COde:En</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Abbott-Jacobs
                                                </td>
                                                <td><span class="badge badge-info">Info</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr><tr role="row" class="even">
                                                <td class="sorting_1">
                                                    <h6>10.</h6>
                                                </td>
                                                <td>
                                                    <div class="media style-1">
                                                        <img src="images/avatar/8.jpg" class="img-fluid me-2" alt="">
                                                        <div class="media-body">
                                                            <h6>Chintya Laudia</h6>
                                                            <span>chintyalaudia@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6>England</h6>
                                                        <span>COde:En</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="text-primary">10/21/2016</h6>
                                                        <span>Paid</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    Abbott-Jacobs
                                                </td>
                                                <td><span class="badge badge-danger">Danger</span></td>
                                                <td>
                                                    <div class="d-flex action-button">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs light px-2">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0);" class="ms-2 btn btn-xs px-2 light btn-danger">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr></tbody>
                                    </table><div class="dataTables_info" id="ListDatatableView_info" role="status" aria-live="polite">Showing 1 to 10 of 14 entries</div><div class="dataTables_paginate paging_simple_numbers" id="ListDatatableView_paginate"><a class="paginate_button previous disabled" aria-controls="ListDatatableView" data-dt-idx="0" tabindex="0" id="ListDatatableView_previous"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><span><a class="paginate_button current" aria-controls="ListDatatableView" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="ListDatatableView" data-dt-idx="2" tabindex="0">2</a></span><a class="paginate_button next" aria-controls="ListDatatableView" data-dt-idx="3" tabindex="0" id="ListDatatableView_next"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>
@endsection
