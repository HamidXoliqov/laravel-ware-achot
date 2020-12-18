@extends('layouts.backend')
@section('title')
    {{'Users'}}
@stop
@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Users
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('user.create')}}">Add</a>
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>DataTable Users
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th width="100px">Image</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th width="30%">User name</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            @if (count($users)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($users as $value)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>
                                            <img src="{{$value->getImage()}}" class="img-thumbnail">
                                        </td>
                                        <td>
                                            {{$value->role}}
                                        </td>
                                        <td>
                                            {{$value->email}}
                                        </td>
                                        <td>
                                            {{$value->name}}
                                        </td>
                                        <td>
                                            <div class="toggle btn btn-primary ios {{($value->status)?'':'off'}}" data-toggle="toggle" role="button" style="width: 61.0547px; height: 37.7344px;">
                                                <input class="status" type="checkbox" checked="" data-toggle="toggle" data-style="ios" data-id="{{$value->id}}" data-action="users/status/{{$value->id}}">
                                                <div class="toggle-group">
                                                    <label for="" class="btn btn-primary toggle-on">On</label>
                                                    <label for="" class="btn btn-light toggle-off">Off</label>
                                                    <span class="toggle-handle btn btn-light"></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>                                      
                                            <a  class="btn btn-info" href="{{route('user.show',$value->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a  class="btn btn-warning" href="{{route('user.edit',$value->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <div style="display: inline-table;">    
                                                {!! Form::open(['route' => ['user.destroy',$value->id],'method'=>'DELETE']) !!}
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
                                        Bu bo'limda hali ma'lumot saqlanmagan
                                    </p>
                                </div>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="pagination-admin">                        
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </main>
    <!-- /page content -->

         
@endsection

@push('scripts')
<script>
    $('.toggle').click(function(){
        var id = $(this).children().first().data('id');
        var action = $(this).children().first().data('action');        
        $(this).toggleClass("off");

        $.ajax({
            url: action,
            type: 'GET',
            data: {id : id},
            dataType: 'json',
            success: function( data ) {
                if(data=='success')
                {
                    location.reload();
                }
            }       
        });
    });
</script>
@endpush
