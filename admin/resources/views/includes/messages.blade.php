@if (session('success'))
    <div class="alert alert-bordered alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-bordered alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('error') }}
    </div>
@endif
@if(count($errors))
    <div class="alert alert-bordered alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @foreach($errors->all() as $error)
            <div>{!! $error !!}</div>
        @endforeach
    </div>
@endif
