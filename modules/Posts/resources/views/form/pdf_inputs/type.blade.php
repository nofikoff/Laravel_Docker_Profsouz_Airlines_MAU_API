<div class="form-group row">
    <label class="col-md-3 col-form-label" for="status">
        {{ trans('posts::form.status') }}
    </label>
    <div class="col-md-9">
        <select id="status" name="status" class="form-control">
            {{--@foreach(( isset($statuses) ? $statuses : \Modules\Posts\Entities\Post::formStatuses() ) as $status)--}}
            {{--<option {{ old('status', $post->status) == $status ? "selected" : "" }} value="{{ $status }}">{{ trans('posts::form.'.$status) }}</option>--}}
            {{--@endforeach--}}
        </select>
    </div>
</div>