@extends('layouts.app')

@section('content')

<div class="container">

    <div class="content">
        <div class="row gx-3">
            <div class="col-xxl-12 col-xl-12">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="card" id="dealerCard">
                    <div class="card-header border-bottom border-200 px-0">
                        <div class="d-lg-flex justify-content-between">
                            <div class="row flex-between-center gy-2 px-x1">
                                <div>
                                    <h4>Appointment Requests</h4>
                                </div>
                                <div class="col-auto">
                                    <form id="searchForm" method="post" action="#">
                                        <select name="search_key" id="search_key">
                                            <option value="ID">ID</option>
                                            <option value="requested_services" selected>Title</option>

                                        </select>
                                        <div class="input-group input-search-width">
                                            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search by name" aria-label="search" name="search_value" id="search_value"
                                                   data-route="appointment/search" data-selector="appointmentTableDiv" />
                                            <button class="btn btn-sm btn-outline-secondary border-300 hover-border-secondary">
                                                <span class="fa fa-search fs--1"></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="border-bottom border-200 my-3"></div>
                            <div class="d-flex align-items-center justify-content-between justify-content-lg-end px-x1">
                                <div class="d-flex align-items-center" id="table-ticket-replace-element">

                                    <button class="btn btn-falcon-default btn-sm mx-2" type="button" id="exportButton" data-route="appointment/export">
                                        <span class="fas fa-external-link-alt" data-fa-transform="shrink-3"></span>
                                        <span class="d-nonee d-sm-inline-block d-xl-nonee d-xxl-inline-block ms-1">Export Data</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Include File -->
                    @include('appointments.list')

                </div>
            </div>
        </div>

    </div>

</div>


@endsection
