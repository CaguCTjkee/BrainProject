function xhr_complete(dis) {

    var response = dis.responseText;
    if(response) {
        response = JSON.parse(response);
        console.log(response);

        if(response.error !== '')
            alert(response.error);
        else {
            if(typeof response.success !== "undefined") {
                jQuery('input[name="avatar"]').val(response.success);
                jQuery('.cabinet-avatar').attr('src', response.success);
            }
        }
    }
}

jQuery(function() {

    // ajax button
    if(jQuery('.ajax-button').length > 0) {
        jQuery('.ajax-button').attr('type', 'button');
        jQuery('body').append('<form class="ajaxupload hidden" action="/cabinet/upload" method="post" ' +
            'enctype="multipart/form-data">' +
            '<label for="selectfile"><input type="file" name="selectfile" id="selectfile"></label>' +
            '</form>');

        jQuery(document.body).on('click', '.ajax-button', function(e) {
            e.preventDefault();

            jQuery('.ajaxupload label').click();
        });
    }

    // ajax upload
    jQuery(document.body).on('change', '#selectfile', function(e) {
        jQuery('.ajaxupload').submit();
    });
    jQuery(document.body).on('submit', '.ajaxupload', function(e) {

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

            console.log('filename ' + filename);

            var xhr = new XMLHttpRequest();
            if(xhr.upload) {
                xhr.upload.onprogress = function(event) {
                    var done = event.position || event.loaded;
                    var total = event.totalSize || event.total;

                    percent = (Math.floor(done / total * 1000) / 10) + '%';
                    donesave = done;

                    console.log(percent);
                }
            }
            xhr.onreadystatechange = function(e) {
                if(4 == this.readyState) {
                    xhr_complete(this);
                }
            };
            var input = jQuery('#selectfile');
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
});