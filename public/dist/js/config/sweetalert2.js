var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 4000,
});
$(".swalCopied").click(function () {
    Toast.fire({
        icon: "success",
        title: "Copied to clipboard.",
    });
});
$(".swalDefaultSuccess").click(function () {
    Toast.fire({
        icon: "success",
        title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
    });
});
$(".swalDefaultInfo").click(function () {
    Toast.fire({
        icon: "info",
        title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
    });
});
$(".swalDefaultError").click(function () {
    Toast.fire({
        icon: "error",
        title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
    });
});
$(".swalDefaultWarning").click(function () {
    Toast.fire({
        icon: "warning",
        title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
    });
});
$(".swalDefaultQuestion").click(function () {
    Toast.fire({
        icon: "question",
        title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
    });
});
