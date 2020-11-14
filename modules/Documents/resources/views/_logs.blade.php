@if(count($logs))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                {{ trans('posts::edit.logs') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($logs as $log)
                            @include('posts::form.logs')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif