$(document).ready(function () {

    // Color picker options
    $('.color-box').colpick({
        colorScheme:'light',
        layout:'hex',
        onChange:function(hsb,hex,rgb,el) {
            var color = '#'+hex;
            var id = $(el).attr('id');
            $(el).css('background-color', color);
            $('input#' + id).val(color);
        },
        onSubmit:function(hsb,hex,rbg,el) {
            $(el).colpickHide();
        }
    })

    // Color picker initial style
    $('.color-box').each(function() {
        var color = $(this).data("color");
        $(this).css('background-color', '#'+color);
        $(this).colpickSetColor(color, true);
    })
});