/**
 * Created by Heshan on 10/21/2016.
 */
function getBrands(name){
    $.ajax({
        type: 'get',
        url: ('/retailer/spares/getModels'),
        data: {'brandName': name},
        success: function (data) {
             $('#model').html("");
            $('#model').html(data);
            removeDupilcatesModels();

        }


    });

}


function getNewModels(name){
    $.ajax({
        type: 'get',
        url: ('/retailer/spares/getModels'),
        data: {'brandName': name},
        success: function (data) {
            $('#newModel').html("");
            $('#newModel').html(data);
            removeDupilcatesNewModels();

        }

    });

}

function removeDupilcatesNewModels() {
    var usedNames = {};
    $("select[name='newModel'] > option").each(function () {
        if(usedNames[this.text]) {
            $(this).remove();
        } else {
            usedNames[this.text] = this.value;
        }
    });

}

function removeDupilcatesModels() {
    var usedNames = {};
    $("select[name='model'] > option").each(function () {
        if(usedNames[this.text]) {
            $(this).remove();
        } else {
            usedNames[this.text] = this.value;
        }
    });

}

function getNewYears(name){
    $.ajax({
        type: 'get',
        url: ('/retailer/spares/getYears'),
        data: {'brandName': name},
        success: function (data) {
            console.log(data);
            $('#newYear').html("");
            $('#newYear').html(data);
        }

    });


}