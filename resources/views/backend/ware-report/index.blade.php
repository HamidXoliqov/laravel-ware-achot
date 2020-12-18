
@extends('layouts.backend')
@section('title')
    {{'Ware report'}}
@stop

@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Ware report</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Ware report
                </li> 
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>DataTable Ware report
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th>Дата</th>
                                    <th>Товар</th>
                                    <th>Выручка</th>
                                    <th>Себестоимость</th>
                                    <th>Прибыль</th>
                                </tr>
                            </thead>
                            @if (count($process)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($process as $value)
                                @php 
                                    $old_price = $value->getPrice($value->ware_id,$value->product_id) 
                                @endphp
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>
                                            {{$value->date}}
                                        </td>
                                        <td>
                                            {{$value->getProduct()}}
                                        </td>
                                        <td>
                                            {{number_format($value->price, 0, ' ', ' ')}}
                                        </td> 
                                        <td>
                                            {{number_format($old_price, 0, ' ', ' ')}}
                                        </td> 
                                        <td>
                                            {{number_format($value->price-$old_price, 0, ' ', ' ')}}
                                        </td>  
                                    </tr>
                                @endforeach    
                                <tr>
                                    <th></th>
                                    <th>Итого</th>
                                    <th></th>
                                    <th>{{number_format($sum_price, 0, ' ', ' ')}}</th>
                                    <th>{{number_format($old_prices, 0, ' ', ' ')}}</th>
                                    <th>{{number_format($foyda, 0, ' ', ' ')}}</th>
                                </tr>                                
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