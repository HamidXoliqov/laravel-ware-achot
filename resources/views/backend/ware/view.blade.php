@extends('layouts.backend')
@section('title')
    {{'View '.$ware->name}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">View {{$ware->name}}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('ware.index')}}">Wares</a>
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('ware.create')}}">Add</a>
                </li>                    
                <li class="breadcrumb-item active">
                    View
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-eye"></i>
                    View {{$ware->name}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">Name</th>
                                    <th width="100px">Value</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td>Name</td>
                                    <td>{{$ware->name}}</td>
                                </tr>     
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        {{($ware->status!=0)?'On':'Off'}}
                                    </td>
                                </tr>     
                                <tr>
                                    <td>Created</td>
                                    <td>
                                        {{$ware->created_at}}
                                    </td>
                                </tr>                                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->

@endsection


