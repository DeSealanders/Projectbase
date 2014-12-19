$(function() {
    $(".textEditor").htmlarea({
        // Override/Specify the Toolbar buttons to show
        toolbar: [
            ["bold", "italic", "underline"],
            ["h2", "h3", "h4", "p"],
            ["link", "unlink"],
            ["html"],
        ],

    });
});
