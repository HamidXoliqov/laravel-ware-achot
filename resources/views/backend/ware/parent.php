
@extends('layouts.backend')
@section('title')
    {{'Create ware'}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Create ware</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('ware')}}">Ware</a> 
                </li>                    
                <li class="breadcrumb-item active">
                    Add
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus-square"></i>
                    Create ware
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! Form::open(['route' => 'ware.store']) !!}
                        {{ Form::hidden('parentd', $ware->parend) }}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                        Name
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::text('name',null,['class'=>'form-control','placeholder' => 'Name'])}}
                                    </div>
                                    @error('name')
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
