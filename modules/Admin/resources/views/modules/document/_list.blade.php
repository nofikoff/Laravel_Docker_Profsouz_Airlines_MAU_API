@foreach($documents as $document)
    <div class="row">
        <div class="col-md-12">
            @include('admin::modules.document._item')
        </div>
    </div>
@endforeach