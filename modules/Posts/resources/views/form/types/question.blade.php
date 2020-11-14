@include('posts::form.elements.branches')
@include('posts::form.elements.title')

<input type="hidden" name="is_commented" value="0">

<div class="form-group row">
    <label class="col-md-3 col-form-label">{{ trans('posts::form.options') }}</label>
    <div class="col-md-9 question-options">
        @foreach(is_array(old('options')) ? old('options') : ($post->question ? $post->question->options : ['']) as $option)
            <div class="row">
                <div class="col-md-10">
                    <input name="options[]" type="text" class="form-control" id="name"
                           placeholder="{{ trans('posts::form.option_placeholder') }}"
                           value="{{ !is_object($option) ? (string)$option : $option->name }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger remove-option" type="button"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        @endforeach

    </div>
</div>

<div class="form-group row">
    <div class="col-md-9 offset-md-3 text-center">
        <button class="btn btn-success add-option" type="button"><i
                    class="fa fa-plus"></i> {{ trans('posts::form.add_new_option') }}</button>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="expiration_at">{{ trans('posts::form.expiration_at') }}</label>
    <div class="col-md-9">
        <input name="expiration_at" type="text" class="form-control date-input" id="expiration_at"
               placeholder="{{ trans('posts::form.expiration_at_placeholder') }}"
               value="{{ old('expiration_at', optional($post->question)->expiration_at ?? '') }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="default_option">{{ trans('posts::form.default_option_id') }}</label>
    <div class="col-md-9 col-form-label">
        <select name="default_option" id="default_option" class="question-default-option form-control" data-selected="{{ old('default_option', $post->question->default_option->name ?? '') }}">
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="question_closed">{{ trans('posts::form.question_closed') }}</label>
    <div class="col-md-9 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input name="closed" type="checkbox" class="form-check-input" id="question_closed" value="1" {{ old('question_closed', $post->question->closed ?? '') ? 'checked' : "" }}>
        </div>
    </div>
</div>

@include('posts::form.elements.attachments')
<div class="form-group row">
    <label class="col-md-3 col-form-label">{{ trans('posts::form.importance') }}</label>
    <div class="col-md-9 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" type="radio" id="importance-false" value="1" name="importance" checked>
            <label class="form-check-label" for="importance-false">{{ trans('posts::form.importance_high') }}</label>
        </div>
    </div>
</div>
@include('posts::form.elements.status')
@include('posts::form.elements.infostate')
{{--@include('posts::form.elements.tags')--}}

@include('posts::form.elements.sms_notify')
{{--@include('posts::form.elements.in_top')--}}


@push('js')
<script>
    var questionOptionHtml = '<div class="row"><div class="col-md-10"><input name="options[]" type="text" class="form-control" id="name" placeholder="{{ trans('posts::form.option_placeholder') }}"></div> <div class="col-md-2"><button class="btn btn-danger remove-option" type="button"><i class="fa fa-minus"></i></button></div></div>';
</script>
<script src="{{ asset('assets/js/question-form.js') }}"></script>
@endpush
