/**
 * Created by Heshan on 10/21/2016.
 */

$(document).ready(function () {

    $('.alert-autocloseable-success').hide();

});

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

function EditSpare(id,partNumber,description,brandName,quantity,price,warranty,category) {
    document.getElementById("partNumberEdit").value=partNumber;
    $("#brandEdit option:contains(" + brandName + ")").attr('selected', 'selected');

    //document.getElementById("brandEdit").value=brandName;
    getEditModels();
    document.getElementById("warrantyEdit").value=warranty;

    $("#categoryEdit option:contains(" + category + ")").attr('selected', 'selected');


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
    });
}

function showChangeOrderStatusModal(orderItemId) {
    document.getElementById("orderItemId").value=orderItemId;
    $('#modalOrderItem').modal('show');


}

function changeOrderStatus() {
    var orderItemId=document.getElementById("orderItemId").value;
    var orderItemStatus= $('#orderItemStatus').val();
    $.ajax({
        type: 'get',
        url: ('/retailer/orders/changeStatus'),
        data: {
            'orderItemId':orderItemId,
            'orderItemStatus':orderItemStatus,

        },
        success: function (data) {
            window.location.replace(window.location.pathname + window.location.search + window.location.hash);

            $('#modalOrderItem').modal('hide');
            document.getElementById('successMessage').innerHTML=data;
            $('#autoclosable-btn-success').prop("disabled", true);
            $('.alert-autocloseable-success').show();

            $('.alert-autocloseable-success').delay(5000).fadeOut( "slow", function() {
                // Animation complete.
                $('#autoclosable-btn-success').prop("disabled", false);
            });
        }

    });
}

function makeReply(user_id) {
    $('#modalMessage').modal('show');
     $('#customerId').val(user_id);


}

function replyCustomer() {
    var message = $('textarea#message').val();
    var customerId=  $('#customerId').val();
    var retailerId= $('#retailerId').val();

    $.ajax({
        type: 'get',
            url: ('/retailer/enquiries/newReply'),
        data: {
            'message':message,
            'customerId':customerId,
            'retailerId':retailerId,

        },
        success: function (data) {

            $('#modalMessage').modal('hide');
            document.getElementById('successMessage').innerHTML=data;
            $('#autoclosable-btn-success').prop("disabled", true);
            $('.alert-autocloseable-success').show();

            $('.alert-autocloseable-success').delay(5000).fadeOut( "slow", function() {
                // Animation complete.
                $('#autoclosable-btn-success').prop("disabled", false);
            });
        }

    });


}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}