@if($post->question)

    @include('admin::modules.vote.components._bar')

    @include('admin::modules.vote.components._set_winner')

@endif