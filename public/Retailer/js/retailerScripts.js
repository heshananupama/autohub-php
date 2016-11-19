/**
 * Created by Heshan on 10/21/2016.
 */

$('div.alert').delay(5000).slideUp(300);

function getBrands(name){
    $.ajax({
        type: 'get',
        url: ('/retailer/spares/getModels'),
        data: {'brandName': name},
        success: function (data) {
             $('#model').html("");
            $('#model').html(data);

        }


    });

}


function getNewModels(){

    var name= $("#brandDropdown option:selected").text();

    $.ajax({
        type: 'get',
        url: ('/retailer/spares/getModels'),
        data: {'brandName': name},
        success: function (data) {
            $('#newModel').html("");
            $('#newModel').html(data);

        }

    });

}

function getEditModels(){

    var name= $("#brandEdit option:selected").text();

    $.ajax({
        type: 'get',
        url: ('/retailer/spares/getModels'),
        data: {'brandName': name},
        success: function (data) {
            $('#modelEdit').html("");
            $('#modelEdit').html(data);

        }

    });

}

function EditSpare(id,partNumber,description,brandName,quantity,price,warranty) {
    document.getElementById("partNumberEdit").value=partNumber;
    $("#brandEdit option:contains(" + brandName + ")").attr('selected', 'selected');

    //document.getElementById("brandEdit").value=brandName;
    getEditModels();
    document.getElementById("warrantyEdit").value=warranty;
    document.getElementById("quantityEdit").value=quantity;
    document.getElementById("descriptionEdit").value=description;
    document.getElementById("priceEdit").value=price;

    document.getElementById("EditSpareId").value=id;



    $('#modalEditSpare').modal('show');

}


// delete the existing spare
function DeleteSpare(spare) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function(e) {
        window.location.href = "/retailer/spares/delete/"+spare;
        $modalDiv.addClass('loading');
        setTimeout(function() {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });}