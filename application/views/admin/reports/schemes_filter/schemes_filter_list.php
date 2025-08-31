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

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li>
                            <i class="fa fa-file"></i>
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>


            </div>


        </div>
    </div>
</div>




<!-- Include jQuery and Select2 CSS/JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Include DataTables JS (ensure it's after jQuery) -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- buttons -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">

                    <form id="filterForm">
                        <table class="table table-striped table_small">
                            <tr>
                                <th>Financial Year</th>
                                <th>Regions</th>
                                <th>Districts</th>
                                <!-- <th>Components</th> -->
                                <th>NA</th>
                                <th>PK</th>
                                <th>Tehsils</th>
                                <th>UC</th>
                                <th>Scheme Status</th>
                                <th>Component Categories</th>
                                <th>Date Filter By</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Filter</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $query = "SELECT fy.financial_year, e.financial_year_id  FROM expenses as e 
                                                    INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                                                    GROUP BY fy.financial_year_id";
                                    $fys = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="financial_year_ids[]" id="financial_year_ids" multiple="multiple">
                                        <?php foreach ($fys as $fy) { ?>
                                            <option value="<?php echo $fy->financial_year_id; ?>"><?php echo $fy->financial_year; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT region FROM  districts as d 
                                    WHERE is_district = 1
                                    GROUP BY d.region ASC";
                                    $regions = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="regions[]" id="regions" multiple="multiple">
                                        <?php foreach ($regions as $region) { ?>
                                            <option value="<?php echo $region->region; ?>"><?php echo $region->region; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#regions').on('change', function() {
                                                let selectedRegion = $(this).val(); // Get selected region(s)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_district_by_region"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        region: selectedRegion
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        // Get already selected district IDs
                                                        let selectedDistricts = $('#district_ids').val() || [];

                                                        // Clear existing options
                                                        $('#district_ids').empty().trigger('change');

                                                        // Populate dropdown while excluding already selected districts
                                                        let districtOptions = [];
                                                        $.each(data, function(key, district) {
                                                            if (!selectedDistricts.includes(district.district_id.toString())) {
                                                                districtOptions.push(new Option(district.district_name, district.district_id, false, false));
                                                            }
                                                        });

                                                        // Add new options and trigger Select2 update
                                                        $('#district_ids').append(districtOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching districts. Please try again.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT d.district_name, d.district_id  FROM  districts as d 
                                    WHERE is_district = 1
                                    GROUP BY d.district_name";
                                    $districts = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="district_ids[]" id="district_ids" multiple="multiple">
                                        <?php foreach ($districts as $district) { ?>
                                            <option value="<?php echo $district->district_id; ?>"><?php echo $district->district_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#district_ids').on('change', function() {
                                                let selectedDistrict = $(this).val(); // can be string or array
                                                // ----- Fetch NAs -----
                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_nas_by_district"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        district: selectedDistrict
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {

                                                        let selectedNas = $('#nas').val() || [];
                                                        $('#nas').empty().trigger('change');

                                                        let nasOptions = [];
                                                        // $.each(data, function(key, nas) {
                                                        //     if (!selectedNas.includes(nas.na.toString())) {
                                                        //         nasOptions.push(new Option(nas.na, nas.na, false, false));
                                                        //     }
                                                        // });

                                                        $.each(data, function(key, nas) {
                                                            // handle NULL values safely
                                                            let naValue = (nas.na === null) ? '' : nas.na.toString();
                                                            let naLabel = (nas.na === null) ? 'N/A' : nas.na; // text shown in dropdown

                                                            if (!selectedNas.includes(naValue)) {
                                                                nasOptions.push(new Option(naLabel, naValue, false, false));
                                                            }
                                                        });

                                                        $('#nas').append(nasOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching NAs. Please try again.');
                                                    }
                                                });

                                                // ----- Fetch PKs -----
                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_pks_by_district"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        district: selectedDistrict
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        let selectedPks = $('#pks').val() || [];
                                                        $('#pks').empty().trigger('change');

                                                        let pksOptions = [];
                                                        $.each(data, function(key, pks) {
                                                            // handle NULL values safely
                                                            let pkValue = (pks.pk === null) ? '' : pks.pk.toString();
                                                            let pkLabel = (pks.pk === null) ? 'N/A' : pks.pk; // text shown in dropdown

                                                            if (!selectedPks.includes(pkValue)) {
                                                                pksOptions.push(new Option(pkLabel, pkValue, false, false));
                                                            }
                                                        });

                                                        $('#pks').append(pksOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching PKs. Please try again.');
                                                    }
                                                });


                                                // ----- Fetch Tehsils -----
                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_tehsils_by_district"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        district: selectedDistrict
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        let selectedPks = $('#tehsils').val() || [];
                                                        $('#tehsils').empty().trigger('change');

                                                        let tehsilsOptions = [];
                                                        $.each(data, function(key, tehsils) {
                                                            // handle NULL values safely
                                                            let tehsilValue = (tehsils.tehsil === null) ? '' : tehsils.tehsil.toString();
                                                            let tehsilLabel = (tehsils.tehsil === null) ? 'N/A' : tehsils.tehsil; // text shown in dropdown

                                                            if (!selectedPks.includes(tehsilValue)) {
                                                                tehsilsOptions.push(new Option(tehsilLabel, tehsilValue, false, false));
                                                            }
                                                        });

                                                        $('#tehsils').append(tehsilsOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching PKs. Please try again.');
                                                    }
                                                });

                                            });
                                        });
                                    </script>


                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT na FROM  schemes as s  GROUP BY s.na ASC";
                                    $nas = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="nas[]" id="nas" multiple="multiple">
                                        <?php foreach ($nas as $na) { ?>
                                            <option value="<?php echo $na->na; ?>"><?php echo $na->na; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#nas').on('change', function() {
                                                const selectedNas = $('#nas').val() || []; // array (Select2 multi)
                                                const selectedDistricts = $('#district_ids').val() || []; // array (Select2 multi)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_pks_by_nas"); ?>',
                                                    type: 'POST',
                                                    dataType: 'json',
                                                    data: {
                                                        nas: selectedNas,
                                                        districts: selectedDistricts
                                                    },
                                                    success: function(data) {
                                                        const previouslySelectedPks = $('#pks').val() || [];
                                                        $('#pks').empty().trigger('change');

                                                        const pkOptions = [];
                                                        $.each(data, function(_, row) {
                                                            const val = (row.pk === null) ? '' : String(row.pk); // keep NULL as ''
                                                            const label = (row.pk === null) ? 'N/A' : row.pk; // show N/A
                                                            if (!previouslySelectedPks.includes(val)) {
                                                                pkOptions.push(new Option(label, val, false, false));
                                                            }
                                                        });

                                                        $('#pks').append(pkOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching PKs.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>

                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT pk FROM  schemes as s  GROUP BY s.pk ASC";
                                    $pks = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="pks[]" id="pks" multiple="multiple">
                                        <?php foreach ($pks as $pk) { ?>
                                            <option value="<?php echo $pk->pk; ?>"><?php echo $pk->pk; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT tehsil FROM schemes as s GROUP BY s.tehsil ASC";
                                    $tehsils = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="tehsils[]" id="tehsils" multiple="multiple">
                                        <?php foreach ($tehsils as $tehsil) { ?>
                                            <option value="<?php echo $tehsil->tehsil; ?>">
                                                <?php echo $tehsil->tehsil; ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <script>
                                        $(document).ready(function() {
                                            $('#tehsils').on('change', function() {
                                                const selectedTehsils = $('#tehsils').val() || []; // array (Select2 multi)
                                                const selectedDistricts = $('#district_ids').val() || []; // array (Select2 multi)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_ucs_by_tehsil"); ?>',
                                                    type: 'POST',
                                                    dataType: 'json',
                                                    data: {
                                                        tehsils: selectedTehsils,
                                                        districts: selectedDistricts
                                                    },
                                                    success: function(data) {
                                                        const previouslySelectedUcs = $('#ucs').val() || [];
                                                        $('#ucs').empty().trigger('change');

                                                        const Options = [];
                                                        $.each(data, function(_, row) {
                                                            const val = (row.uc === null) ? '' : String(row.uc); // keep NULL as ''
                                                            const label = (row.uc === null) ? 'N/A' : row.uc; // show N/A
                                                            if (!previouslySelectedUcs.includes(val)) {
                                                                Options.push(new Option(label, val, false, false));
                                                            }
                                                        });

                                                        $('#ucs').append(Options).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching Tehsils.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </td>


                                <td>
                                    <?php
                                    $query = "SELECT uc FROM schemes as s GROUP BY s.uc ASC";
                                    $ucs = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="ucs[]" id="ucs" multiple="multiple">
                                        <?php foreach ($ucs as $uc) { ?>
                                            <option value="<?php echo $uc->uc; ?>">
                                                <?php echo $uc->uc; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>


                                <td>
                                    <?php
                                    $query = "SELECT scheme_status  FROM  schemes as s
                                     GROUP BY s.scheme_status";
                                    $schemes_status = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="scheme_status[]" id="scheme_status" multiple="multiple">
                                        <?php foreach ($schemes_status as $scheme_status) { ?>
                                            <option value="<?php echo $scheme_status->scheme_status; ?>"><?php echo $scheme_status->scheme_status; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td style="display: none;">
                                    <?php
                                    $query = "SELECT 
                                                        c.component_id, 
                                                        c.component_name FROM expenses as e 
                                                        INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                                                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                                                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                                                        GROUP BY  c.component_name";
                                    $components = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="component_ids[]" id="component_ids" multiple="multiple">
                                        <?php foreach ($components as $component) { ?>
                                            <option value="<?php echo $component->component_id; ?>"><?php echo $component->component_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#component_ids').on('change', function() {
                                                let selectedComponents = $(this).val(); // Get selected component(s)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_sub_components_by_component"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        components: selectedComponents
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        // Get already selected sub-component IDs
                                                        let selectedSubComponents = $('#sub_component_ids').val() || [];

                                                        // Clear existing options
                                                        $('#sub_component_ids').empty().trigger('change');

                                                        // Populate dropdown while excluding already selected sub-components
                                                        let subComponentOptions = [];
                                                        $.each(data, function(key, sub_component) {
                                                            if (!selectedSubComponents.includes(sub_component.sub_component_id.toString())) {
                                                                subComponentOptions.push(new Option(sub_component.sub_component_name, sub_component.sub_component_id, false, false));
                                                            }
                                                        });

                                                        // Add new options and trigger Select2 update
                                                        $('#sub_component_ids').append(subComponentOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching sub-components. Please try again.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>

                                </td>

                                <td style="display: none;">
                                    <?php
                                    $query = "SELECT 
                                                        sc.sub_component_id, 
                                                        sc.sub_component_name, 
                                                        cc.category, 
                                                        e.component_category_id FROM expenses as e 
                                                        INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                                                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                                                        GROUP BY  sc.sub_component_name";
                                    $sub_components = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="sub_component_ids[]" id="sub_component_ids" multiple="multiple">
                                        <?php foreach ($sub_components as $sub_component) { ?>
                                            <option value="<?php echo $sub_component->sub_component_id; ?>"><?php echo $sub_component->sub_component_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#sub_component_ids').on('change', function() {
                                                let selectedSubComponents = $(this).val(); // Get selected sub-component(s)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "reports/get_component_categories_by_sub_component"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        sub_components: selectedSubComponents
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        // Get already selected component category IDs
                                                        let selectedComponentCategories = $('#component_category_ids').val() || [];

                                                        // Clear existing options in the component category dropdown
                                                        $('#component_category_ids').empty().trigger('change');

                                                        // Populate dropdown while excluding already selected component categories
                                                        let componentCategoryOptions = [];
                                                        $.each(data, function(key, component_category) {
                                                            if (!selectedComponentCategories.includes(component_category.component_category_id.toString())) {
                                                                componentCategoryOptions.push(new Option(
                                                                    component_category.category,
                                                                    component_category.component_category_id,
                                                                    false,
                                                                    false
                                                                ));
                                                            }
                                                        });

                                                        // Add new options and trigger Select2 update
                                                        $('#component_category_ids').append(componentCategoryOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching component categories. Please try again.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>

                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT cc.category, cc.category_detail, cc.component_category_id FROM component_categories as cc 
                                    WHERE cc.component_category_id <=12 GROUP BY cc.category";
                                    $categories = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="component_category_ids[]" id="component_category_ids" multiple="multiple">
                                        <?php foreach ($categories as $categorie) { ?>
                                            <option value="<?php echo $categorie->component_category_id; ?>"><?php echo $categorie->category; ?> - <?php echo $categorie->category_detail; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td>
                                    <select class="form-control" name="date_filter_by" id="date_filter_by">
                                        <option value="approval_date">Approved Date</option>
                                        <option value="completion_date">Completion Date</option>
                                </td>


                                <td><input class="form-control" type="date" name="start_date" id="start_date" /></td>
                                <td><input class="form-control" type="date" name="end_date" id="end_date" /></td>
                                <td><button class="btn btn-danger" type="submit">Process</button></td>
                            </tr>
                        </table>
                        <div id="filte r_expenses"></div>
                    </form>



                    <table id="schemesTable" class="table table-bordered table-striped table_small" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Scheme Code</th>
                                <th>Component</th>
                                <th>Sub Component</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Scheme Name</th>
                                <th>Region</th>
                                <th>D. Type</th>
                                <th>District</th>
                                <th>NA</th>
                                <th>PK</th>
                                <th>Tehsil</th>
                                <th>UC</th>
                                <th>Village</th>
                                <th>Male Beneficiaries</th>
                                <th>Female Beneficiaries</th>
                                <th>Total Beneficiaries</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>CCA</th>
                                <th>ACCA</th>
                                <th>GCA</th>
                                <th>Water Source</th>
                                <th>Total Lenght</th>
                                <th>Lining Length</th>
                                <th>Total Line Lenght</th>
                                <th>Approval Date</th>
                                <th>Payee</th>
                                <th>Financial Year</th>
                                <th>Category</th>
                                <th>Sanctioned Cost</th>
                                <th>Total Paid</th>
                                <th>Balance</th>
                                <th>Payment Count</th>
                                <th>1st Installment</th>
                                <th>2nd Installment</th>
                                <th>1st + 2nd</th>
                                <th>Final</th>
                                <th>Other</th>
                                <th>Cheques</th>
                                <th>Completion Date</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <script>
                        $(document).ready(function() {
                            // Initialize Select2
                            $('#financial_year_ids, #tehsils, #ucs, #nas, #pks, #scheme_status, #regions, #district_ids, #component_ids, #sub_component_ids, #component_category_ids, #purposes').select2();

                            // Handle form submission
                            $('#filterForm').on('submit', function(event) {
                                event.preventDefault();

                                var formData = $(this).serialize();

                                $.ajax({
                                    url: '<?php echo site_url(ADMIN_DIR . "reports/schemes_filter_list"); ?>',
                                    method: 'POST',
                                    data: formData,
                                    success: function(response) {
                                        response = JSON.parse(response);

                                        if (response.success) {
                                            if ($.fn.DataTable.isDataTable('#schemesTable')) {
                                                $('#schemesTable').DataTable().clear().destroy();
                                            }

                                            $('#schemesTable').DataTable({
                                                data: response.data,
                                                columns: [{
                                                        data: 'scheme_id'
                                                    },
                                                    {
                                                        data: 'scheme_code'
                                                    },
                                                    {
                                                        data: 'component_name'
                                                    },
                                                    {
                                                        data: 'sub_component_name'
                                                    },
                                                    {
                                                        data: 'category'
                                                    },

                                                    {
                                                        data: 'scheme_status'
                                                    },
                                                    {
                                                        data: 'scheme_name'
                                                    },
                                                    {
                                                        data: 'region'
                                                    },
                                                    {
                                                        data: 'district_type'
                                                    },
                                                    {
                                                        data: 'district_name'
                                                    },
                                                    {
                                                        data: 'na'
                                                    },
                                                    {
                                                        data: 'pk'
                                                    },
                                                    {
                                                        data: 'tehsil'
                                                    },
                                                    {
                                                        data: 'uc'
                                                    },
                                                    {
                                                        data: 'villege'
                                                    },
                                                    {
                                                        data: 'male_beneficiaries'
                                                    },
                                                    {
                                                        data: 'female_beneficiaries'
                                                    },
                                                    {
                                                        data: null,
                                                        render: function(data, type, row) {
                                                            return row.male_beneficiaries - row.female_beneficiaries;
                                                        }
                                                    },
                                                    {
                                                        data: 'latitude'
                                                    },
                                                    {
                                                        data: 'longitude'
                                                    },
                                                    {
                                                        data: 'cca'
                                                    },
                                                    {
                                                        data: 'acca'
                                                    },
                                                    {
                                                        data: 'gca'
                                                    },
                                                    {
                                                        data: 'water_source'
                                                    },
                                                    {
                                                        data: 'total_lenght'
                                                    },
                                                    {
                                                        data: 'lining_length'
                                                    },
                                                    {
                                                        data: null,
                                                        render: function(data, type, row) {
                                                            return row.total_lenght - row.lining_length;
                                                        }
                                                    },
                                                    {
                                                        data: 'approval_date'
                                                    },
                                                    {
                                                        data: 'payee_name'
                                                    },
                                                    {
                                                        data: 'financial_year'
                                                    },
                                                    {
                                                        data: 'category'
                                                    },
                                                    {
                                                        data: 'sanctioned_cost'
                                                    },
                                                    {
                                                        data: 'total_paid'
                                                    },
                                                    {
                                                        data: null, // we’ll calculate manually
                                                        render: function(data, type, row) {
                                                            return row.sanctioned_cost - row.total_paid;
                                                        }
                                                    },
                                                    {
                                                        data: 'payment_count'
                                                    },
                                                    {
                                                        data: '1st'
                                                    },
                                                    {
                                                        data: '2nd'
                                                    },
                                                    {
                                                        data: '1st_2nd'
                                                    },
                                                    {
                                                        data: 'final'
                                                    },
                                                    {
                                                        data: 'other'
                                                    },
                                                    {
                                                        data: 'cheques'
                                                    },
                                                    {
                                                        data: 'completion_date'
                                                    }
                                                ],
                                                dom: 'Blfrtip',
                                                pageLength: -1,
                                                buttons: [{
                                                        extend: 'print',
                                                        title: "Custom Schemes Report (Date: <?php echo date('d-m-Y h:i:s'); ?>)"
                                                    },
                                                    {
                                                        extend: 'excelHtml5',
                                                        title: "Custom Schemes Report (Date: <?php echo date('d-m-Y h:i:s'); ?>)"
                                                    }
                                                ]
                                            });
                                        } else {
                                            alert('No data found');
                                        }
                                    },
                                    error: function(xhr) {
                                        console.error('Error:', xhr.responseText);
                                    }
                                });
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>


</div>