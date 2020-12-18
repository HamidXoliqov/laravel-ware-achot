@extends('layouts.backend')
@section('title')
    {{'Wares'}}
@stop

@section('content')

    <!-- page content -->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Wares</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Wares
                </li>                    
                <li class="breadcrumb-item ">
                    <a href="{{route('ware.create')}}">Add</a>
                </li>
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('ware-search') }}" method="GET">
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
                    <i class="fas fa-table mr-1"></i>DataTable Accounts
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th>Name</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            @if (count($wares)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($wares as $value)
                                    <tr>
                                        <td>@php echo $i++ @endphp</td>
                                        <td>
                                            <a href="{{url('/ware-parent/create',$value->id)}}">
                                                {{$value->name}} 
                                            </a>
                                            <!-- @foreach($value->getWares($value->id) as $val)
                                                {{$val->name}} 
                                            @endforeach -->
                                        </td>               
                                        <td>
                                            <div class="toggle btn btn-primary ios {{($value->status)?'':'off'}}" data-toggle="toggle" role="button" style="width: 61.0547px; height: 37.7344px;">
                                                <input class="status" type="checkbox" checked="" data-toggle="toggle" data-style="ios" data-id="{{$value->id}}" data-action="ware/status/{{$value->id}}">
                                                <div class="toggle-group">
                                                    <label for="" class="btn btn-primary toggle-on">On</label>
                                                    <label for="" class="btn btn-light toggle-off">Off</label>
                                                    <span class="toggle-handle btn btn-light"></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>          
                                            <a  class="btn btn-info" href="{{route('ware.show',$value->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a  class="btn btn-warning" href="{{route('ware.edit',$value->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <div style="display: inline-table;">    
                                                {!! Form::open(['route' => ['ware.destroy',$value->id],'method'=>'DELETE']) !!}
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
                    {{$wares->links()}}
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
        console.log(action);
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