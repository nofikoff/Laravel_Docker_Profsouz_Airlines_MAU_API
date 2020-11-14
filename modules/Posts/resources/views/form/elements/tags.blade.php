<div class="form-group row">
    <label class="col-md-3 col-form-label" for="tags">{{ trans('posts::form.tags') }}</label>
    <div class="col-md-9">
        <select id="tags" name="tags[]" class="form-control" multiple="">
            @foreach (\Modules\Posts\Entities\Tag::get() as $tag)
            <option value="{{ $tag->id }}" {{ (old('tags') ? collect(old('tags'))->contains($tag->id): $post->tags->contains($tag->id)) ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
</div>