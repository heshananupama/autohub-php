/**
 * Created by Heshan on 10/21/2016.
 */

$(document).ready(function () {

    $('.alert-autocloseable-success').hide();

    $('#date').datepicker({
        maxDate: new Date,
        dateFormat: "yy-mm-dd"
    });
    // $("#datepicker").datepicker({ maxDate: new Date, minDate: new Date(2007, 6, 12) });

    $('#yearPicker').datepicker({
        maxDate: new Date,
        dateFormat: "yy"
    });

    $('#reportFrequency').attr('disabled', 'disabled');


    $('#monthPicker').datepicker({
        maxDate: new Date,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm ',
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });


});

$('div.alert').delay(5000).slideUp(300);

function getBrands(name) {
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


function getNewModels() {

    var name = $("#brandDropdown option:selected").text();

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

function getEditModels() {

    var name = $("#brandEdit option:selected").text();

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

function EditSpare(id, partNumber, description, brandName, quantity, cost, price, warranty, category) {
    document.getElementById("partNumberEdit").value = partNumber;
    $("#brandEdit option:contains(" + brandName + ")").attr('selected', 'selected');

    //document.getElementById("brandEdit").value=brandName;
    getEditModels();
    document.getElementById("warrantyEdit").value = warranty;

    $("#categoryEdit option:contains(" + category + ")").attr('selected', 'selected');


    document.getElementById("quantityEdit").value = quantity;
    document.getElementById("descriptionEdit").value = description;
    document.getElementById("costEdit").value = cost;

    document.getElementById("priceEdit").value = price;

    document.getElementById("EditSpareId").value = id;


    $('#modalEditSpare').modal('show');

}


// delete the existing spare
function DeleteSpare(spare) {
    $('#confirm-delete').modal('show');
    $('#confirm-delete').on('click', '.btn-ok', function (e) {
        window.location.href = "/retailer/spares/delete/" + spare;
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
}

function showChangeOrderStatusModal(orderItemId) {
    document.getElementById("orderItemId").value = orderItemId;
    $('#modalOrderItem').modal('show');


}

function changeOrderStatus() {
    var orderItemId = document.getElementById("orderItemId").value;
    var orderItemStatus = $('#orderItemStatus').val();
    $.ajax({
        type: 'get',
        url: ('/retailer/orders/changeStatus'),
        data: {
            'orderItemId': orderItemId,
            'orderItemStatus': orderItemStatus,

        },
        success: function (data) {
            window.location.replace(window.location.pathname + window.location.search + window.location.hash);

            $('#modalOrderItem').modal('hide');
            document.getElementById('successMessage').innerHTML = data;
            $('#autoclosable-btn-success').prop("disabled", true);
            $('.alert-autocloseable-success').show();

            $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
                // Animation complete.
                $('#autoclosable-btn-success').prop("disabled", false);
            });
        }

    });
}

function makeReply(user_id,orderItem_id) {
    $('#customerId').val(user_id);
    $('#orderItemId').val(orderItem_id);

    $('#modalMessage').modal('show');


}

function replyCustomer() {
    var message = $('textarea#message').val();
    var customerId = $('#customerId').val();
    var retailerId = $('#retailerId').val();

    $.ajax({
        type: 'get',
        url: ('/retailer/enquiries/newReply'),
        data: {
            'message': message,
            'customerId': customerId,
            'retailerId': retailerId,

        },
        success: function (data) {

            $('#modalMessage').modal('hide');
            document.getElementById('successMessage').innerHTML = data;
            $('#autoclosable-btn-success').prop("disabled", true);
            $('.alert-autocloseable-success').show();

            $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
                // Animation complete.
                $('#autoclosable-btn-success').prop("disabled", false);
            });
        }

    });


}

function replyCustomerComplain() {
    var message = $('textarea#message').val();
    var customerId = $('#customerId').val();
    var retailerId = $('#retailerId').val();
    var orderItemId= $('#orderItemId').val();

    $.ajax({
        type: 'get',
        url: ('/retailer/complains/newReply'),
        data: {
            'message': message,
            'customerId': customerId,
            'retailerId': retailerId,
            'orderItem':orderItemId,

        },
        success: function (data) {

            $('#modalMessage').modal('hide');
            document.getElementById('successMessage').innerHTML = data;
            $('#autoclosable-btn-success').prop("disabled", true);
            $('.alert-autocloseable-success').show();

            $('.alert-autocloseable-success').delay(5000).fadeOut("slow", function () {
                // Animation complete.
                $('#autoclosable-btn-success').prop("disabled", false);
            });
        }

    });


}

function pdfToHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#splitForPrint')[0];
    specialElementHandlers = {
        '#bypassme': function (element, renderer) {
            return true
        }
    }
    margins = {
        top: 50,
        left: 60,
        width: 545
    };
    pdf.fromHTML(
        source // HTML string or DOM elem ref.
        , margins.left // x coord
        , margins.top // y coord
        , {
            'width': margins.width // max width of content on PDF
            , 'elementHandlers': specialElementHandlers
        },
        function (dispose) {
            // dispose: object with X, Y of the last line add to the PDF
            //          this allow the insertion of new lines after html
            pdf.save('html2pdf.pdf');
        }
    )
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

function activateReportingPeriod(value) {
    document.getElementById('reportingPeriodDropDown').style.visibility = 'visible';

    // $('#reportFrequency option[value="daily"]').attr("disabled", false);

    $('#reportFrequency').removeAttr('disabled');

    if (value == "orders") {
        // $('#reportFrequency option[value="daily"]').attr("disabled", true);

    }
    if (value == "inventory") {
        document.getElementById('reportingPeriodDropDown').style.visibility = 'hidden';

    }
}

function activateReportDateSelect(value) {
    document.getElementById('dateInput').style.visibility = 'hidden';
    document.getElementById('monthInput').style.visibility = 'hidden';
    document.getElementById('yearInput').style.visibility = 'hidden';

    if (value == "daily") {
        document.getElementById('dateInput').style.visibility = 'visible';

    }
    else if (value == "monthly") {
        document.getElementById('monthInput').style.visibility = 'visible';

    }
    else if (value == "yearly") {
        document.getElementById('yearInput').style.visibility = 'visible';

    }
    else {
        document.getElementById('dateInput').style.visibility = 'hidden';
        document.getElementById('monthInput').style.visibility = 'hidden';
        document.getElementById('yearInput').style.visibility = 'hidden';

    }
}

