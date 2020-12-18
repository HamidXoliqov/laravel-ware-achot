
@extends('layouts.backend')
@section('title')
    {{'Ware completed'}}
@stop

@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Ware completed</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Ware completed
                </li> 
               <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('ware-completed-search') }}" method="GET">
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
                    <i class="fas fa-table mr-1"></i>DataTable Ware completed
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th>Склад</th>
                                    <th>Продукта</th>
                                    <th>Цена продажи</th>
                                    <th>Количество</th>
                                    <th>Номер партии товара</th>
                                    <th>Статус</th>
                                    <th>Дата продажи</th>
                                    <th width="5%">Actions</th>
                                </tr>
                            </thead>
                            @if (count($process)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($process as $value)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>
                                            {{$value->getWare()}}
                                        </td>
                                        <td>
                                            {{$value->getProduct()}}
                                        </td>
                                        <td>
                                            {{$value->price}}
                                        </td>
                                        <td>
                                            {{$value->count}}
                                        </td>
                                        <td>
                                            {{$value->item_number}}
                                        </td>                                        
                                        <td>
                                            {{$value->getStatus($value->status)}}
                                        </td> 
                                        <td>
                                            {{$value->date}}
                                        </td>      
                                        <td>     
                                            <a  class="btn btn-info" href="{{route('ware-completed.show',$value->id)}}" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
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
                    {{$process->links()}}
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->  

@endsection