<form method="post" class="form-horizontal">
    {{ csrf_field() }}
    <div class="card-body">

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-input">{{ trans('admin::tag.field.name') }}</label>
            <div class="col-md-9">
                <input type="text" id="text-input" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       placeholder="{{ trans('admin::tag.placeholder.name') }}" value="{{ old('name', $tag->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text-select">{{ trans('admin::tag.field.class') }}</label>
            <div class="col-md-9">
                <select name="class" id="text-select" class="form-control {{ $errors->has('class') ? 'is-invalid' : '' }}">
                    @foreach($tag::CLASSES as $class)
                        <option value="{{ $class }}" {{ old('class', $tag->class) == $class ? 'selected' : '' }}>{{ trans('admin::tag.classes.'.$class) }}</option>
                    @endforeach
                </select>
                @if($errors->has('class'))
                    <div class="invalid-feedback">{{ $errors->first('class') }}</div>
                @endif
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button class="btn btn-sm btn-success">
            <i class="fa fa-dot-circle-o"></i> {{ trans('admin::tag.submit') }}
        </button>
        <button type="reset" class="btn btn-sm btn-danger">
            <i class="fa fa-ban"></i> {{ trans('admin::tag.reset') }}
        </button>
    </div>
</form>