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
function authenticate()
{
    var formData = new FormData($("#login")[0]);
    $.ajax({
        type: "POST",
        url: "/auth/verifyCredentials",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            window.location.href = data.redirect;
        },
        error: function (data) {
            alertRequests('error', data, 'alert-login');
        }
    });
}
function storeSurvey()
{
    var formData = new FormData($("#createSurvey")[0]);
    $.ajax({
        type: "POST",
        url: '/app/survey/store',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            alertRequests('success', data, 'alert-survey', true);
        },
        error: function (data) {
            alertRequests('error', data, 'alert-survey');
            colorRequiredFields(data.responseJSON.fields);
        }
    });
}

function storeClient()
{
    var formData = new FormData($("#createClient")[0]);
    $.ajax({
        type: "POST",
        url: '/client/store',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            alertRequests('success', data, 'alert-client', true);
        },
        error: function (data) {
            alertRequests('error', data, 'alert-client');
            colorRequiredFields(data.responseJSON.fields);
        }
    });
}