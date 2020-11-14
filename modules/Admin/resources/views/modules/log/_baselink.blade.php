@switch($log->entity_type)
    @case('post')
    <a href="{{ route('posts.show', ['id' => $log->entity_id]) }}">{{ $log->entity->title }}</a>
    @break
    @case('document')
    <a href="{{ route('documents.download', ['id' => $log->entity_id]) }}">{{ $log->entity->file }}</a>
    @break
@endswitch