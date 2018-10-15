<div class="example-wrapper">
    <h1>Add New Group</h1>

    <?php echo validation_errors(); 
    if ($msg !='') { echo '<div class="alert alert-info">'. $msg. ' </div>';} ?>

    <?php echo form_open('dashboard/new_group'); ?>
    <div class="col-md-6 form-group">
        <label for="Name">Group Name</label>
        <input type="input" name="g_name" class="form-control" />
    </div>

    <div class="col-md-6 form-group">
        <label for="g_about">About Group</label>
        <textarea class="form-control" name="g_about">        </textarea>
    </div>

<input type="submit" class="btn btn-primary" name="submit" value="Add New Group" />

</form>
</div>
