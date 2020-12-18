
@extends('layouts.backend')
@section('title')
    {{'Ware process'}}
@stop

@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Ware process</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Ware process
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('ware-process.create')}}">Add</a>
                </li>
               <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('ware-process-search') }}" method="GET">
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
                    <i class="fas fa-table mr-1"></i>DataTable Ware process
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
                                    <th width="25%">Actions</th>
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
                                            {{number_format($value->price, 0, ' ', ' ')}}
                                        </td>
                                        <td>
                                            {{number_format($value->count, 0, ' ', ' ')}}
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
                                        <button type="button" class="btn btn-success count_button_minus" data-toggle="modal" data-target="#exampleModal" data-id="{{$value->id}}"data-ware="{{$value->ware_id}}"data-product="{{$value->product_id}}"
                                            data-count="{{$value->count}}" title="Count minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-success count_button_plus" data-toggle="modal" data-target="#exampleModal" data-id="{{$value->id}}"data-ware="{{$value->ware_id}}"data-product="{{$value->product_id}}"
                                            data-count="{{$value->count}}" title="Count plus">
                                            <i class="fa fa-plus"></i>
                                        </button>       
                                            <a  class="btn btn-info" href="{{route('ware-completed.edit',$value->id)}}" title="Completed">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>      
                                            <a  class="btn btn-info" href="{{route('ware-process.show',$value->id)}}" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a  class="btn btn-warning" href="{{route('ware-process.edit',$value->id)}}" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <div style="display: inline-table;">    
                                                {!! Form::open(['route' => ['ware-process.destroy',$value->id],'method'=>'DELETE']) !!}
                                                <button type="submit"  class="btn btn-danger" title="Delete">
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
                    {{$process->links()}}
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->  

     <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Product count
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form_minus" action="{{route('ware-process-count-minus')}}" method="GET" style="display: none;">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">
                            Count minus:
                        </label>
                        <input type="hidden" name="ware_id" value="" id="ware_hidden_minus">
                        <input type="hidden" name="process_id" value="" id="process_hidden_minus">
                        <input type="hidden" name="product_id" value="" id="product_hidden_minus">
                        <input type="number" name="count" class="form-control" value="" id="item_count_minus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
                <form class="form_plus" action="{{route('ware-process-count-plus')}}" method="GET" style="display: none;">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">
                            Count plus:
                        </label>
                        <input type="hidden" name="ware_id" value="" id="ware_hidden_plus">
                        <input type="hidden" name="process_id" value="" id="process_hidden_plus">
                        <input type="hidden" name="product_id" value="" id="product_hidden_plus">
                        <input type="number" name="count" class="form-control" value="" id="item_count_plus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>              
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>    
    $( ".count_button_minus").click(function() {
        $('.form_plus').css('display','none');
        $('.form_minus').css('display','block');
        var process_id = $(this).data('id');
        var ware_id = $(this).data('ware');
        var product_id = $(this).data('product');
        var count = $(this).data('count');
        var getCount = $("#item_count_minus").val(count);
        var getProcess = $("#process_hidden_minus").val(process_id);
        var getWare = $("#ware_hidden_minus").val(ware_id);
        var getProduct = $("#product_hidden_minus").val(product_id);
    }); 
    $( ".count_button_plus").click(function() {
        $('.form_plus').css('display','block');
        $('.form_minus').css('display','none');
        var process_id = $(this).data('id');
        var ware_id = $(this).data('ware');
        var product_id = $(this).data('product');
        var count = $(this).data('count');
        var getCount = $("#item_count_plus").val(count);
        var getProcess = $("#process_hidden_plus").val(process_id);
        var getWare = $("#ware_hidden_plus").val(ware_id);
        var getProduct = $("#product_hidden_plus").val(product_id);
    });


</script>
@endpush