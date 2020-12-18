@extends('layouts.backend')
@section('title')
    {{'View '.$user->name}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> View {{$user->name}}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('user')}}">Users</a>
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('user.create')}}">Add</a>
                </li>                    
                <li class="breadcrumb-item active">
                    View
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-eye"></i>
                    View {{$user->name}}
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
                                    <td>Image</td>
                                    <td>
                                        <img src="{{$user->getImage()}}" class="img-thumbnail img-width-view">
                                    </td>
                                </tr>  
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
                                Bunaqa user mavjud emas !!!
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


