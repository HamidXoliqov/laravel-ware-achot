@extends('layouts.backend')
@section('title')
    {{'User '.$user->name.' profile'}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">User {{$user->name}} profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>                   
                <li class="breadcrumb-item active">
                    User {{$user->name}} profile
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-eye"></i>
                    View {{$user->name}} profile
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!empty($user))
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">Name</th>
                                    <th width="100px">Value</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td>User name</td>
                                    <td>{{$user->name}}</td>
                                </tr>  
                                <tr>
                                    <td>Email</td>
                                    <td>{{$user->email}}</td>
                                </tr> 
                                <tr>
                                    <td>Role</td>
                                    <td>{{$user->role}}</td>
                                </tr> 
                                <tr>
                                    <td>Status</td>
                                    <td>{{($user->status)?'Active':'No active'}}</td>
                                </tr>                        
                            </tbody>
                        </table>
                         @else
                            <div class="page-not">
                                <p align="center">                         
                                    Bunday user mavjud emas !!!
                                </p>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->

@endsection


