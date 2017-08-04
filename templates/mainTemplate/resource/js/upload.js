function xhr_complete(dis) {
    jQuery('form').show();
    var response = dis.responseText;
    if(response) {
        response = jQuery.parseJSON(response);
        jQuery('#response').removeClass()
        .addClass((response.status == 1) ? 'upload-success' : 'upload-error')
        .html(response.result);

        if(response.result_tpl !== null) {
            jQuery('.result').html(response.result_tpl);
        }
    }
}

jQuery(function() {

    // ajax button
    if(jQuery('.ajax-button').length > 0) {
        jQuery('.ajax-button')
    }

    // ajax upload
    if(jQuery('.ajaxupload').length > 0) {
        jQuery('#selectfile').on('change', function(e) {
            filename = jQuery(this).val();
            if(filename.substring(3, 11) == 'fakepath') {
                filename = filename.substring(12);
            }// remove c:\fake at beginning from localhost chrome
            jQuery('#response').removeClass().text(filename);
        });
        jQuery('.ajaxupload').on('submit', function(e) {

            // test
            errors = false;

            filename = jQuery('#selectfile').val();
            if(filename.substring(3, 11) == 'fakepath') {
                filename = filename.substring(12);
            }// remove c:\fake at beginning from localhost chrome

            if(filename == '') {
                errors = true;
                jQuery('#response').removeClass().addClass('upload-error').html('Файл не выбран');
            }

            if(!errors) {
                var donesave = 0;
                jQuery('#response').removeClass().addClass('upload-progress').html('<div class="progress-bar"></div><div class="progress-percent"></div>');

                var xhr = new XMLHttpRequest();
                if(xhr.upload) {
                    xhr.upload.onprogress = function(event) {
                        var done = event.position || event.loaded;
                        var total = event.totalSize || event.total;

                        percent = (Math.floor(done / total * 1000) / 10) + '%';
                        speed = ((done - donesave) / 1024 / 1024 / 8).toFixed(2) + ' мб&frasl;сек';
                        donesave = done;

                        jQuery('.progress-bar').css('width', percent);
                        jQuery('.progress-percent').html(filename + ' - ' + percent + ' ' + speed);
                    }
                }
                xhr.onreadystatechange = function(e) {
                    if(4 == this.readyState) {
                        xhr_complete(this);
                    }
                };
                var input = jQuery('input[name=file]');
                var file = input[0].files[0];
                var url = input.closest('form').prop('action');
                xhr.open('POST', url);

                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                var formData = new FormData();
                formData.append("file", file);

                xhr.send(formData);
                e.preventDefault();
            }
            return false;
        });
    }
});