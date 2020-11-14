<div class="list-group">
    @if(Auth::user()->is_editor() || (isset($active_branch) && Auth::user()->can('publishing', $active_branch)))
        <a href="{{ route('documents.premoderate') }}"
           class="list-group-item list-group-item-primary {{ Route::currentRouteName() ==  'documents.premoderate' ? 'active' : ''}}">
            {{ trans('documents::master.premoderate') }}
        </a>
    @endif
    <a href="{{ route('documents.index') }}"
       class="list-group-item list-group-item-action {{ Route::currentRouteName() ==  'documents.index' ? 'active' : ''}}">{{ trans('documents::master.list') }}</a>
    @foreach(\Modules\Posts\Entities\Branch::userRead()->documentable()->get() as $branch)
        <a href="{{ route('documents.branches.item', $branch->alias) }}"
           class="list-group-item list-group-item-action {{ isset($active_branch) && $active_branch == $branch ? 'active' : '' }}">{{ $branch->name }}</a>
    @endforeach
</div>