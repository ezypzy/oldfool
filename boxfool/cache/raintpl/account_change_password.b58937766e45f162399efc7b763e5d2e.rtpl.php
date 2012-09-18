<?php if(!class_exists('raintpl')){exit;}?>

	<!-- change password container start -->
	<div class="row">
		<div class="span10">
			<div class="page-header">
				<h1>Change Your Password</h1>
			</div>
			
			<?php if( $form_success ){ ?>

				<div class="alert alert-success">
					<p>Password changed</p>
				</div>
				<p>&nbsp;</p>
				<div>&larr; <a href="<?php echo $base_url;?>/account">Back</a></div>
				<p>&nbsp;</p>
				<p>&nbsp;</p>

			<?php }else{ ?>

				
				<?php if( $form_error ){ ?>

				<div class="alert alert-error">
					<?php if( $form_error_mismatch ){ ?>

					<p>Pssword Mismatch</p>
					<?php } ?>

					<?php if( $form_error_old ){ ?>

					<p>Old password error</p>
					<?php } ?>

					<?php if( $form_error_database ){ ?>

					<p>Database error. Please try again.</p>
					<?php } ?>

					<?php if( $form_error_short ){ ?>

					<p>Password is too short. Password must be at least 8 characters.</p>
					<?php } ?>

				</div>
				<?php } ?>


				<form action="" class="form-horizontal" method="post">
					<fieldset>
						<div class="control-group <?php if( $form_error_old ){ ?>error<?php } ?>">
							<label class="control-label">Old Password</label>
							<div class="controls">
								<input type="password" class="input-large" name="password_old" value="">
							</div>
						</div>

						<div class="control-group <?php if( $form_error_mismatch ){ ?>error<?php } ?>">
							<label class="control-label">New Password</label>
							<div class="controls">
								<input type="password" class="input-large" name="password_new" value="">
							</div>
						</div>

						<div class="control-group <?php if( $form_error_mismatch ){ ?>error<?php } ?>">
							<label class="control-label">Confirm Password</label>
							<div class="controls">
								<input type="password" class="input-large" name="password_confirm" value="">
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Change Password</button>
						</div>
					</fieldset>
				</form>

			<?php } ?>


		</div>
	</div><!-- change password container ends -->

	<!-- just a spacer -->
	<div class="row">
		<div class="span10">
			<p>&larr; <a href="<?php echo $base_url;?>/account">back</a></p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
	</div>

