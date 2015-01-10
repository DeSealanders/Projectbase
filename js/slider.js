$(document).ready(function () {

    // Initially update all sliders
    $('input[type=range]').each(function() {
        updateSlider($(this));
    });

    // Update slider displayvalue when value changes
    $('input[type=range]').on("change mousemove", function() {
        updateSlider($(this));
    });


});

function updateSlider(slider) {
    var rangedisplay = slider.next('.slidervalues').find('.rangedisplay');
    rangedisplay.text(slider.val());
}