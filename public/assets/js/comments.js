$(function () {

    ({
        init: function () {

            this.class_main = '.comments-block';
            this.class_reply = '.comment-reply';
            this.class_edit = '.comment-edit';
            this.class_showcomment = '.show-comments';
            this.class_deletecommentform = '.comment-delete';
            this.class_sendcommentform = '.comment-form';
            this.class_image_comment = '.comment-file';
            this.class_remove_image = '.remove_image';

            this.bind();
            return this;
        },

        openForm: function ($el) {

            if ($el.parent().find(this.class_sendcommentform).length) return false;

            this.setFieldForm($el);

        },

        setFieldForm: function ($el, text, comment_id) {
            var $form = this.getForm($el),
                parent_id = $el.data('id'),
                url = comment_id ? $form.data('url') + '/' + comment_id : $form.data('url');

            $form.attr('action', url);

            if (parent_id) {
                $form.find('input[name="parent_id"]').val(parent_id);
            }

            $form.find('textarea').val(text ? text : '');

            $el.parent().append($form);

            $form.slideDown('slow');
        },

        getForm: function ($el) {
            return $el.closest(this.class_main).find(this.class_sendcommentform).first().clone().hide();
        },

        openFormEdit: function ($el) {
            var comment_id = $el.data('comment_id'),
                text = $el.data('text');
            this.setFieldForm($el, text, comment_id);
        },

        send: function ($form) {

            var _this = this;

            var formData = new FormData($form);
            if($form.find(_this.class_image_comment)[0]) {
                formData.append('image', $form.find(_this.class_image_comment)[0].files[0]);
            }
            formData.append('text', $form.find('textarea').val());
            $form.find('input').each(function (index) {
                if (!$(this).hasClass(_this.class_image_comment)) {
                    formData.append($(this).attr('name'), $(this).val())
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $form.attr('action'),
                method: $form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    _this.update($form, response);
                }
            });

        },

        update: function ($form, html) {

            var $comments_block = $form.closest(this.class_main);

            $comments_block.find('.comments-block-list').html(html);

            var count = $comments_block.find('.comment-item').length;

            $comments_block.closest('.card-footer').find('.show-comments span').text(count ? count : 0);

            $form.find(this.class_remove_image).addClass('hidden')

        },

        getComments: function ($link) {

            var $comments = $link.closest('.card-footer').find('.card-footer-comments');

            if ($comments.children().length) {
                $comments.slideUp(function () {
                    $comments.html('');
                });
                return false;
            }

            $.get($link.attr('href'), function (html) {

                $comments.hide();
                $comments.html($(html));
                $comments.slideDown('slow');

            });

        },

        updateImage: function ($image) {
            if ($image.val()) {
                $image.parent().find('.btn-danger').removeClass('hidden')
            } else {
                $image.parent().find('.btn-danger').addClass('hidden')
            }
        },


        removeImage: function ($btnClose) {
            var _this = this;

            $btnClose.parent().find(_this.class_image_comment).val('')
            $btnClose.addClass('hidden')

        },


        deleteComment: function ($form) {

            this.send($form);

        },

        bind: function () {

            var _this = this;

            $('body').delegate(this.class_reply, 'click', function (e) {

                e.preventDefault();

                _this.openForm($(this));

            });

            $('body').delegate(this.class_edit, 'click', function (e) {

                e.preventDefault();

                _this.openFormEdit($(this));

            });

            $('body').delegate(this.class_showcomment, 'click', function (e) {

                e.preventDefault();

                _this.getComments($(this));

            });


            $('body').delegate(this.class_deletecommentform, 'click', function (e) {

                e.preventDefault();

                _this.deleteComment($(this));

            });


            $('body').delegate(this.class_remove_image, 'click', function (e) {

                e.preventDefault();

                _this.removeImage($(this));

            });


            $('body').delegate(this.class_image_comment, 'change', function (e) {

                e.preventDefault();

                _this.updateImage($(this))
            });


            $('body').delegate(this.class_sendcommentform, 'submit', function (e) {

                e.preventDefault();

                _this.send($(this));

                $(this)[0].reset();

            });


        }

    }).init();

});