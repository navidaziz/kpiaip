<div class="row">
    <div class="col-md-8">
        <h4>
            Scheme Code: <strong><?php echo htmlspecialchars($input->scheme_code); ?></strong><br />
            Scheme Name: <strong><?php echo htmlspecialchars($input->scheme_name); ?></strong><br />
        </h4>

    </div>
    <div class="col-md-4">
        <h4>
            Scheme Category: <strong><?php echo htmlspecialchars($input->category); ?></strong><br />
            <?php //echo htmlspecialchars($input->category_detail); 
            ?>
        </h4>
        <p>Scheme Status: <strong><?php echo htmlspecialchars($input->scheme_status); ?></strong></p>
    </div>
    <small>
        Address: Region: <?php echo htmlspecialchars($input->region); ?>, District: <?php echo htmlspecialchars($input->district); ?>, Tehsil: <?php echo htmlspecialchars($input->tehsil); ?>, UC: <?php echo htmlspecialchars($input->uc); ?>, Address: <?php echo htmlspecialchars($input->villege); ?>
    </small>

    <hr />
</div>
<form id="schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />

    <?php $this->load->view(ADMIN_DIR . 'water_user_associations/' . $form); ?>

    <input required type="hidden" name="scheme_status" value="Initiated">

    <div class="row">
        <div class="col-md-12">
            <div class="box border blue" id="messenger" style="padding: 5px;">
                <div class="form-group row">
                    <!-- Technical Sanction Date -->
                    <div class="col-md-3">
                        <label for="technical_sanction_date" class="col-form-label">Technical Sanction Date <span style="color: red;">*</span></label>
                        <input required type="date" id="technical_sanction_date" name="technical_sanction_date"
                            value="<?php echo $input->technical_sanction_date; ?>" class="form-control">

                    </div>
                    <div class="col-md-3">
                        <label for="work_order_date" class="col-form-label">Work Order Date <span style="color: red;">*</span></label>
                        <input required type="date" id="work_order_date" name="work_order_date"
                            value="<?php echo $input->work_order_date; ?>" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="work_order_no" class="col-form-label">Work Order No <small style="color: red;">*</small></label>
                        <input required type="text" class="form-control" id="work_order_no"
                            value="<?php echo $input->work_order_no; ?>" name="work_order_no">
                    </div>

                    <div class="col-md-3">
                        <label for="scheme_initiation_date" class="col-form-label">Scheme Initiation Date <span style="color: red;">*</span></label>
                        <input type="date" id="scheme_initiation_date" name="scheme_initiation_date"
                            value="<?php echo $input->scheme_initiation_date; ?>" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($complete === 'Complete') { ?>
        <input type="hidden" name="phy_completion" value="Yes" />
        <div class="box border blue" id="messenger" style="padding: 5px;">
            <h4><strong>Marked Scheme As Physically Completed</strong></h4>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <strong style="color: green;">
                        Do you want to mark this scheme as physically completed?
                    </strong><br />
                    <span style="color: red;">
                        Please review the Social and Physical Data carefully before proceeding.<br />
                        <strong>Note:</strong> Once the scheme is marked as physically completed, you will no longer be able to make changes to the Social and Physical Data.
                    </span><br /><br />
                    <label>
                        <input
                            type="radio"
                            name="ongoing"
                            value="yes"
                            required
                            <?php if ($input->phy_completion == 'Yes') echo 'checked'; ?> />
                        <span style="margin-left: 5px;">Yes, I have reviewed and agree</span>
                    </label>
                </div>
            </div>

            <div class="row">

                <?php if ($input->component_category_id == 12) { ?>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="distribution_date" class="col-md-4 col-form-label text-right">Distribution Date</label>
                            <div class="col-md-8">
                                <input type="date" name="distribution_date" value="<?php echo $input->distribution_date; ?>"
                                    id="distribution_date" class="form-control" required title="Distribution Date"
                                    placeholder="Distribution Date">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="fcr_approving_expert" class="col-md-4 col-form-label text-right">FCR Approving Expert</label>
                            <div class="col-md-8">
                                <input type="text" name="fcr_approving_expert" value="<?php echo $input->fcr_approving_expert; ?>"
                                    id="fcr_approving_expert" class="form-control" required title="FCR Approving Expert"
                                    placeholder="FCR Approving Expert">
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="build_in_cost" class="col-md-4 col-form-label text-right">Build in Cost</label>
                        <div class="col-md-8">
                            <input max="<?php echo $input->sanctioned_cost; ?>" type="number" name="build_in_cost"
                                value="<?php echo $input->build_in_cost; ?>" id="build_in_cost"
                                class="form-control" required title="Build in Cost" placeholder="Build in Cost">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="phy_completion_date" class="col-md-4 col-form-label text-right">Physical Completion Date</label>
                        <div class="col-md-8">
                            <input type="date" name="phy_completion_date" value="<?php echo $input->completion_date; ?>"
                                id="phy_completion_date" class="form-control" required title="Physical Completion Date"
                                placeholder="Physical Completion Date">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>



    <div class="row text-center">
        <div id="result_response"></div>
        <?php if ($input->scheme_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Scheme Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-danger">Update Scheme Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#schemes').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/initiate_scheme"); ?>', // URL to submit form data
            data: formData,
            success: function(response) {
                // Display response
                if (response == 'success') {
                    location.reload();
                } else {
                    $('#result_response').html(response);
                }

            }
        });
    });
</script>