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
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "sub_components/view/"); ?>"><?php echo $this->lang->line('Sub Components'); ?></a>
                </li>
                <li><?php echo $sub_component->sub_component_name; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $sub_component->component_name; ?> - <?php echo $sub_component->sub_component_name; ?></h3>
                    </div>
                    <div class="description"> <?php echo $sub_component->sub_component_detail; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" style="cursor: pointer;" onclick="component_category(0)"><i class="fa fa-plus"></i> Add New Category</button>
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
                <h4><i class="fa fa-bell"></i> <?php echo $sub_component->component_name; ?> - <?php echo $sub_component->sub_component_name; ?> Categories List</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="db_table">
                        <thead>


                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Account Code</th>
                                <th>Category Type</th>
                                <th>Categories (<?php echo $sub_component->component_name; ?> - <?php echo $sub_component->sub_component_name; ?>)</th>
                                <th>Categories Detail</th>
                                <th>Material Share</th>
                                <th>Farmer Share</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>



                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT * FROM component_categories WHERE status IN (0,1) 
                            AND sub_component_id = '" . $sub_component->sub_component_id . "'
                            ORDER BY category ASC";
                            $component_categories = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($component_categories as $component_category) : ?>

                                <tr>
                                    <td><a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "component_categories/trash/" . $component_category->component_category_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    <td><?php echo $count++; ?></td>
                                    <td>
                                        <?php echo $component_category->account_code; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->main_heading; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->category; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->category_detail; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->material_share; ?> %
                                    </td>
                                    <td>
                                        <?php echo $component_category->farmer_share; ?> %
                                    </td>
                                    <td>
                                        <?php echo $component_category->target_unit; ?>
                                    </td>



                                    <td>

                                        <a style="cursor: pointer;" class="llink llink-edit" onclick="component_category(<?php echo $component_category->component_category_id; ?>)"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
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
    var title = '<?php echo  $sub_component->component_name; ?> - <?php echo $sub_component->sub_component_name;  ?>';

    function component_category(component_category_id) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'sub_components/sub_component_category_form'); ?>",
                data: {
                    component_category_id: component_category_id,
                    project_id: '<?php echo $sub_component->project_id; ?>',
                    component_id: '<?php echo $sub_component->component_id; ?>',
                    sub_component_id: '<?php echo $sub_component->sub_component_id; ?>',
                },
            })
            .done(function(respose) {
                $('#modal').modal('show');
                $('#modal_title').html(title);
                $('#modal_body').html(respose);
            });
    }
</script>

<script>
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