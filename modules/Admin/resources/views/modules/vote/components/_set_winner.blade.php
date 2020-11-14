@foreach($post->question->getVotesResult() as $option)
    <div>{{ $option->name }} ({{ $option->votes_count }})
        @if($post->status == \Modules\Posts\Entities\Post::STATUS_PUBLISHED)
            <span class="badge">

                    <form action="{{ route('admin.vote.action') }}" data-text="{{ trans('admin::master.confirm') }}"
                          method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="option_id" value="{{ $option->id }}">
                        <button onclick="return confirm('{{ trans('admin::master.confirm') }}')" type="submit"
                                class="btn btn-link m-0 p-0"
                                style="vertical-align: middle; line-height: 1;">{{ trans('admin::vote.link-winner') }}</button>
                    </form>

                </span>
        @endif
    </div>
    <div class="progress mb-3">

        <div class="progress-bar" role="progressbar" style="width: {{ $option->percent }}%"
             aria-valuenow="{{ $option->percent }}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
@endforeach