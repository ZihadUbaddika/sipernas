$(function () {
    $(".select2").select2();
    $(".select2bs4").select2({
        theme: "bootstrap4",
        maximumSelectionLength: 10,
        placeholder:"Silahkan pilih",
    })
    $(".select2bs4RO").select2({
        theme: "bootstrap4",
        readOnly:true,
    }).attr("disabled", true); ;
    $(".select-all")
        .select2("destroy")
        .find("option")
        .prop("selected", "selected")
        .end()
        .select2();
    $(".deselect-all")
        .select2("destroy")
        .find("option")
        .prop("selected", false)
        .end()
        .select2();
});
