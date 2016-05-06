function alertRequests(type, data, id, clear) {
    if (type == 'success') {
        $("#" + id).empty();
        $("#" + id).append('<div class="alert alert-success" role="alert">' + data.messages + '</div>');
        if (clear) {
            clearFields();
        }
    } else {
        $("#" + id).empty();
        $("#" + id).append('<div class="alert alert-warning" role="alert">' + data.responseJSON.messages + '</div>');
    }
}
function clearFields() {
    $("input[type='text']").val("");
    $("input[type='email']").val("");
    $("input[type='number']").val("");
    $("textarea").val("");
}
function colorRequiredFields(data) {
    $.each(data, function (k, v) {
        $("#" + v).css({"background-color": "rgb(255, 214, 214)"});
    });
}