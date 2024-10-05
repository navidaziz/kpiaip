 <form id="scheme_code_update" class="form-horizontal" enctype="multipart/form-data" method="post">
     <input type="hidden" value="<?php echo $expense->expense_id ?>" name="expense_id" />
     <table class="table">
         <tr>
             <td>Any Code For Scheme: </td>
             <td>
                 <input required type="text" value="<?php echo $expense->wua; ?>" name="scheme_code"
                     class="form-control" />
             </td>
             <td>
                 <button type="submit" class="btn btn-primary">Update Data</button>
             </td>
         </tr>
     </table>


 </form>
 </div>

 <script>
$('#scheme_code_update').submit(function(e) {

    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/update_wua_reg_no"); ?>', // URL to submit form data
        data: formData,
        success: function(response) {
            // Display response
            if (response == 'success') {
                location.reload();
            } else {
                $('#result_response').html(response);
            }

        }
    });
});
 </script>