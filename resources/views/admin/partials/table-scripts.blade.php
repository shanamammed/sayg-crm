<script src="{{ asset('/js/vendor.min.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/libs/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/libs/datatables/buttons.print.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/libs/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatables init -->
<script src="{{ asset('/js/pages/datatables.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('/js/app.min.js') }}"></script>

<script type="text/javascript">
    $('#datatable').DataTable({
           "ordering": false
           });
  </script> 
