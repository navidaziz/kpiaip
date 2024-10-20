<div class="table-responsive">
    <h4>Water User Association List
        <div class="pull-right">
            <a class="btn btn-primary btn-sm"
                href="<?php echo site_url(ADMIN_DIR . "water_user_associations/add"); ?>"><i class="fa fa-plus"></i>
                Add New WUA</a>
            <a class="btn btn-danger btn-sm"
                href="<?php echo site_url(ADMIN_DIR . "water_user_associations/trashed"); ?>"><i
                    class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
        </div>

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
                <th>Action</th>

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
                        return '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/trash/"); ?>' +
                            row.water_user_association_id + '/' +
                            '" onclick="return confirm(\'Are you sure? you want to delete the record.\')"><i class="fa fa-trash-o"></i></a><span style="margin-left: 10px;"></span>' +
                            '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_water_user_association/"); ?>' +
                            row.water_user_association_id + '/' +
                            '"><i class="fa fa-eye"></i></a><span style="margin-left: 10px;"></span>' +
                            '<a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/edit/"); ?>' +
                            row.water_user_association_id + '/' +
                            '"><i class="fa fa-pencil-square-o"></i></a>';
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

            buttons: ['excel', 'pageLength']
        });
    });
    </script>

</div>