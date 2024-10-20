<div class="table-responsive" style=" overflow-x:auto;">
    <h4><?php echo $tab; ?> Schemes List</h4>
    <hr />
    <table id="datatable" class="table  table_small table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>District Name</th>
                <th>Wua Reg Code</th>
                <th>Wua Name</th>
                <th>FY</th>
                <th>Scheme Code</th>
                <th>Scheme Name</th>
                <th>Component Category</th>
                <th>Sanctioned Cost</th>
                <th>Net Paid</th>
                <th>Paid Percentage</th>
                <th>Remaining</th>
                <th>Payment Count</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script type="text/javascript">
    $(document).ready(function() {
        document.title =
            "<?php echo $schemestatus; ?> Schemes lists (Date:<?php echo date('d-m-Y h:m:s') ?>)";
        $("#datatable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(ADMIN_DIR . "water_user_associations/scheme_lists"); ?>",
                "type": "POST",
                data: {
                    scheme_status: '<?php echo $schemestatus; ?>',
                },
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings
                            ._iDisplayStart +
                            1; // Start index from 1
                    }
                },

                {
                    "data": "district_name"
                },

                {
                    "data": "wua_reg_code"
                },

                {
                    "data": "wua_name"
                },
                {
                    "data": "financial_year"
                },
                {
                    "data": "scheme_code"
                },

                {
                    "data": "scheme_name"
                },

                {
                    "data": "component_category"
                },

                {
                    "data": "sanctioned_cost",
                    "render": function(data, type, row) {
                        // Format the number here
                        return parseFloat(data).toLocaleString(
                            'en-US', {
                                minimumFractionDigits: 2
                            });
                    }
                },

                {
                    "data": "paid",
                    "render": function(data, type, row) {
                        // Format the number here
                        return parseFloat(data).toLocaleString(
                            'en-US', {
                                minimumFractionDigits: 2
                            });
                    }
                },

                {
                    "data": "paid_percentage"
                },

                {
                    "data": "remaining",
                    "render": function(data, type, row) {
                        // Format the number here
                        return parseFloat(data).toLocaleString(
                            'en-US', {
                                minimumFractionDigits: 2
                            });
                    }
                },

                {
                    "data": "payment_count"
                },


                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_scheme_detail/"); ?>' +
                            row.wua_id + '/' + row.scheme_id +
                            '"><i class="fa fa-eye"></i> View</a>';
                    }
                }

            ],
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            "order": [
                [0, "asc"]
            ],
            "searching": true,
            "paging": true,
            "info": true,
            dom: "Bfrtip",

            buttons: ["excel", "pageLength"]
        });
    });
    </script>




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