<div class="col-md-4">
    <div class="form-group row">
        <label for="remarks" class="col-sm-6 col-form-label">Remarks</label>
        <div class="col-sm-6">
            <input type="text" required id="remarks" name="remarks" value="<?php echo $scheme->remarks; ?>" class="form-control">
        </div>

    </div>
    <div class="form-group row">
        <label for="scheme_note" class="col-sm-6 col-form-label">Scheme Note</label>
        <div class="col-sm-6">
            <input type="number" required id="scheme_note" name="scheme_note" value="<?php echo $scheme->scheme_note; ?>" class="form-control">
        </div>
    </div>
</div>