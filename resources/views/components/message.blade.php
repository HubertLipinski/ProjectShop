<div class="container">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p class="py-2 m-0">{!! \Session::get('success') !!}</p>
        </div>
    @endif

    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <p class="py-2 m-0">{!! \Session::get('error') !!}</p>
        </div>
    @endif
</div>
