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


    $('#quickForm').validate({
    rules: {
      from: {
        required: true,
        
      },
      to: {
        required: true,
        minlength: 5
      },
      reason: {
        required: true
      },
      importer: {
        required: true
      },
      importertin: {
        required: true
      },
      agent: {
        required: true
      },
      agenttin: {
        required: true
      },
      risklevel: {
        required: true
      },
      section: {
        required: true
      },
      declarationnumber: {
        required: true
      },
      goodsdescription: {
        required: true
      },
      officername: {
        required: true
      },
      code: {
        required: true
      },
      signature: {
        required: true
      },
      approvedby: {
        required: true
      },
      reasontoexamine: {
        required: true
      },
      Recipant_Name: {
        required: true
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
    
        $(document).ready(function() {
            $(".searchh-close").on("click", function() {
                $(".main-searchh .form-control").animate({
                    width: "0"
                }), setTimeout(function() {
                    $(".main-searchh").removeClass("open")
                }, )
            })
        }), $(document).ready(function() {


        }), $(".theme-loader").fadeOut("slow", function() {
            $(this).remove()
        })
</script>