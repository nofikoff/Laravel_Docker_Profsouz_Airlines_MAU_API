<script>
    window.onload = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setTimeout(function () {
            $.ajax({
                method: "POST",
                url:"{{ route('user.notifications') }}",
            })
        }, 500)
    }
</script>