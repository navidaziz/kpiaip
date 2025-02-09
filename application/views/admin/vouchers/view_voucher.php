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
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "vouchers/index/"); ?>">Vouchers List</a>
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
                <!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table id="datatable" class="table  table_small table-bordered">
                        <thead>
                            <tr>
                                <th>Voucher No</th>
                                <th>Voucher Type</th>
                                <th>Voucher Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?php echo $voucher->voucher_no; ?></th>
                                <th><?php echo $voucher->voucher_type; ?></th>
                                <th><?php echo $voucher->voucher_detail; ?></th>
                            </tr>
                        </tbody>
                    </table>

                    <h4 style="margin-bottom: 20px;">Vendor Invoices
                        <span class="pull-right">
                            <button onclick="get_vendor_taxe_form('0')" class="btn btn-warning btn-sm">Add Vendor
                                Invoice</button>
                            <script>
                                function get_vendor_taxe_form(id) {
                                    $.ajax({
                                            method: "POST",
                                            url: "<?php echo site_url(ADMIN_DIR . 'vouchers/get_vendor_taxe_form'); ?>",
                                            data: {
                                                id: id,
                                                scheme_id: 'NULL',
                                                voucher_id: '<?php echo $voucher->voucher_id; ?>',
                                            },
                                        })
                                        .done(function(respose) {
                                            $('#modal').modal('show');
                                            $('#modal_title').html('Vendor Invoice');
                                            $('#modal_body').html(respose);
                                        });
                                }
                            </script>

                        </span>
                    </h4>
                    <table class="table table-bordered table_small" id="vendors_taxes">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Vendor NTN</th>
                                <th>Invoice Id</th>
                                <th>Invoice Date</th>
                                <th>Nature Of Payment</th>
                                <th>Payment Section Code</th>
                                <th>Invoice Gross Total</th>
                                <th>WHIT</th>
                                <th>ST Charged</th>
                                <th>WHST</th>
                                <th>St.Duty</th>
                                <th>RDP</th>
                                <th>KPRA</th>

                                <th>Misc.Dedu.</th>
                                <th>Total Deduction</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT vendors_taxes.*, vendors.TaxPayer_Name, vendors.Vendor_Type, vendors.TaxPayer_NTN 
                            FROM vendors_taxes 
                            INNER JOIN vendors  ON(vendors.vendor_id = vendors_taxes.vendor_id)
                            WHERE voucher_id = '" . $voucher->voucher_id . "'";
                            $rows = $this->db->query($query)->result();
                            foreach ($rows as $row) { ?>
                                <tr>
                                    <td><a href="<?php echo site_url(ADMIN_DIR . 'vouchers/delete_vendors_invoice/' . $row->id); ?>"
                                            onclick="return confirm('Are you sure? you want to delete the record.')"><i
                                                class="fa fa-trash-o"></i></a> </td>
                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $row->TaxPayer_Name; ?><br />
                                        <?php echo $row->Vendor_Type; ?>
                                    </td>
                                    <td><?php echo $row->TaxPayer_NTN; ?></td>
                                    <td><?php echo $row->invoice_id; ?></td>
                                    <td><?php echo $row->invoice_date; ?></td>
                                    <td><?php echo $row->nature_of_payment; ?></td>
                                    <td><?php echo $row->payment_section_code; ?></td>
                                    <td><?php echo $row->invoice_gross_total; ?></td>
                                    <td><?php echo $row->whit_tax; ?></td>
                                    <td><?php echo $row->st_charged; ?></td>
                                    <td><?php echo $row->whst_tax; ?></td>
                                    <td><?php echo $row->st_duty_tax; ?></td>
                                    <td><?php echo $row->rdp_tax; ?></td>
                                    <td><?php echo $row->kpra_tax; ?></td>

                                    <td><?php echo $row->misc_deduction; ?></td>
                                    <td><?php echo $row->total_deduction; ?></td>
                                    <td><button onclick="get_vendor_taxe_form('<?php echo $row->id; ?>')">Edit<botton>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php
                            $count = 1;
                            $query = "SELECT
                            SUM(`invoice_gross_total`) AS invoice_gross_total,
                            SUM(`whit_tax`) AS whit_tax,
                            SUM(`st_charged`) AS st_charged,
                            SUM(`whst_tax`) AS whst_tax,
                            SUM(`st_duty_tax`) AS st_duty_tax,
                            SUM(`kpra_tax`) AS kpra_tax,
                            SUM(`rdp_tax`) AS rdp_tax,
                            SUM(`total_deduction`) AS total_deduction,
                            SUM(`misc_deduction`) AS misc_deduction
                            FROM vendors_taxes 
                            INNER JOIN vendors  ON(vendors.vendor_id = vendors_taxes.vendor_id)
                            WHERE voucher_id = '" . $voucher->voucher_id . "'";
                            $row = $this->db->query($query)->row();
                            ?>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th><?php echo $row->invoice_gross_total; ?></th>
                                <th><?php echo $row->whit_tax; ?></th>
                                <th><?php echo $row->st_charged; ?></th>
                                <th><?php echo $row->whst_tax; ?></th>
                                <th><?php echo $row->st_duty_tax; ?></th>
                                <th><?php echo $row->rdp_tax; ?></th>
                                <th><?php echo $row->kpra_tax; ?></th>

                                <th><?php echo $row->misc_deduction; ?></th>
                                <th><?php echo $row->total_deduction; ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                    <script>
                        title = "Voucher No: <?php echo $voucher->voucher_no; ?>";
                        $(document).ready(function() {
                            $('#vendors_taxes').DataTable({
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
                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>