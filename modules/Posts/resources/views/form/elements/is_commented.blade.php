<div class="form-group row">
    <label class="col-md-3 col-form-label" for="is_commented">{{ trans('posts::form.is_commented') }}</label>
    <div class="col-md-9 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input name="is_commented" type="checkbox" class="form-check-input" id="is_commented" value="1" {{ old('is_commented', $post->is_commented) ? 'checked' : "" }}>
        </div>
    </div>
</div>