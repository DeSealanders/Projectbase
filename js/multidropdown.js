// Initiate the options list for multidropdowns
var options = [];

$(document).ready(function () {

    // Used for adding multidropdown rows
    $('.add a').click(function() {
        var dropdown = $(this).parent().prev('.multidropdown');

        // Duplicate dropdown
        var newdropdown = dropdown.clone();

        // Add 1 to name attribute
        newdropdown.children('select').each(function() {
            var name = $(this).attr('name');
            var pattern = /\[(\d*)\]/g;
            var res = name.replace(pattern, addOne);
            $(this).attr('name', res)

            // Update selectlist options
            updateIfSubSelectList($(this));
        });

        // Insert after previous dropdown
        newdropdown.insertAfter(dropdown);

        // Show delete option
        newdropdown.find('.remove').removeClass('undeleteable');
    });

    // Used for removing multidropdown rows
    $(document.body).on('click', '.remove a' ,function(){
        var dropdown = $(this).parent().parent();
        if(!dropdown.find('.remove').hasClass('undeleteable')) {
            dropdown.remove();
        }
    });

    // Initialize each list by updating them
    $('.multidropdown select').each(function() {
        var id = $(this).attr('id');
        if(id.substr(id.length-3,3) != "-id") {
            var subselect = $(this).next($('#' + id + '-id'));

            // Update the subselectlist if it does not have values
            if(subselect.val() == null) {
                updateSelectList($(this));
            }
        }
    });

    // Update each multidropdown selectlist when options change
    $(document.body).on('change', '.multidropdown select' ,function(){
        updateIfSubSelectList($(this));
    });

});


function addOne(str, p1, offset, s) {
    return '[' + (parseInt(p1) + 1) + ']';
}

function updateIfSubSelectList(selectList) {
    var id = selectList.attr('id');
    if(id.substr(id.length-3,3) != "-id") {
        updateSelectList(selectList);
    }
}

function updateSelectList(categorySelect) {

    // Get the id of the category selector
    var id = categorySelect.attr('id');

    // Get the category id
    var category = categorySelect.val();

    // Get the sub-selectlist
    var selectlist = categorySelect.next($('#' + id + '-id'));

    // Clear the sub-selectlist
    selectlist.empty();

    // Add all options to the sub-selectlist
    $.each(options[id][category], function(index, value) {
        selectlist.append('<option selected="selected" value=' + index + '>' + value + '</option>');
    });
}

function addOptions(id, optionlist) {
    options[id] = optionlist;
}