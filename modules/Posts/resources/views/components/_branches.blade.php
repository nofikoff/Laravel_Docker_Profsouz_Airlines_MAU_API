@foreach($branches as $branch)
{{--    <a href="{{ route('posts.branch', ['branch_alias' => $branch->alias]) }}"--}}
       {{--class="list-group-item list-group-item-action ">{{ $branch->name }}</a>--}}
    <li class="nav-item">
        <a class="nav-link {{ isset($active_branch) && $active_branch == $branch ? 'active' : '' }}" href="{{ route('posts.branch', ['branch_alias' => $branch->alias]) }}">
            {{ $branch->name }}
        </a>
    </li>
    @if($branch->children)
        @include('posts::components._branches', ['branches' => $branch->children()->postable()->get()])
    @endif
@endforeach