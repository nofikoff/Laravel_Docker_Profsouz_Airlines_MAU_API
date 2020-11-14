<div class="card-header">
    <div class="row">
        <div class="col-md-10">
            <form action="{{ route('search') }}" class="form-inline my-2 my-lg-0 mx-auto">
                <div style="width:100%;">
                    <div class="input-group">
                        <input type="text" id="search" name="search" class="form-control"
                               placeholder="{{ trans('search.placeholder') }}" value="{{ request('search') }}">
                        <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary"
                                            style="margin-top: 0;">{{ trans('users::pages.search-button') }}</button>
                                </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2 text-right" style="margin-top:6px;">

            @php($disable_create = $disable_create ?? false )

            <div class="btn-group">
                @if(isset($active_branch) && $active_branch->is_finn_help)
                    <a type="button" class="btn btn-success"
                       href="{{ route('posts.create', ['type' => \Modules\Posts\Entities\Post::TYPE_FINN_HELP]) }}">
                        {{ trans('posts::list.create') }} </a>
                @else
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"> {{ trans('posts::list.create') }} </button>
                    <div class="dropdown-menu">
                        @foreach(\Modules\Posts\Entities\Post::types() as $type)
                            <a class="dropdown-item"
                               href="{{ route('posts.create', compact('type')) }}">
                                {{ trans('posts::list.create_'.$type) }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>