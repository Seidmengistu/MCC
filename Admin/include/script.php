<script src="../../includes/plugins/jquery/jquery.min.js"></script>
<script src="../../includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../includes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../includes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../includes/dist/js/adminlte.min.js"></script>

<script src="../../includes/dist/js/demo.js"></script>

<script>
    $('#abc').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        document.getElementById('deleteId').value = button.data('id');
    });

    $('#pending').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        document.getElementById('pendingId').value = button.data('id');
    });

    $('#approved').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        document.getElementById('approvedId').value = button.data('id');
    });

    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>