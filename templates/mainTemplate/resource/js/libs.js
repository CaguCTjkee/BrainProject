jQuery(function() {

    jQuery('#datetimepicker').datetimepicker({
        // locale: 'ru'
    });

    jQuery(document.body).on('click', '.add-block', function(e) {
        e.preventDefault();

        var parent_class = '.block-parent';
        var content_class = '.block-content';
        var parent = jQuery(this).closest(parent_class);

        var child = parent.find(content_class).first().clone().appendTo(parent);

        child.find('.remove-block').removeClass('hidden');

        // clean form
        if(child.find('.block-remove').length > 0) {
            child.find('.block-remove').addClass('hidden');
        }
        child.find('input[type="text"]').val('');
        child.find('input[type="checkbox"]').prop('checked', false);
        child.find('select').each(function(i, el) {
            el.val(el.find('option:first-child'));
        });

    });

    jQuery(document.body).on('click', '.remove-block', function(e) {
        e.preventDefault();

        var content_class = '.block-content';

        jQuery(this).closest(content_class).remove();

    });

    jQuery(document.body).on('change', '.never-work', function(e) {
        if(jQuery(this).prop('checked')) {
            jQuery('.never-work-hide').addClass('hidden');
        } else {
            jQuery('.never-work-hide').removeClass('hidden');
        }
    });

});