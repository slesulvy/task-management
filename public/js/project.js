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

// REVERT STYLE WHEN CLICK ADD PROJECT
function addProject($url){
    let element = $('.back-change');
    element[0].style.backgroundColor = '#1ab394';
    element[1].style.backgroundColor = '#1ab394';
    element[0].style.color = '#ffffff';
    element[1].style.color = '#ffffff';
    document.querySelector('.input-group-addon i').style.backgroundColor = '#1ab394';
    // Your code for handling the data you get from the API
    let form = document.getElementById("pr");
    document.getElementById("projectname").value  = '';
    document.getElementById("back_color").value  = '#1ab394';
    document.getElementById("font_color").value  = '#ffffff';
    document.getElementById("description").value  = '';
    document.getElementById("category_id").value  = 1;
    form.setAttribute('action',  $url);
}

function editproject($id, $url) {
    let element = $('.back-change');
    fetch($url)
        .then((resp) => resp.json())
        .then(function(data) {
            console.log(data);
            element[0].style.backgroundColor = data.back_color;
            element[1].style.backgroundColor = data.back_color;
            element[0].style.color = data.font_color;
            element[1].style.color = data.font_color;
            document.querySelector('.input-group-addon i').style.backgroundColor = data.back_color;
            // Your code for handling the data you get from the API
            let form = document.getElementById("pr");
            document.getElementById("projectname").value  = data.projectname;
            document.getElementById("back_color").value  = data.back_color;
            document.getElementById("font_color").value  = data.font_color;
            document.getElementById("description").value  = data['description'];
            document.getElementById("category_id").value  = data.category_id;
            form.setAttribute('action',  $url);
        })
        .catch(function() {
            /*Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                type: 'error',
                confirmButtonText: 'Cool'
            })*/
        });

};