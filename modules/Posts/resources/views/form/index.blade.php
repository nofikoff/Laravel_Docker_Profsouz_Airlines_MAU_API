<form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="postForm">

    {{ csrf_field() }}

    @include(implode('.', ['posts::form.types', $type]))

    @if($post->id)
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="comment">{{ trans('posts::form.log_comment') }}</label>
            <div class="col-md-9">
                <textarea id="comment" name="log_comment" class="form-control" rows="6"></textarea>
            </div>
        </div>
    @endif

    <input type="hidden" name="type" value="{{ $type }}">

    <div class="row">
        <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{ trans('posts::form.save') }}</button>
        </div>
    </div>

</form>
<script>
    window.onload = function () {
        var warning_showed = false;

        $('#postForm').submit(function (e) {
            var sms = $('input[name="sms_notify"]').is(':checked');
            var status = $('select[name="status"]').val();
            var branch = $('select[name="branch_id"]').val();
            var branches = JSON.parse('{{{ \Auth::user()->full_access_branch_ids }}}');

            var hasAccess = branches.findIndex(function (b) {
                return parseInt(b) === parseInt(branch)
            })

            if (!sms || warning_showed || status === 'draft' || hasAccess === -1)
                return true;

            user_norififcation('{{ trans('posts::form.sms_warning') }}', '#', 'error')

            warning_showed = true;

            e.preventDefault();
        })
    }
</script>