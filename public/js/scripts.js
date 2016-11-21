jQuery(document).ready(function () {

    /*
     Fullscreen background
     */
    $.backstretch([
        "Images/backgrounds/2.jpg"
        , "Images/backgrounds/1.jpg"
        , "Images/backgrounds/3.jpg"
    ], {duration: 3000, fade: 750});

    /*
     Form validation
     */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
        $(this).removeClass('input-error');
    });


});
/*
 End of  Welcome screen Script
 */

// check whether search button clicked
var browse = document.getElementById("browseId");
browse.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        var search = document.getElementById("search").innerHTML;

        $.ajax({
            type: 'get',
            url: ('/browse'),
            data: {'name': name},
            success: function (data) {
                $('#modelEdit').html("");
                $('#modelEdit').html(data);

            }

        });
    }
});


// modal autofocus
$('.modal').on('shown.bs.modal', function () {
    $(this).find('[autofocus]').focus();
});
// Edit the existing brand
function EditBrand(brand, id) {
    document.getElementById("brand").value = brand;
    document.getElementById("id").value = id;


}

function DeleteModel(model) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/model/delete/" + model;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}

function EditModel(id, model, brand, transmission, fuel, capacity, year, country) {

    $('#modelEdit').modal('show');

    document.getElementById("modelM").value = model;
    document.getElementById("brandM").value = brand;
    document.getElementById("transmissionM").value = transmission;
    document.getElementById("fuelM").value = fuel;
    document.getElementById("engineCapacityM").value = capacity;
    document.getElementById("yearM").value = year;

    document.getElementById("countryM").value = country;
    document.getElementById("modelid").value = id;


}


// delete the existing brand
function DeleteBrand(brand) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/brand/delete/" + brand;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}


function EditCategory(id, category) {

    document.getElementById("categoryNameM").value = category;
    document.getElementById("categoryIdM").value = id;

}

function DeleteCategory(category) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/admin/category/delete/" + category;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}
