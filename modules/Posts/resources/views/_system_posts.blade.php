@foreach(Auth::user()->system_posts as $system_post)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('posts::system_post.title', ['date' => $system_post->created_at->format('d.m.Y')]) }}
                    <div class="card-actions">
                        <form action="{{ route('system_post.delete', compact('system_post')) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn-close"><i class="icon-trash"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    {!! $system_post->body !!}
                </div>
            </div>
        </div>
    </div>
@endforeach