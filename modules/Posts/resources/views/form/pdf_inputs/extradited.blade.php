<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_extradited">{{ trans('posts::form.extradited') }}</label>
    <div class="col-md-9">
        <input name="pdf_extradited" type="text"
               class="form-control {{ $errors->has('pdf_extradited') ? 'is-invalid' : '' }}"
               id="pdf_extradited" value="{{ old('pdf_extradited', null) }}">
        @if($errors->has('pdf_extradited'))
            <div class="invalid-feedback">{{ $errors->first('pdf_extradited') }}</div>
        @endif
    </div>
</div>
