@extends('secure.layout.app')

@section('app-css')

@endsection

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Home</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row ">
        <h2 class="d-flex justify-content-center">Hi, <span class="badge badge-success"><i class="fa fa-check-circle link-primary"></i> </span> </h2>
        <h4 class="d-flex justify-content-center">Welcome to Drainage Dashboard</h4>
        <hr />
    </div>

    <dashboard></dashboard>

    <!-- [ Main Content ] end -->
@endsection


@section('app-scripts')

@endsection
