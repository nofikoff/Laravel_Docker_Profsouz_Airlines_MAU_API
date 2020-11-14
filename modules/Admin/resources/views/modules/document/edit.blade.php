@extends('admin::layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.document.edit', $document->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">{{ trans('documents::master.form-document') }}</label>
                            <div class="col-md-9">
                                <input type="file" id="file-input" name="file" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">{{ trans('documents::master.form-category') }}</label>
                            <div class="col-md-9">
                                <select name="category_id" class="form-control">
                                    @foreach ($branches as $branch)

                                        <option value="{{ $branch->id }}"{{ ($document->branch_id === $branch->id) ? ' selected' : '' }}>{{ $branch->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="description">{{ trans('documents::master.form-description') }}</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="description" name="description">{{ $document->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">{{ trans('documents::master.form-tags') }}</label>
                            <div class="col-md-9">
                                <select name="tags[]" class="form-control" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ (old('tags') ? collect(old('tags'))->contains($tag->id): $document->tags->contains($tag->id)) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">{{ trans('documents::master.form-status') }}</label>
                            <div class="col-md-9">
                                <select name="status" class="form-control">
                                    @foreach (\Modules\Documents\Entities\Document::statuses() as $status)
                                        <option value="{{ $status }}"{{ (old('status') == $status) ? ' selected' : ($document->status == $status) ? ' selected' : '' }}>
                                            {{ trans('documents::master.status-' . $status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-3">
                                <div class="form-check checkbox">
                                    <input class="form-check-input" type="checkbox" value="1" id="check1" name="importance"
                                            {{ $document->importance ? ' checked' : '' }}>
                                    <label class="form-check-label" for="check1">
                                        {{ trans('documents::master.form-importance') }}
                                    </label>
                                </div>
                                <div class="form-check checkbox">
                                    <input class="form-check-input" type="checkbox" value="1" id="check2" name="notify"
                                            {{ $document->is_notify ? ' checked' : '' }}>
                                    <label class="form-check-label" for="check2">
                                        {{ trans('documents::master.form-notify') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-3">
                                <button type="submit" class="btn btn-block btn-success">
                                    <i class="icon-pencil"></i> {{ trans('documents::master.button-edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection