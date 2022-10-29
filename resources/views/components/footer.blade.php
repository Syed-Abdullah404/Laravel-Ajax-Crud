<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
            BootstrapDash.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights
            reserved.</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="vendors/chart.js/Chart.min.js"></script>
<script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/dashboard.js"></script>
<script src="js/Chart.roundedBarCharts.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('#brand').change(function() {
            let bid = jQuery(this).val();
            jQuery.ajax({
                url: '/getModel',
                type: 'post',
                data: 'bid=' + bid + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#model').html(result)
                }

            });
        });
    });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('#brandes').change(function() {
            let bid = jQuery(this).val();
            jQuery.ajax({
                url: '/getModel2',
                type: 'post',
                data: 'bid=' + bid + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#modeles').html(result)
                }

            });
        });
    });
</script>

<script>
    // add new Product ajax request
    $("#add_product_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_product_btn").text('Adding...');
        $.ajax({
            url: '{{ route('store') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res);

                if (res.status == 400) {
                    $('#saveform_errList').html("");
                    $('#saveform_errList').addClass('alert alert-danger');
                    $.each(res.error, function(key, err_values) {
                        $('#saveform_errList').append('<li>' + err_values + '</li>');
                    });
                } else if (res.status == 200) {
                    swal.fire(
                        'Added!',
                        'Employee Added Successfully',
                        'success'
                    )


                    fetchAllEmployees();
                    $('#saveform_errList').removeClass('alert alert-danger');
                    $('#saveform_errList').html("");

                    $("#add_product_form")[0].reset();
                    $("#add_product_btn").text('Add Employee');
                    $("#exampleModal").modal('hide');
                }
            }
        });
    });
</script>





<script>
    $("#edit_product_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_product_btn").text('Updating...');
        $.ajax({
            url: '{{ route('update') }}',

            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(responses) {
                if (responses.status == 200) {
                    Swal.fire(
                        'Updated!',
                        'Employee Updated Successfully!',
                        'success'
                    )
                    fetchAllEmployees();
                }
                $("#edit_product_btn").text('Update Employee');
                $("#edit_product_form")[0].reset();
                $("#editEmployeeModal").modal('hide');
            }
        });
    });
</script>




<script>
    $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '{{ route('edit') }}',
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                $("#name").val(response.name);
                $("#brandes").val(response.brand);
                $("#modeles").val(response.model);
                $("#amount").val(response.amount);
                $("#date").val(response.date);

            }
        });
    });
</script>





<script>
    fetchAllEmployees();

    function fetchAllEmployees() {
        $.ajax({
            url: '{{ route('fetchAll') }}',
            method: 'get',
            success: function(response) {
                $("#show_all_products").html(response);

            }
        });
    }
</script>


<script>
    $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('delete') }}',
                    method: 'delete',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        fetchAllEmployees();
                    }
                });
            }
        })
    });
</script>






{{-- brand --}}

<script>
  // add new Product ajax request
  $("#add_brand_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $("#add_brand_btn").text('Adding...');
      $.ajax({
          url: '{{ route('storebrand') }}',
          method: 'post',
          data: fd,
          cache: false,
          processData: false,
          contentType: false,
          success: function(res) {
              console.log(res);

              if (res.status == 400) {
                  $('#savebrand_errList').html("");
                  $('#savebrand_errList').addClass('alert alert-danger');
                  $.each(res.error, function(key, err_values) {
                      $('#savebrand_errList').append('<li>' + err_values + '</li>');
                  });
              } else if (res.status == 200) {
                  swal.fire(
                      'Added!',
                      'Brand Added Successfully',
                      'success'
                  )


                  fetchAllEmployees();
                  $('#savebrand_errList').removeClass('alert alert-danger');
                  $('#savebrand_errList').html("");

                  $("#add_brand_form")[0].reset();
                  $("#add_brand_btn").text('Add Brand');
                  $("#AddBrand").modal('hide');
              }
          }
      });
  });
</script>




<!-- End custom js for this page-->
</body>

</html>
