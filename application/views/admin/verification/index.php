<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 10px !important;
        color: black;
        margin: 0px !important;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>

                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>

                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-4">
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
                </div>

                <div class="col-md-8">




                </div>

            </div>


        </div>
    </div>
</div>
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> Cheque Verification</h4>
            </div>
            <div class="box-body">
                <div style="text-align: center;">
                    <label for="cheque_no" class="control-label">Search By Cheque No.</label>
                    <hr />
                    <input id="cheque_no" type="text" class="form-control" style="display: inline; width:300px" name="cheque_no" />
                    <button onclick="search_cheque($('#cheque_no').val())" type="submit" class="btn btn-success">Search Cheque</button>
                </div>

                <script>
                    $(document).ready(function() {
                        // Call search_cheque when Enter key is pressed
                        $('#cheque_no').keypress(function(event) {
                            if (event.which === 13) { // 13 = Enter key
                                event.preventDefault(); // Prevent form submission
                                search_cheque($('#cheque_no').val());
                            }
                        });
                    });

                    // The function now only accepts cheque_no as parameter
                    function search_cheque(cheque_no) {
                        // Check if cheque_no is empty
                        if (cheque_no.trim() === '') {
                            alert('Please enter a cheque number.');
                            $('#cheque_no').focus();
                            return false;
                        }

                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'verification/search_cheque'); ?>",
                                data: {
                                    cheque_no: cheque_no, // Pass the cheque number dynamically
                                },
                            })
                            .done(function(response) {
                                console.log(response);
                                $('#modal').modal('show');
                                $('#modal_title').html('Cheque Detail');
                                $('#modal_body').html(response);
                            });
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> Scheme Verification</h4>
            </div>
            <div class="box-body">
                <div style="text-align: center;">
                    <label for="scheme_code" class="control-label">Search By Scheme Code</label>
                    <hr />
                    <input id="scheme_code" type="text" class="form-control" style="display: inline; width:300px" name="scheme_code" />
                    <button onclick="search_cheque($('#scheme_code').val())" type="submit" class="btn btn-danger">Search Scheme</button>
                </div>

                <script>
                    $(document).ready(function() {
                        // Call search_cheque when Enter key is pressed
                        $('#scheme_code').keypress(function(event) {
                            if (event.which === 13) { // 13 = Enter key
                                event.preventDefault(); // Prevent form submission
                                search_cheque($('#scheme_code').val());
                            }
                        });
                    });

                    // The function now only accepts cheque_no as parameter
                    function search_cheque(scheme_code) {
                        // Check if cheque_no is empty
                        if (scheme_code.trim() === '') {
                            alert('Please enter a Scheme Code.');
                            $('#scheme_code').focus();
                            return false;
                        }

                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'verification/search_scheme'); ?>",
                                data: {
                                    scheme_code: scheme_code, // Pass the cheque number dynamically
                                },
                            })
                            .done(function(response) {
                                console.log(response);
                                $('#modal').modal('show');
                                $('#modal_title').html('Scheme Detail');
                                $('#modal_body').html(response);
                            });
                    }
                </script>
            </div>
        </div>
    </div>
</div>