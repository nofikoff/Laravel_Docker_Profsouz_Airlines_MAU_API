<script>
    window.onload = function () {

        var $inherit = $('#checkbox-inherit'),
            $permissions = $('#groupPermission'),
            $select_parent = $('#select_parent'),
            $select_type = $('#select_type');

        $select_parent.on('change', function () {
            var group_id = $(this).val();
            if (group_id) {
                $inherit.closest('.form-group').slideDown();
            } else {
                $inherit.closest('.form-group').slideUp();
            }

            syncTypes();
        });

        function syncTypes(not_set_default) {
            var $selected = $select_parent.children(':selected'),
                available_types = $selected.data('type');

            $select_type.find('option').each(function () {
                var disable = available_types.indexOf($(this).val()) === -1;
                $(this).prop('disabled', disable)
            });

            if(!not_set_default)
                $select_type.val(available_types[0]);
        }

        syncTypes(true);


        @if(isset($branch))
            $inherit.on('change', function () {
                inheritCheck();
            });

            function inheritCheck() {
                if ($inherit.prop('checked')) {
                    $permissions.slideUp();
                } else {
                    $permissions.slideDown();
                }
            }

            function getGroups() {
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.branch.groups', ['id' => $branch->id ]) }}"
                }).done(function (msg) {
                    $('#groupPermission').html(msg)
                });
            }

            getGroups();
            inheritCheck();
        @endif


    }
</script>