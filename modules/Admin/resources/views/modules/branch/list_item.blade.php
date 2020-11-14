<tr>
    <td>{{ $branch->name }}</td>
    <td>{{ $branch->parent ? $branch->parent->name : '' }}</td>
    <td>
        <small>{{ \Illuminate\Support\Str::limit($branch->description,30) }}</small>
    </td>
    <td>{!! $branch->is_inherit ? '&check;' : '&chi;' !!}</td>
    <td class="text-right">
        <a href="{{ route('admin.branch.edit', ['id' => $branch->id]) }}"
           class="btn btn-primary">{{ trans('admin::branch.edit') }}</a>

        <form action="{{ route('admin.branch.destroy', ['id' => $branch->id]) }}"
              style="display: inline-block;" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-danger">{{ trans('admin::branch.delete') }}</button>
        </form>
    </td>
</tr>

@foreach($branch->children as $branch)

    @include('admin::modules.branch.list_item')

@endforeach
