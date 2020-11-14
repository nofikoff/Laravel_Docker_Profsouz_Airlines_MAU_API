<div class="form-group row">
    <label class="col-md-3 col-form-label"
           for="select_type">{{ trans('admin::branch.type') }}</label>
    @if(isset($branch) && $branch->type === \Modules\Posts\Entities\Branch::TYPE_FINN_HELP)
        <div class="col-md-9">
            <input class="form-control" type="text" disabled value="{{ trans('admin::branch.type_'. $branch->type) }}">
        </div>
    @else
        <div class="col-md-9">
            <select id="select_type" name="type" class="form-control">
                @foreach(\Modules\Posts\Entities\Branch::TYPES as $type)
                    <option value="{{ $type }}" {{ isset($branch) && $branch->type === $type ? 'selected' : '' }}>
                        {{ trans('admin::branch.type_'. $type) }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

</div>