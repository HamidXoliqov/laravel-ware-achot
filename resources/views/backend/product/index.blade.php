
@extends('layouts.backend')
@section('title')
    {{'Products'}}
@stop

@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Products</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Products
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('product.create')}}">Add</a>
                </li>
               <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('product-search') }}" method="GET">
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
                    <i class="fas fa-table mr-1"></i>DataTable Phones
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th>Name</th>
                                    <th>Model</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            @if (count($products)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($products as $value)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>
                                            {{$value->name}}
                                        </td>
                                        <td>
                                            {{$value->model}}
                                        </td>     
                                        <td>                                              
                                            <a  class="btn btn-info" href="{{route('product.show',$value->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a  class="btn btn-warning" href="{{route('product.edit',$value->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <div style="display: inline-table;">    
                                                {!! Form::open(['route' => ['product.destroy',$value->id],'method'=>'DELETE']) !!}
                                                <button type="submit"  class="btn btn-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                            @else
                                <div class="page-not">
                                    <p align="center"> 
                                        Item not found !!!
                                    </p>
                                </div>
                                @endif
                        </table>
                    </div>
                </div>
                <div class="pagination-admin">                        
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->  
@endsection