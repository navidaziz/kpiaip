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

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- PAGE MAIN CONTENT -->
<div class="row">
    <div class="col-md-2">
        <span>Expenses Purpose</span>
        <select class="e_filter" style="width: 100%;" name="states[]" multiple="multiple">
            <?php
            $query = "SELECT e.purpose FROM expenses as e GROUP BY e.purpose";
            $options = $this->db->query($query)->result();
            foreach ($options as $option) { ?>
                <option value="<?php echo $option->purpose; ?>"><?php echo $option->purpose; ?></option>
            <?php  } ?>
        </select>
    </div>
    <div class="col-md-2">
        <span>Financial Years</span>
        <select class="e_filter" style="width: 100%;" name="states[]" multiple="multiple">
            <?php
            $query = "SELECT e.financial_year FROM expenses as e GROUP BY e.financial_year";
            $options = $this->db->query($query)->result();
            foreach ($options as $option) { ?>
                <option value="<?php echo $option->financial_year; ?>"><?php echo $option->financial_year; ?></option>
            <?php  } ?>
        </select>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.e_filter').select2();
    });
</script>
<hr />

<div class="row">

    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-money"></i> Expenses List</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="db_table">
                        <thead>

                            <th>#</th>
                            <th>ID</th>

                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT * FROM expenses limit 10";
                            $expenses = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($expenses as $expense) : ?>

                                <tr>

                                    <td><?php echo $count++; ?></td>
                                    <th><?php echo $expense->expense_id; ?></th>




                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>




                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>




<script>
    title = "Expenses";
    $(document).ready(function() {
        $('#db_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                },
                {
                    extend: 'excelHtml5',
                    title: title,

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',

                }
            ]
        });
    });
</script>