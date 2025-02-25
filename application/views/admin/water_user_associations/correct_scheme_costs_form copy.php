<form action="<?= site_url('your_controller/correct_scheme_costs') ?>" method="post">
    <input type="hidden" class="form-control" id="scheme_id" name="scheme_id" value="<?php echo $scheme->scheme_id; ?>" required>


    <div class="form-group">
        <label for="estimated_cost">Estimated Cost</label>
        <input type="text" class="form-control" id="estimated_cost" name="estimated_cost">
    </div>

    <div class="form-group">
        <label for="estimated_cost_date">Estimated Cost Date</label>
        <input type="date" class="form-control" id="estimated_cost_date" name="estimated_cost_date">
    </div>

    <div class="form-group">
        <label for="approved_cost">Approved Cost</label>
        <input type="text" class="form-control" id="approved_cost" name="approved_cost">
    </div>

    <div class="form-group">
        <label for="technical_sanction_date">Approval Date</label>
        <input type="date" class="form-control" id="technical_sanction_date" name="technical_sanction_date">
    </div>

    <div class="form-group">
        <label for="work_order_date">Work Order Date</label>
        <input type="date" class="form-control" id="work_order_date" name="work_order_date">
    </div>

    <div class="form-group">
        <label for="scheme_initiation_date">Scheme Initiation Date</label>
        <input type="date" class="form-control" id="scheme_initiation_date" name="scheme_initiation_date">
    </div>

    <div class="form-group">
        <label for="revised_cost">Revised Cost</label>
        <input type="text" class="form-control" id="revised_cost" name="revised_cost">
    </div>

    <div class="form-group">
        <label for="revised_cost_date">Revised Cost Date</label>
        <input type="date" class="form-control" id="revised_cost_date" name="revised_cost_date">
    </div>

    <div class="form-group">
        <label for="completion_cost">Completion Cost</label>
        <input type="text" class="form-control" id="completion_cost" name="completion_cost">
    </div>

    <div class="form-group">
        <label for="completion_date">Completion Date</label>
        <input type="date" class="form-control" id="completion_date" name="completion_date">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>