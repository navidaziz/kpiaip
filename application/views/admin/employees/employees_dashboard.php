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
        font-size: 12px !important;
        color: black;
        margin: 0px !important;
    }

    .table_s_small>thead>tr>th,
    .table_s_small>tbody>tr>th,
    .table_s_small>tfoot>tr>th,
    .table_s_small>thead>tr>td,
    .table_s_small>tbody>tr>td,
    .table_s_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 9px !important;
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

            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-3">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-9">

                </div>

            </div>


        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-users"></i><?php echo $title; ?> list</h4>

            </div>
            <div class="box-body">




                <div class="table-responsive">
                    <table class="table table_s_small table-bordered" id="employees">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Gender</th>
                                <th>CNIC</th>
                                <th>Personal No</th>
                                <th>Mobile No</th>
                                <th>Emp. Type</th>
                                <th>Designation</th>
                                <th>Scale</th>
                                <th>Joining Date</th>
                                <th>Gross Pay</th>
                                <th>Whit Tax</th>
                                <th>Whst Tax</th>
                                <th>St Duty Tax</th>
                                <th>Rdp Tax</th>
                                <th>Kpra Tax</th>
                                <th>Misc Dedu.</th>
                                <th>Net Pay</th>
                                <th>Leaved</th>
                                <th>Leaved Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT * FROM employees";
                            $rows = $this->db->query($query)->result();
                            foreach ($rows as $row) { ?>
                                <tr <?php if ($row->status == 0) echo 'style="background-color:lightgray !important"'; ?>>
                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->father_name; ?></td>
                                    <td><?php echo $row->gender; ?></td>
                                    <td><?php echo $row->cnic; ?></td>
                                    <td><?php echo $row->personal_no; ?></td>
                                    <td><?php echo $row->mobile_no; ?></td>
                                    <td><?php echo $row->employee_type; ?></td>
                                    <td><?php echo $row->designation; ?></td>
                                    <td><?php echo $row->basi_pay_scale; ?></td>
                                    <td><?php echo $row->joining_date; ?></td>
                                    <td><?php echo $row->gross_pay; ?></td>
                                    <td><?php echo $row->whit_tax; ?></td>
                                    <td><?php echo $row->whst_tax; ?></td>
                                    <td><?php echo $row->st_duty_tax; ?></td>
                                    <td><?php echo $row->rdp_tax; ?></td>
                                    <td><?php echo $row->kpra_tax; ?></td>
                                    <td><?php echo $row->misc_deduction; ?></td>
                                    <td><?php echo $row->net_pay; ?></td>
                                    <td><?php if ($row->status == 0) echo 'Yes'; ?></td>
                                    <td><?php if ($row->status == 0) echo $row->leaved_date; ?></td>
                                    <td><button onclick="get_employee_form('<?php echo $row->employee_id; ?>')">Edit<botton>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <button onclick="get_employee_form('0')" class="btn btn-primary">Add Record</button>
                    </div>
                </div>
                <script>
                    function get_employee_form(employee_id) {
                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'employees/get_employee_form'); ?>",
                                data: {
                                    employee_id: employee_id
                                },
                            })
                            .done(function(respose) {
                                $('#modal').modal('show');
                                $('#modal_title').html('Employees');
                                $('#modal_body').html(respose);
                            });
                    }
                </script>
            </div>


        </div>

    </div>



</div>
<!-- /MESSENGER -->
</div>
<script>
    $(document).ready(function() {
        $('#employees').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: "<?php echo $title; ?>",
            searching: true,
            buttons: [{
                    extend: 'print',
                    title: "<?php echo $title; ?>",
                },
                {
                    extend: 'excelHtml5',
                    title: "<?php echo $title; ?>",

                }
            ]
        });

    });
</script>

<style>
    .dt-buttons {
        padding: 2px !important;
    }
</style>