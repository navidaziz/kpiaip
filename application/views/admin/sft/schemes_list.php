<style>
    .btn-small {
        padding: 2px !important;
        margin: 1px;
    }
</style>
<div class="table-responsive" style=" overflow-x:auto;">
    <h4>Completed Schemes List</h4>
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
                    "url": "<?php echo base_url(ADMIN_DIR . "sft/scheme_lists"); ?>",
                    "type": "POST",
                    data: {
                        scheme_status: 'Completed',
                        sft_reviewed: <?php if ($tab == 'correction') {
                                            echo '0';
                                        } else {
                                            echo '1';
                                        } ?>
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
                        "data": null,
                        "render": function(data, type, row) {
                            let row_button = '';

                            row_button += `<button onclick="correct_scheme_costs(${row.scheme_id})" class="btn btn-warning btn-small">Review SFT</button>`;
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
                url: "<?php echo site_url(ADMIN_DIR . 'sft/review_sft_data'); ?>",
                data: {
                    scheme_id: scheme_id
                },
            })
            .done(function(respose) {
                $('#modal').modal('show');
                $('#modal_title').html('Update Scheme Cost Detail');
                $('#modal_body').html(respose);
                $('.modal-dialog').css('width', '99%'); // Directly set the width
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