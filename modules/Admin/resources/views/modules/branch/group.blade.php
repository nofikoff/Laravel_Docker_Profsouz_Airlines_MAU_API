@foreach($groups as $child)
    <option value="{{ $child->id }}">{{ $child->name }}</option>
@endforeach