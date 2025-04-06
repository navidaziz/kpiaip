<h4>Scheme Technical Detail</h4>
<form id="schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />
    <?php if ($input->component_category_id == 12) { ?>
        <!-- For B3 -->

        <div class="row">
            <div class="col-md-12">
                <div class="box border blue messenger-box" style="padding: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="farmer_name">Farmer Name</label>
                                <input type="text" class="form-control" id="farmer_name" value="<?php echo $input->farmer_name; ?>" name="farmer_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="contact_no">Contact No</label>
                                <input type="text" name="contact_no" value="<?php echo $input->contact_no; ?>" id="contact_no" class="form-control" pattern="0[0-9]{10}" style="" required="required" title="Please enter an 11-digit mobile number starting with '0'" placeholder="032400000000">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="nic_no">CNIC No.</label>
                                <input type="text" name="nic_no" value="<?php echo $input->nic_no; ?>" id="nic_no" pattern="\d{5}-\d{7}-\d{1}" onkeyup="nic_dash1(this)" class="form-control" style="" required="required" title="CNIC" placeholder="CNIC">
                                <script language="javascript">
                                    function nic_dash1(t)

                                    {
                                        var donepatt = /^(\d{5})\/(\d{7})\/(\d{1})$/;

                                        var patt = /(\d{5}).*(\d{7}).*(\d{1})/;

                                        var str = t.value;

                                        if (!str.match(donepatt))

                                        {
                                            result = str.match(patt);

                                            if (result != null)

                                            {
                                                t.value = t.value.replace(/[^\d]/gi, '');

                                                str = result[1] + '-' + result[2] + '-' + result[3];

                                                t.value = str;

                                            } else {

                                                if (t.value.match(/[^\d]/gi))

                                                    t.value = t.value.replace(/[^\d]/gi, '');

                                            }
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box border blue messenger-box" style="padding: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="government_share">Government Share</label>
                                <input type="number" step="0.01" class="form-control" id="government_share" value="<?php echo $input->government_share; ?>" name="government_share">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="farmer_share">Farmer Share</label>
                                <input type="number" step="0.01" class="form-control" id="farmer_share" value="<?php echo $input->farmer_share; ?>" name="farmer_share">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="ssc">SSC</label>
                        <input type="text" class="form-control" id="ssc" name="ssc" value="<?php echo $input->ssc; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="category">SSC Category</label>
                        <select class="form-control" id="ssc_category" name="ssc_category">
                            <option <?php if ($input->ssc_category == 'Imported') { ?> selected <?php } ?> value="Imported">Imported</option>
                            <option <?php if ($input->ssc_category == 'Local') { ?> selected <?php } ?> value="Local">Local</option>
                            <option <?php if ($input->ssc_category == 'Imported+Local') { ?> selected <?php } ?> value="Imported+Local">Imported + Local</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="transmitter_make">Transmitter Make</label>
                        <input type="text" class="form-control" id="transmitter_make" name="transmitter_make" value="<?php echo $input->transmitter_make; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="transmitter_model">Transmitter Model</label>
                        <input type="text" class="form-control" id="transmitter_model" name="transmitter_model" value="<?php echo $input->transmitter_model; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="transmitter_sr_no">Transmitter Serial No</label>
                        <input type="text" class="form-control" id="transmitter_sr_no" name="transmitter_sr_no" value="<?php echo $input->transmitter_sr_no; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="receiver_make">Receiver Make</label>
                        <input type="text" class="form-control" id="receiver_make" name="receiver_make" value="<?php echo $input->receiver_make; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="receiver_model">Receiver Model</label>
                        <input type="text" class="form-control" id="receiver_model" name="receiver_model" value="<?php echo $input->receiver_model; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="receiver_sr_no">Receiver Serial No</label>
                        <input type="text" class="form-control" id="receiver_sr_no" name="receiver_sr_no" value="<?php echo $input->receiver_sr_no; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="control_box_make">Control Box Make</label>
                        <input type="text" class="form-control" id="control_box_make" name="control_box_make" value="<?php echo $input->control_box_make; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="control_box_model">Control Box Model</label>
                        <input type="text" class="form-control" id="control_box_model" name="control_box_model" value="<?php echo $input->control_box_model; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="control_box_sr_no">Control Box Serial No</label>
                        <input type="text" class="form-control" id="control_box_sr_no" name="control_box_sr_no" value="<?php echo $input->control_box_sr_no; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="scrapper_sr_no">Scrapper Serial No</label>
                        <input type="text" class="form-control" id="scrapper_sr_no" name="scrapper_sr_no" value="<?php echo $input->scrapper_sr_no; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="scrapper_blade_width">Scrapper Blade Width</label>
                        <input type="number" step="0.01" class="form-control" id="scrapper_blade_width" name="scrapper_blade_width" value="<?php echo $input->scrapper_blade_width; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="scrapper_weight">Scrapper Weight</label>
                        <input type="number" step="0.01" class="form-control" id="scrapper_weight" name="scrapper_weight" value="<?php echo $input->scrapper_weight; ?>">
                    </div>
                </div>
            </div>
        </div>



        <!-- For B3 End here -->
    <?php  } ?>

    <input required type="hidden" name="scheme_status" value="Initiated">


    <div class="form-group row text-center mt-3">
        <div id="result_response"></div>
        <button type="submit" class="btn btn-danger">Initiate Scheme</button>
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