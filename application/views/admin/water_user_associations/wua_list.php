<div class="table-responsive">
    <h4>Water User Association List
        <div class="pull-right">
            <button onclick="get_water_user_association_form('0')" class="btn btn-success">Add New Water User Assosiation</button>

        </div>


        <script>
            function get_water_user_association_form(water_user_association_id) {
                $.ajax({
                        method: "POST",
                        url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/get_water_user_association_form'); ?>",
                        data: {
                            water_user_association_id: water_user_association_id
                        },
                    })
                    .done(function(respose) {
                        $('#modal').modal('show');
                        if (water_user_association_id == 0) {
                            $('#modal_title').html('Add New Water User Associations');
                        } else {
                            $('#modal_title').html('Update Water User Associations Detail');
                        }
                        $('#modal_body').html(respose);
                    });
            }
        </script>
    </h4>
    <hr />
    <table class="table table_small table-bordered" id="datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>District</th>
                <th>Tehsil</th>
                <th>UC</th>
                <th>Address</th>
                <th>File No.</th>
                <th>WUA Reg. No.</th>
                <th>WUA Name</th>
                <th>Chairman</th>
                <th>Father Name</th>
                <th>Gender</th>
                <th>CNIC</th>
                <th>Contact</th>
                <th>Bank Account Title</th>
                <th>Branch Code</th>
                <th>Bank Account No.</th>
                <th>Schemes</th>
                <th>Cheques</th>
                <th></th>
                <th></th>

            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#datatable").DataTable({

                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url(ADMIN_DIR . "water_user_associations/fetch_wua_list"); ?>",
                    "type": "POST"
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart +
                                1; // Start index from 1
                        }
                    },
                    {
                        "data": "district_name"
                    },

                    {
                        "data": "tehsil_name"
                    },

                    {
                        "data": "union_council"
                    },

                    {
                        "data": "address"
                    },
                    {
                        "data": "file_number"
                    },
                    {
                        "data": "wua_registration_no"
                    },

                    {
                        "data": "wua_name"
                    },
                    {
                        "data": "cm_name"
                    },
                    {
                        "data": "cm_father_name"
                    },
                    {
                        "data": "cm_gender"
                    },
                    {
                        "data": "cm_cnic"
                    },
                    {
                        "data": "cm_contact_no"
                    },
                    {
                        "data": "bank_account_title"
                    },
                    {
                        "data": "bank_branch_code"
                    },
                    {
                        "data": "bank_account_number"
                    },
                    {
                        "data": "total_schemes"
                    },
                    {
                        "data": "total_cheques"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<a style="padding:2px; margin:2xp" class="btn btn-success btn-sm" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_water_user_association/"); ?>' +
                                row.water_user_association_id + '/' +
                                '">View</a>';
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button style="padding:2px; margin:2xp;" class="btn btn-primary btn-sm" onclick="get_water_user_association_form(\'' + row.water_user_association_id + '\')">Edit</button>';
                        }
                    }


                ],

                "lengthMenu": [
                    [15, 25, 50, -1],
                    [15, 25, 50, "All"]
                ],
                "order": [
                    [0, "desc"]
                ],
                "searching": true,
                "paging": true,
                "info": true,
                dom: 'Bfrtip',

                buttons: [{
                        extend: 'excel',
                        title: 'Water User Associations List <?php echo $title ?> - <?php echo date('Y-m-d h:m:s'); ?>'
                    },
                    'pageLength'
                ]
            });
        });
    </script>

</div>