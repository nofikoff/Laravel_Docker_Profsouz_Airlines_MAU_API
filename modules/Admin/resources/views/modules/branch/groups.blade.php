<div class="container">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-users"></i> Роли и права
            </div>
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                    <tr>
                        <th>{{ trans('users::user.full-name') }}</th>
                        @foreach($permissions as $permission)
                            <th>{{ $permission->display_name }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr data-group="{{ $group->id }}">
                            <td>
                                <a href="{{ route('admin.group.edit', ['id' => $group->id]) }}">
                                    {{ $group->name }}
                                </a>
                            </td>
                            @foreach($permissions as $permission)
                                <td>
                                    <label class="switch switch-3d switch-primary">
                                        @if($group->hasBranchPermission($branch,$permission))
                                            <input type="checkbox" class="switch-input" checked=""
                                                   data-permission="{{ $permission->id }}">
                                        @else
                                            <input type="checkbox" class="switch-input"
                                                   data-permission="{{ $permission->id }}">
                                        @endif
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.switch-input').on('click', function () {
            var permission = $(this).attr('data-permission')
            var group = $(this).parent().parent().parent().attr('data-group')

            $.ajax({
                method: "POST",
                url: "{{ route('admin.branch.groups', ['id' => $branch->id]) }}",
                data: {
                    group: group,
                    permission: permission,
                },
            });
        })
    })
</script>