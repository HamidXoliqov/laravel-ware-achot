
@extends('layouts.backend')
@section('title')
    {{'Ware items'}}
@stop

@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Ware items</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Ware items
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('ware-item.create')}}">Add</a>
                </li>
               <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('ware-item-search') }}" method="GET">
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
                    <i class="fas fa-table mr-1"></i>DataTable  Ware items
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th>Склад</th>
                                    <th>Продукта</th>
                                    <th>Приходная цена</th>
                                    <th>Количество</th>
                                    <th>Номер партии товара</th>
                                    <th>Дата прихода</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            @if (count($items)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($items as $value)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>
                                            {{$value->getWare()}}
                                        </td>
                                        <td>
                                            {{$value->getProduct()}}
                                        </td>
                                        <td>
                                            {{number_format($value->price, 0, ' ', ' ')}}
                                        </td>
                                        <td>
                                            {{number_format($value->item_count, 0, ' ', ' ')}}
                                        </td>
                                        <td>
                                            {{$value->item_number}}
                                        </td> 
                                        <td>
                                            {{$value->date}}
                                        </td>      
                                        <td>                                              
                                            <a  class="btn btn-info" href="{{route('ware-item.show',$value->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a  class="btn btn-warning" href="{{route('ware-item.edit',$value->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <div style="display: inline-table;">    
                                                {!! Form::open(['route' => ['ware-item.destroy',$value->id],'method'=>'DELETE']) !!}
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
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->  
@endsection