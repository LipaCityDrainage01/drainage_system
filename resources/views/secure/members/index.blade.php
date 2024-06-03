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
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Admin Management</a></li>
                        <li class="breadcrumb-item" aria-current="page">List</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">RefreshIt Admin</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <admin-list></admin-list>
    <!-- [ Main Content ] end -->
@endsection


@section('app-scripts')

@endsection
