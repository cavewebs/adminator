<div class="auth-page">
  <div class="container page">
    <div class="row">

      <div class="col-md-6 offset-md-3 col-xs-12">
        <h1 class="text-xs-center">Sign In</h1>
        <div class="widget-main">
			<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
			  <?php if(!empty($this->session->flashdata('error'))): ?>
			  <div class="alert alert-danger"> <?php echo $this->session->flashdata('error'); ?> </div>
			  <?php endif; ?>

			<?php echo form_open('login'); ?>
	            <fieldset class="form-group">
	            <label> Enter your Email </label>
	              <input
	                Name="email"
	                placeholder="Email"
	                class="form-control form-control-lg"
	                type="text" required />
	            </fieldset>
	            <fieldset class="form-group">
	            <label> Password </label>
	              <input
	                Name="password"
	                placeholder="Password"
	                class="form-control form-control-lg"
	                type="password" required />
	            </fieldset>
	            <a href="<?php echo(base_url('forgot_password'));?>">Forgot Password? </a> <button class="btn btn-lg btn-primary pull-xs-right" type="submit">
	              Sign In
	            </button>
	          </fieldset>
			<?php echo form_close(); ?>
      </div>

    </div>
  </div>
</div>
