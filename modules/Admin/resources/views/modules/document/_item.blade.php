<div class="card {{ $document->importance ? 'card-accent-danger' : '' }}">

    <div class="card-header">

        <strong><a href="{{ route('admin.users.item', $document->user->id) }}"><i class="fa fa-user"></i> {{ $document->user->first_name }} {{ $document->user->last_name }}</a></strong>
        {{ trans('documents::master.shared-text') }} <strong>{{ $document->file }}</strong>

        <div class="card-actions">
            <a href="{{ route('documents.download', $document->id) }}" target="_blank" title="{{ trans('documents::master.download') }}">
                <i class="icon-cloud-download"></i>
            </a>
            <a href="{{ route('documents.user', $document->user->id) }}" target="_blank" title="{{ trans('documents::master.user-more') }}">
                <i class="icon-user"></i>
            </a>

            <a href="{{ route('admin.document.edit', $document->id) }}"><i class="icon-pencil"></i></a>
            <a href="#" class="btn-delete" data-text="{{ trans('posts::list.delete_question') }}"><i
                            class="icon-trash"></i></a>
        </div>
    </div>

    <div class="card-body text-justify">
        {{ $document->description }}
    </div>

    <div class="table-responsive">
        <table class="table" style="margin-bottom: 0px;">
            <tr>
                <td>{{ trans('documents::master.filename') }}:</td>
                <td>{{ $document->file }}</td>
            </tr>
            <tr>
                <td>{{ trans('documents::master.category') }}:</td>
                <td>
                    <strong>
                        <a href="{{ route('documents.branches.item', $document->branch->alias) }}">
                            {{ $document->branch->name }}
                        </a>
                    </strong>
                </td>
            </tr>
            <tr>
                <td>{{ trans('documents::master.filesize') }}:</td>
                <td>{{ number_format($document->size, 2, ',', ' ') }} {{ trans('documents::master.fileci') }}</td>
            </tr>
            <tr>
                <td>{{ trans('documents::master.upload_date') }}:</td>
                <td>{{ $document->created_at->format('H:i:s d.m.y') }}</td>
            </tr>
            @if ($document->tags->count())
                <tr>
                    <td>{{ trans('documents::master.tags') }}:</td>
                    <td>
                        @foreach ($document->tags as $tag)
                            <a href="{{ route('documents.tags.item', $tag->alias) }}" class="badge badge-pill badge-{{ $tag->class }}">{{ $tag->name }}</a>
                        @endforeach
                    </td>
                </tr>
            @endif
        </table>
    </div>

    <form action="{{ route('admin.document.destroy') }}"
          style="display: inline-block"
          method="POST"
          class="form-post-delete">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $document->id }}">
    </form>
</div>