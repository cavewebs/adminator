<div class="example-wrapper">
    <h1>Add New User</h1>

    <?php echo validation_errors(); 
    if ($msg !='') { echo '<div class="alert alert-info">'. $msg. ' </div>';} ?>

    <?php echo form_open('dashboard/new'); ?>
    <div class="col-md-6 form-group">
        <label for="Name">Name</label>
        <input type="input" name="name" class="form-control" />
    </div>

    <div class="col-md-6 form-group">
        <label for="Gender">Gender</label>
        <select class="form-control" name="gender">
            <option value="Male">Male</option> 
            <option value="Female">Female</option> 
        </select>
    </div>

<input type="submit" class="btn btn-primary" name="submit" value="Add New User" />

</form>
</div>
