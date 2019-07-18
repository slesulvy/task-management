$(function() {
    let bgpicker = $('#bgpicker').colorpicker();
    let fgpicker = $('#fgpicker').colorpicker();
    let element = $('.back-change');

    bgpicker.on('changeColor', function(e) {
        element[0].style.backgroundColor = e.color.toString(
            'rgba');
        element[1].style.backgroundColor = e.color.toString(
            'rgba');
    });

    fgpicker.on('changeColor', function(e) {
        element[0].style.color = e.color.toString(
            'rgba');
        element[1].style.color = e.color.toString(
            'rgba');
    });

});