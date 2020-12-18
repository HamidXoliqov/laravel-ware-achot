@extends('layouts.backend')
@section('title')
    {{'Edit'.$user->name}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit {{$user->name}}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('user')}}">Users</a> 
                </li>                    
                <li class="breadcrumb-item">
                    <a href="{{route('user.create')}}">Add</a>
                </li>                    
                <li class="breadcrumb-item active">
                    Edit
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit"></i>
                    Edit {{$user->name}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! Form::open(['route' => ['user.update',$user->id],'method'=>'put','files'=>'true']) !!}
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                                        User name
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::text('name',$user->name,['class'=>'form-control','placeholder' => 'User name'])}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $message }}</p>
                                        </span>
                                    @enderror
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                                        Email
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::text('email',$user->email,['class'=>'form-control','placeholder' => 'Email'])}}
                                     @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $errors->first('email') }}</p>
                                        </span>
                                    @enderror
                                    </div>
                                </div>                           
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                                        Password
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::password('password',['class'=>'form-control','placeholder' => 'Password'])}}
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <p class="erros-text">{{ $errors->first('password') }}</p>
                                        </span>
                                    @enderror
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                                        Confirmation password
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::password('password_confirmation',['class'=>'form-control','placeholder' => 'Confirmation password'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Image</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <img src="{{$user->getImage()}}" class="img-thumbnail img-width-edit">
                                        {{Form::file('image')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">
                                        Role
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{Form::select('role', $role, $rol_val, ['placeholder' => 'Default','class'=>'form-control'])}}
                                    </div>
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


