function clientEditForm(id) {
    $.ajax({
        url: "./controller/editClient.php",
        method: "post",
        data: { record: id },
        success: function (data) {
            $('.content-wrapper').html(data);
        }
    });
}

function updateClient() {
    var client_id = $('#client_id').val();
    var driving_license_no = $('#driving_license_no').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var tel_no = $('#tel_no').val();
    var fd = new FormData();
    fd.append('client_id', client_id);
    fd.append('driving_license_no', driving_license_no);
    fd.append('fname', fname);
    fd.append('lname', lname);
    fd.append('tel_no', tel_no);

    $.ajax({
        url: './controller/updateClient.php',
        method: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function (data) {
            alert('Update Success.');
            $('form').trigger('reset');
        }
    });
}

function clientDelete(id) {
    $.ajax({
        url: "./controller/deleteClient.php",
        method: "post",
        data: { record: id },
        success: function (data) {
            alert('Successfully deleted');
            $('form').trigger('reset');
            location.reload();
        }
    });
}

function rentalDelete(id) {
    $.ajax({
        url: "../../controller/deleteRental.php",
        method: "post",
        data: { record: id },
        success: function (data) {
            alert('Successfully deleted');
            $('form').trigger('reset');
            location.reload();
        }
    });
}

function carDelete(id) {
    $.ajax({
        url: "../../controller/deleteCar.php",
        method: "post",
        data: { record: id },
        success: function (data) {
            alert('Successfully deleted');
            $('form').trigger('reset');
            location.reload();
        }
    });
}

function brandDelete(id) {
    $.ajax({
        url: "../../controller/deleteBrand.php",
        method: "post",
        data: { record: id },
        success: function (data) {
            alert('Successfully deleted');
            $('form').trigger('reset');
            location.reload();
        }
    });
}

function addressEditForm(id1, id2) {
    $.ajax({
        url: "../../controller/editAddress.php",
        method: "post",
        data: {
            record1: id1,
            record2: id2
        },
        success: function (data) {
            $('.content-wrapper').html(data);
        }
    });
}

function updateAddress() {
    var zipcode = $('#zipcode').val();
    var district = $('#district').val();
    var province = $('#province').val();
    var fd = new FormData();
    fd.append('zipcode', zipcode);
    fd.append('district', district);
    fd.append('province', province);

    $.ajax({
        url: '../../controller/updateAddress.php',
        method: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function (data) {
            alert('Update Success.');
            $('form').trigger('reset');
        }
    });
}

function addressDelete(id1, id2) {
    $.ajax({
        url: "../../controller/deleteAddress.php",
        method: "post",
        data: {
            record1: id1,
            record2: id2
        },
        success: function (data) {
            alert('Successfully deleted');
            $('form').trigger('reset');
            location.reload();
        }
    });
}

function cardDelete(id) {
    $.ajax({
        url: "../../controller/deleteCard.php",
        method: "post",
        data: { record: id },
        success: function (data) {
            alert('Successfully deleted');
            $('form').trigger('reset');
            location.reload();
        }
    });
}

