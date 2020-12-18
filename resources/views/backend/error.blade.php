@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="nav-link">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
