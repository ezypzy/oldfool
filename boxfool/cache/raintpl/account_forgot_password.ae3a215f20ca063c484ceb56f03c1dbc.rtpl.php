<?php if(!class_exists('raintpl')){exit;}?>

	<!-- reset password container start -->
	<div class="row">
		<div class="span10">
			<div class="page-header">
				<h1>Reset Your Password</h1>
			</div>
			
			<?php if( $form_success ){ ?>

			<div class="alert alert-success">
				<p>Further istruction have been sent to your email.</p>
			</div>
			<?php }else{ ?>

				<?php if( $form_error ){ ?>

				<div class="alert alert-error">
					<p>Email could not be found.</p>
				</div>
				<?php } ?>


				<form action="" class="form-horizontal" method="post">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Email Address</label>
							<div class="controls">
								<input type="text" class="input-large" name="email">
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Recover Password</button>
						</div>
					</fieldset>
				</form>
			<?php } ?>


		</div>
	</div><!-- reset password container ends -->
