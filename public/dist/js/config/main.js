$(".addTujuan").click(function () {
    var html = "";
    html += '<div class="row" id="tujuanChild">';
    html += '<div class="col-md-12">';
    html +=
        '<div class="form-group {{ $errors->has("tujuan") ? "has-error" : "" }}">';
    html += '<div class="row">';
    html += '<div class="col-md-10">';
    html +=
        '<input type="text" id="tujuan" name="tujuan[]" class="form-control">';
    html += "</div>";
    html += '<div class="col-md-2">';
    html +=
        '<button type="button" class="form-control btn btn-sm btn-danger hapusTujuan"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    $("#addedTujuan").append(html);
});
$(document).on("click", ".hapusTujuan", function () {
    $(this).closest("#tujuanChild").remove();
});
$(".addDasar").click(function () {
    var html = "";
    html += '<div class="row" id="dasarChild">';
    html += '<div class="col-md-12">';
    html +=
        '<div class="form-group {{ $errors->has("dasar") ? "has-error" : "" }}">';
    html += '<div class="row">';
    html += '<div class="col-md-10">';
    html +=
        '<input type="text" id="dasar" name="dasar[]" class="form-control">';
    html += "</div>";
    html += '<div class="col-md-2">';
    html +=
        '<button type="button" class="form-control btn btn-sm btn-danger hapusDasar"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    $("#addedDasar").append(html);
});
$(document).on("click", ".hapusDasar", function () {
    $(this).closest("#dasarChild").remove();
});
$(".addTembusan").click(function () {
    var html = "";
    html += '<div class="row" id="tembusanChild">';
    html += '<div class="col-md-12">';
    html +=
        '<div class="form-group {{ $errors->has("tembusan") ? "has-error" : "" }}">';
    html += '<div class="row">';
    html += '<div class="col-md-10">';
    html +=
        '<input type="text" id="tembusan" name="tembusan[]" class="form-control">';
    html += "</div>";
    html += '<div class="col-md-2">';
    html +=
        '<button type="button" class="form-control btn btn-sm btn-danger hapusTembusan"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    $("#addedTembusan").append(html);
});
$(document).on("click", ".hapusTembusan", function () {
    $(this).closest("#tembusanChild").remove();
});
$(".addPerintah").click(function () {
    var html = "";
    html += '<div class="row" id="perintahChild">';
    html += '<div class="col-md-12">';
    html +=
        '<div class="form-group {{ $errors->has("perintah") ? "has-error" : "" }}">';
    html += '<div class="row">';
    html += '<div class="col-md-10">';
    html +=
        '<input type="text" id="perintah" name="perintah[]" class="form-control">';
    html += "</div>";
    html += '<div class="col-md-2">';
    html +=
        '<button type="button" class="form-control btn btn-sm btn-danger hapusPerintah"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    $("#addedPerintah").append(html);
});
$(document).on("click", ".hapusPerintah", function () {
    $(this).closest("#perintahChild").remove();
});
$("#tgl_terbitPicker").datetimepicker({
    icons: { time: "far fa-clock" },
    defaultDate: Date.now(),
    format:'DD/MM/YYYY',
});
$("#tgl_submitPicker").datetimepicker({
    icons: { time: "far fa-clock" },
    defaultDate: Date.now(),
    format:'DD/MM/YYYY',
});
