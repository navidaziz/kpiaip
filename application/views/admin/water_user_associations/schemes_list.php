<style>
    .btn-small {
        padding: 2px !important;
        margin: 1px;
    }
</style>
<div class="table-responsive" style=" overflow-x:auto;">
    <h4><strong><?php echo $tab; ?> Schemes List </strong>
        <span class="pull-right"><?php echo schemes_status_for_list($tab); ?></span>
    </h4>
    <hr />
    <table id="datatable" class="table  table_small table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>District</th>
                <th>WUA</th>
                <th>FY</th>
                <th>Scheme Code</th>
                <th>Scheme Name</th>
                <th>Category</th>
                <th>Sanctioned Cost</th>
                <th>Gross Paid</th>
                <th>Deduction</th>
                <th>Net Paid</th>
                <th>Remaining</th>
                <th>Pay. Count</th>
                <th>ICR-I</th>
                <th>ICR-II</th>
                <th>ICR-I&II</th>
                <th>Other</th>
                <th>FCR</th>
                <th>Note</th>
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
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },
                    {
                        "data": "total_paid",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },
                    {
                        "data": "deduction",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },

                    {
                        "data": "net_paid",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },

                    {
                        "data": "remaining",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
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
                        "data": "first",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },
                    {
                        "data": "second",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },
                    {
                        "data": "first_second",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },
                    {
                        "data": "other",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },
                    {
                        "data": "final",
                        "render": function(data, type, row) {
                            // Format the number here
                            if (!data || isNaN(data)) {
                                return ""; // Fallback to a default value
                            }
                            return parseFloat(data).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                        }
                    },

                    {
                        "data": "scheme_note"
                    },


                    {
                        "data": null,
                        "render": function(data, type, row) {
                            let row_button = '';
                            row_button += `<a class="btn btn-success btn-small" href="<?php echo site_url(ADMIN_DIR . 'water_user_associations/view_scheme_detail/'); ?>${row.wua_id}/${row.scheme_id}">View</a>`;

                            if (row.scheme_status == 'Completed') {
                                row_button += `<button onclick="correct_scheme_costs(${row.scheme_id})" class="btn btn-warning btn-small">Correct Cost</button>`;
                            }

                            return row_button;
                        }
                    }


                ],
                "lengthMenu": [
                    [15, 25, 50, -1],
                    [15, 25, 50, "All"]
                ],
                "order": [
                    [6, "asc"]
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
    function correct_scheme_costs(scheme_id) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/correct_scheme_costs_form'); ?>",
                data: {
                    scheme_id: scheme_id
                },
            })
            .done(function(respose) {
                $('#modal').modal('show');
                $('#modal_title').html('Update Scheme Cost Detail');
                $('#modal_body').html(respose);
            });

    }
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