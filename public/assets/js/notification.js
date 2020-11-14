function user_norififcation(message, url, type) {

    new Noty({
        theme: 'relax',
        timeout: 15000,
        type: type ? type : 'success',
        layout: 'topRight',
        callbacks: {
            onTemplate: function () {
                this.barDom.innerHTML = '' +
                    '<div class="noty_body">' + message + '</div>' +
                    '<a href="' + url + '" style="position: absolute; display: block; width: 100%; height: 100%; top: 0; left: 0;"></a>' +
                    '<div class="noty_progressbar"></div>';
            }
        }
    }).show();

}