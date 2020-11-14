<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin::modules.log._'.$log->type)
                    </div>
                </div>
            </div>
            @if ($log->comments)
                <div class="card-body">

                    @include('posts::comments._list', [
                                        'without_children' => true, 'comments' => $log->comments])

                </div>
            @endif
        </div>
    </div>
</div>
