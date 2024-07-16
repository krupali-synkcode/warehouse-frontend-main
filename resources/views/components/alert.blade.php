@if(Session::has('notification'))
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(Session::get('notification.type') == 'success')
                    <div class="alert alert-success d-flex alert-dismissible fade show" data-bs-dismiss="alert" role="alert">
                        {!! Session::get('notification.message') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    <div class="alert alert-danger d-flex alert-dismissible fade show" data-bs-dismiss="alert" role="alert">
                        {!! Session::get('notification.message') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif