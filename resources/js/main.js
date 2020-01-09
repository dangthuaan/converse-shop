$(document).ready(function() {
    //Color Picker
    var colorPicker = function() {
        $(".color-desc .color").on('click', function(event) {
            event.preventDefault();
            $(this).toggleClass('selected');
        });
    };

    //Size Picker
    var sizePicker = function() {
        $(".size-desc .size").on('click', function(event) {
            event.preventDefault();
            $(this).toggleClass('selected');
        });
    };

    //Style Picker
    var stylePicker = function() {
        $(".list-desc .list").on('click', function(event) {
            event.preventDefault();
            $(this).toggleClass('selected');
        });
    };

    colorPicker();
    sizePicker();
    stylePicker();
});
