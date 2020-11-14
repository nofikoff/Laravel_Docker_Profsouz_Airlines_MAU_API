@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('users::notifications.title') }}</div>
                <div class="card-body">
                    @if(count($notifications))
                        @foreach($notifications as $notification)
                            @switch ($notification->entity_type)
                                @case (\Modules\Users\Entities\Notification::TYPE_COMMENT)
                                    @include('users::notifications._post', ['post' => $notification->entity->post])
                                @break

                                @case (\Modules\Users\Entities\Notification::TYPE_POST)
                                    @include('users::notifications._post', ['post' => $notification->entity])
                                @break

                                @case (\Modules\Users\Entities\Notification::TYPE_QUESTION)
                                    @include('users::notifications._post', ['post' => $notification->entity->post])
                                @break

                                @case (\Modules\Users\Entities\Notification::TYPE_DOCUMENT)
                                    @include('users::notifications._document')
                                @break

                                @case (\Modules\Users\Entities\Notification::TYPE_USER)
                                    @include('users::notifications._user')
                                @break

                            @endswitch
                        @endforeach
                    @else
                        {{ trans('users::notifications.not_found') }}
                    @endif
                    {{ $notifications->links('pagination') }}
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush