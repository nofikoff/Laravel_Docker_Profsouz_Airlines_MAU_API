<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_rr">{{ trans('posts::form.rr') }}</label>
    <div class="col-md-9">
        <input name="pdf_rr" type="text" class="form-control {{ $errors->has('pdf_rr') ? 'is-invalid' : '' }}"
               id="pdf_rr" value="{{ old('pdf_rr', null) }}">
        @if($errors->has('pdf_rr'))
            <div class="invalid-feedback">{{ $errors->first('pdf_rr') }}</div>
        @endif
    </div>
</div>
