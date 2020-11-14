<tr>
    <td>{{ $tag->name }}</td>
    <td>{{ trans('admin::tag.classes.'.$tag->class) }}</td>
    <td>
        <a href="{{ route('admin.tag.edit', ['id' => $tag->id]) }}"
           class="btn btn-primary">{{ trans('admin::tag.edit') }}</a>

        <form action="{{ route('admin.tag.destroy', ['id' => $tag->id]) }}"
              style="display: inline-block;" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-danger">{{ trans('admin::tag.delete') }}</button>
        </form>
    </td>
</tr>