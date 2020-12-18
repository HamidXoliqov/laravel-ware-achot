@extends('layouts.backend')
@section('title')
    {{'Edite '.$process->getWare()}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edite {{$process->getWare()}}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('ware-process')}}">Ware process</a> 
                </li>                     
                <li class="breadcrumb-item ">
                    <a href="{{route('ware-process.create')}}">Add</a>
                </li>                    
                <li class="breadcrumb-item active">
                    Edit
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit"></i>
                        Edit {{$process->getWare()}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! Form::open(['route' => ['ware-completed.update',$process->id],'method'=>'put']) !!}
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Склад <span style="color: red">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                                        {{Form::select('ware_id',$wares,$process->ware_id,['class'=>'form-control','placeholder' => $process->getWare(),'disabled'])}}
                                    </div>
                                    @error('ware_id')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Название продукта <span style="color: red">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::select('product_id',$products,$process->product_id,['class'=>'form-control','placeholder' => $process->getProduct(),'disabled'])}}
                                    </div>
                                    @error('product_id')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Цена продажи <span style="color: red">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::number('price',$process->price,['class'=>'form-control','placeholder' => 'Цена продажи','disabled'])}}
                                    </div>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Количество <span style="color: red">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::number('count',$process->count,['class'=>'form-control','placeholder' => 'Количество','disabled'])}}
                                    </div>
                                    @error('count')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Дата продажи
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{ Form::text('date', $process->date, ['class'=>'form-control','placeholder' => 'Дата продажи','id' => 'datepicker','autocomplete'=>'off','disabled']) }}

                                    </div>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Статус <span style="color: red">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::select('status',$status,$process->status,['class'=>'form-control','placeholder' => $process->getStatus($process->status)])}}
                                    </div>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-primary btn-create">
                                    Save
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->

@endsection

@push('scripts')
<script>
    $( "#datepicker" ).datepicker({
        dateFormat:'yy-mm-dd',
    });
</script>
@endpush