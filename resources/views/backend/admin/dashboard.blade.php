@extends('layouts.backend')
@section('title')
    {{'Control Panel'}}
@stop
@section('content')
    <!-- page content -->
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('admin-search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search for..." value="" name="q" autocomplete="off" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <!-- Navbar-->
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>User accounts
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px">№</th>
                                <th>Account</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                         
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
    <!-- /page content -->
@stop