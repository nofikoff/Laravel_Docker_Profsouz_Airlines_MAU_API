<div class="form-group row">
    <label class="col-md-3 col-form-label" for="text-editor">{{ trans('posts::form.body') }}</label>
    <div class="col-md-9">
        <textarea id="text-editor" name="body" rows="9" placeholder="{{ trans('posts::form.body_placeholder') }}">{{ old('body', $post->body) }}</textarea>
    </div>
</div>