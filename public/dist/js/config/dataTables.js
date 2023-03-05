$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $("#example2").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  $("#example3").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
  $("#example4").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
  $('#example5').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});