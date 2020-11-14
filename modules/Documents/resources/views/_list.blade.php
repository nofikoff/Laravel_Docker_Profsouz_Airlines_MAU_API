@foreach($documents as $document)
    <div class="row">
        <div class="col-md-12">
            @include('documents::_item')
        </div>
    </div>
@endforeach