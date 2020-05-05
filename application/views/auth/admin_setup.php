<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container">
	
	<div class="form-container">
		<h2 class="form-title">Admin Setup</h2>
		<hr>
		<form method="post" action="<?php echo base_url( 'do-admin-setup' ); ?>">
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo set_value( 'name' ); ?>" maxlength="50" required>
				<?php echo form_error( 'name' ); ?>
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value( 'email' ); ?>" maxlength="100" required>
				<?php echo form_error( 'email' ); ?>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value( 'password' ); ?>" required>
				<?php echo form_error( 'password' ); ?>
			</div>
			<div class="form-group">
				<input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" value="<?php echo set_value( 'cpassword' ); ?>" required>
				<?php echo form_error( 'cpassword' ); ?>
			</div>
			<div class="form-group text-right">
				<input type="submit" name="submit" class="btn btn-primary" value="Continue...">
			</div>
		</form>
	</div>

</div>