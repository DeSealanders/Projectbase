$(document).ready(function () {

    // Toggle infoblocks on clickable cick
    $('.clickable').click(function() {
        $(this).next('.infoblock').slideToggle('slow', 'swing');
    });

    // Hide by default
    $('.infoblock').hide();

});