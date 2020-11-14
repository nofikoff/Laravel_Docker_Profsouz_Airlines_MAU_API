<div class="form-group row">
    <label class="col-md-3 col-form-label" for="name">{{ trans('posts::form.title') }}</label>
    <div class="col-md-9">
        <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="name" placeholder="{{ trans('posts::form.title_placeholder') }}" value="{{ old('title', $post->title) }}">
        @if($errors->has('title'))
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>
</div>
