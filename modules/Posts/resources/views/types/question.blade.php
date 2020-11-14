@if($post->question)

    @if($post->question->closed && !$post->question->is_expired && !$post->question->winner_id)
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <b><i class="icon-clock"></i> {{ trans('posts::question.expiration_date') }}:</b>
                {{ $post->question->expiration_at }}
            </div>
        </div>
    @endif


    @can('set_winner', $post->question)

        @include('admin::modules.vote.components._set_winner')

    @else

        @if(!$post->question->winner_id)
            <form action="{{ route('posts.question.vote') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group row">
                    <div class="col-md-12">

                        @php($user_vote_option_id = $post->question->getUserVoteOptionId())

                        @foreach($post->question->options as $k=>$option)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{ $option->id }}"
                                       id="{{ implode('-', ['option', $option->post_question_id, $option->id]) }}"
                                       name="question_option_id"
                                        {{ $user_vote_option_id == $option->id ? 'checked' : '' }}
                                        {{ $user_vote_option_id ? 'disabled' : '' }}
                                >
                                <label class="form-check-label"
                                       for="{{ implode('-', ['option', $option->post_question_id, $option->id]) }}">{{ $option->name }}</label>
                            </div>
                        @endforeach

                    </div>
                </div>
                @if(!$user_vote_option_id)
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-sm btn-primary">{{ trans('posts::question.vote') }}</button>
                        </div>
                    </div>
                @endif
            </form>
        @else
            <div class="alert alert-success">{{ trans('posts::question.winner', ['winner' => $post->question->winner->name]) }}</div>

            <div id="votes-chart-{{ $post->question->id }}"><div>
        @endif
    @endcan

@endif

@push('css')
    <link href="{{ asset('assets/vendors/css/rumca.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('assets/vendors/js/rumca.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var question = @json($post->question->options);
            var axisX = ["10%", "20%", "30%", "40%", "50%", "60%", "70%", "80%", "90%", "100%"];

            var total_votes = question.reduce(function (prev, current) {
                return prev + current.votes_count
            }, 0);

            var axisY = [];
            var barsValue = [];

            question.forEach(function (e) {
                axisY.push(e.name);
                barsValue.push(total_votes ? (e.votes_count * 100 / total_votes) : 0);
            });

            // Data to charts
            var data = {
                "axisY": axisY,         // Data for axis Y labels
                "axisX": axisX,         // Data for axis X labels
                "bars": barsValue       // Data for bars value
            };

            var options = {
                data: data,                       // Object with data
                animation: true,                // Status of animation
                animationOffset: 0,             // Offset for animation (in px)
                animationRepeat: true,          // Repeat animation
                showValues: true,               // Status for showing value in bars
                showArrows: false,              // Arrows for axis
                showHorizontalLines: false,     // Status for showing horizontal helper lines
                labelsAboveBars: true           // Labels above bars (axis Y)
            };

            $('#votes-chart-' + question[0].post_question_id).rumcaJS(options);
        });
    </script>
@endpush
