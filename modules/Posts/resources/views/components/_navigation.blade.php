<div class="card-header text-center">

    {{--<button class="list-group-item list-group-item-primary--}}
    {{--{{ in_array(Route::currentRouteName(), ['posts.index', 'branches', 'groups']) ? 'active' : '' }}"--}}
    {{--type="button" data-toggle="collapse"--}}
    {{--data-target="#posts-sort" aria-expanded="true"--}}
    {{--aria-controls="posts-sort">{{ trans('posts::navigation.type_view') }}</button>--}}
    {{--<div class="collapse {{ in_array(Route::currentRouteName(), ['posts.index', 'branches', 'groups']) ? 'show' : '' }}"--}}
    {{--id="posts-sort">--}}
    {{--<a href="{{ route('posts.index') }}"--}}
    {{--class="list-group-item list-group-item-action {{ Route::currentRouteName() ==  'posts.index' ? 'active' : ''}}">--}}
    {{--{{ trans('posts::navigation.default_view') }}</a>--}}
    {{--<a href="{{ route('branches') }}"--}}
    {{--class="list-group-item list-group-item-action {{ Route::currentRouteName() ==  'branches' ? 'active' : ''}}">--}}
    {{--{{ trans('posts::navigation.branch_view') }}</a>--}}
    {{--<a href="{{ route('groups') }}"--}}
    {{--class="list-group-item list-group-item-action {{ Route::currentRouteName() ==  'groups' ? 'active' : ''}}">--}}
    {{--{{ trans('posts::navigation.group_view') }}</a>--}}
    {{--</div>--}}

    {{--<button class="list-group-item list-group-item-primary {{ isset($active_branch) ? 'active' : '' }}"--}}
    {{--type="button" data-toggle="collapse"--}}
    {{--data-target="#posts-branches" aria-expanded="true"--}}
    {{--aria-controls="posts-branches">{{ trans('posts::navigation.branches') }}</button>--}}

    {{--<div class="collapse {{ isset($active_branch) ? 'show' : '' }}" id="posts-branches">--}}
    {{--@include('posts::components._branches', ['branches' => \Modules\Posts\Entities\Branch::userRead()->root()->postable()->get()])--}}
    {{--</div>--}}





    {{--<button class="list-group-item list-group-item-primary {{ isset($active_group) ? 'active' : '' }}"--}}
    {{--type="button" data-toggle="collapse"--}}
    {{--data-target="#posts-groups" aria-expanded="true"--}}
    {{--aria-controls="posts-groups">{{ trans('posts::navigation.groups') }}</button>--}}

    {{--<div class="collapse {{ isset($active_group) ? 'show' : '' }}" id="posts-groups">--}}
    {{--@foreach(Auth::user()->groups as $group)--}}
    {{--<a href="{{ route('posts.group', compact('group')) }}"--}}
    {{--class="list-group-item list-group-item-action {{ isset($active_group) && $active_group->id == $group->id ? 'active' : '' }}">{{ $group->name }}</a>--}}
    {{--@endforeach--}}
    {{--</div>--}}

    {{--<button class="list-group-item list-group-item-primary"--}}
    {{--type="button">{{ trans('posts::navigation.types') }}</button>--}}

    <div class="btn-group btn-group-sm" role="group" aria-label="Search Settings">
        @foreach(\Modules\Posts\Entities\Post::types() as $type)
            <a href="{{ request()->fullUrlWithQuery(['post_type' => $type]) }}" class="btn btn-warning">
                {{ trans('posts::list.type_'.$type) }}</a>
        @endforeach
    </div>

</div>