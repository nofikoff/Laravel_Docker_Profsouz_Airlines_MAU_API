<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pages-title">{{ trans('admin::pages.title') }}</label>
    <div class="col-md-9">
        <input type="text" id="pages-title" name="title" class="form-control" value="{{ $page->title }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="text-editor">{{ trans('admin::pages.text') }}</label>
    <div class="col-md-9">
        <textarea name="text" id="text-editor" cols="30" rows="10">{{ old('text', $page->text) }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="page-hide">{{ trans('admin::pages.hide') }}</label>
    <div class="col-md-9">
        <input type="checkbox" value="1" name="hide" {{ old('hide', $page->hide) ? 'checked' : '' }}>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-9 offset-md-3">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> {{ trans('admin::pages.submit') }}
        </button>
    </div>
</div>