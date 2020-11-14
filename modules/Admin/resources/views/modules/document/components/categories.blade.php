<div class="btn-group-vertical" role="group" aria-label="Categories" style="width:100%;">

    <a href="{{ route('documents.index') }}" class="btn btn-sm btn-secondary text-left">{{ trans('documents::master.list') }}</a>

    @foreach ($categories as $category)

        <a href="{{ route('documents.categories.item', $category->alias) }}" class="btn btn-sm btn-secondary text-left">{{ $category->name }}</a>

    @endforeach

</div>