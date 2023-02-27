function addField() {
    if ($("#photo div").length < 12) {
        var photo = $("div#photo_0").html();

        if ($("#photo div").length == 2) {
            p_id = 1;
        } else {
            p_id = parseInt($('#photo div').last().attr('id').replace(/[^0-9]/gi, '')) + 1;
        }
        $("div#photo").append(photo);

        $('div#photo').children().last().attr('id', "p_" + p_id);
        $('#p_' + p_id).find('i').attr('onclick', "deleteField(" + p_id + ")");
    } else {
        alert("Не более 10 фото!")
    }

}
function deleteField(p_id) {
    var id = '#p_' + p_id
    $(id).remove();
    var id = '#p_hid_' + p_id
    $(id).remove();
}

function ShowPopup(id) {
    $('#popup_' + id).show();
    $('.overlay_popup').show();
}

function cancelDW() {
    $('.overlay_popup, .popup').hide();
}

function ShowPass() {
    if ($("input#showpass").hasClass("view")) {
        $("input#showpass").removeClass('view');
        $("input#password").attr('type', 'password');
    } else {
        $("input#showpass").addClass('view');
        $("input#password").removeAttr('type');
    }
}
function ShowGroupings() {
    if (parseInt($('#location_id').val()) == 0) {
        $("#location_id").focus();
    } else {
        var id = parseInt($('#location_id').val());
        $("#location_id_hide").removeAttr('disabled');
        $('#location_id_hide').val(id);
        $("#location_id").attr('disabled', 'disabled');
        $("#groupings_" + id).removeClass('hide');
    }
}

function UpdateGrouping() {
    var id = parseInt($('#location_id').val());
    $("#groupings_" + id).addClass('hide');
    $('#location_id').val(0);
    $("#location_id").removeAttr('disabled');
    $("#location_id_hide").attr('disabled', 'disabled');
    $('#location_id_hide').val('');
}

// $("div#photo_0").hide();
// $('.show_popup').click(function() { // Вызываем функцию по нажатию на кнопку
//     var popup_id = $('#' + $(this).attr("rel")); // Связываем rel и popup_id
//     $(popup_id).show(); // Открываем окно
//     $('.overlay_popup').show(); // Открываем блок заднего фона
// })
// $('.overlay_popup').click(function() { // Обрабатываем клик по заднему фону
//     $('.overlay_popup, .popup').hide(); // Скрываем затемнённый задний фон и основное всплывающее окно
// })