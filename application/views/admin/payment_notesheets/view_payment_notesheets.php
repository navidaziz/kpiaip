<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">


                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
            </div>
            <div class="box-body">

                <div class="table-responsive">


                    <table id="datatable" class="table  table_small table-bordered">
                        <thead>
                            <tr>
                                <th>Payment Notesheet Code</th>
                                <th>PUC Tracking ID</th>
                                <th>District</th>
                                <th>PUC Title</th>
                                <th>PUC Detail</th>
                                <th>PUC Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $payment_notesheet->payment_notesheet_code; ?></td>
                                <td><?php echo $payment_notesheet->district_name; ?></td>
                                <td><?php echo $payment_notesheet->puc_title; ?></td>
                                <td><?php echo $payment_notesheet->puc_detail; ?></td>
                                <td><?php echo $payment_notesheet->puc_date; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="errorDiv" class="box border blue" id="messenger" style="background-color:white; padding:4px; text-align:right ">
                        Search Scheme ID:
                        <input class="form-control" style="width: 200px; display:inline" type="text" id="scheme_id" placeholder="Scan barcode here" autofocus />
                        <div style="margin-top: 5px;" id="scheme_id_response"></div>

                    </div>

                    <script>
                        // Function to handle the barcode data
                        function handleBarcode(barcode) {
                            alert("Barcode Scanned: " + barcode);
                            // Additional processing can be added here
                        }

                        // Add event listener for the input field
                        const barcodeInput = document.getElementById('scheme_id');
                        barcodeInput.addEventListener('keyup', function(event) {
                            $('#scheme_id_response').html('');
                            if (event.key === 'Enter') {
                                var scheme_id = $('#scheme_id').val();
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo site_url(ADMIN_DIR . "payment_notesheets/seacrch_by_scheme_id"); ?>', // URL to submit form data
                                    data: {
                                        scheme_id: scheme_id,
                                        payment_notesheet_id: '<?php echo $payment_notesheet->id ?>'
                                    },
                                    success: function(response) {

                                        if (response != 'not_found') {

                                            if (response == 'success') {
                                                get_payment_notesheet_list();
                                            }
                                            $('#scheme_id').val('');
                                            $('#scheme_id_response').fadeOut(200, function() {
                                                $(this).html(response).fadeIn(200);
                                            });
                                        } else {

                                            $('#scheme_id_response').fadeOut(200, function() {
                                                $(this).html('<div class="alert alert-danger">Tracking No: <strong>' + scheme_id + '</strong> Not Found. Try Again</div>').fadeIn(200);
                                            });
                                            triggerBuzz('errorDiv');
                                        }


                                    }
                                });
                            }
                        });
                    </script>
                </div>

                <strong>Payment List</strong>
                <div id="puc_list">

                </div>

                <script>
                    function get_payment_notesheet_list() {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url(ADMIN_DIR . "payment_notesheets/get_payment_notesheet_list"); ?>', // URL to submit form data
                            data: {
                                payment_notesheet_id: '<?php echo $payment_notesheet->id ?>'
                            },
                            success: function(response) {
                                $('#puc_list').html(response);
                            }
                        });
                    }

                    get_payment_notesheet_list();
                </script>



            </div>


        </div>

    </div>
</div>
<!-- /MESSENGER -->
</div>