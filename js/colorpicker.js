$(document).ready(function () {

    // Color picker options
    $('.color-box').colpick({
        colorScheme:'light',
        layout:'hex',
        onChange:function(hsb,hex,rgb,el) {
            setColors(hex, el);
        },
        onSubmit:function(hsb,hex,rbg,el) {
            setColors(hex, el);
            $(el).colpickHide();
        }
    })

    // Color picker initial style
    $('.color-box').each(function() {
        var color = $(this).data("color");
        $(this).css('background-color', '#'+color);
        $(this).colpickSetColor(color, true);
    })

    function setColors(hex, el) {
        var color = '#'+hex;
        var id = $(el).attr('id');
        $(el).css('background-color', color);
        $('input#' + id).val(color);
    }
});