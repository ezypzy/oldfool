<?php if(!class_exists('raintpl')){exit;}?>

	<!-- update user details container start -->
	<div class="row">
		<div class="span10">
			<div class="page-header">
				<h1>Update Your Details</h1>
			</div>

			<?php if( $form_success ){ ?>


				<div class="alert alert-success">
					<p>Details updated</p>
				</div>
				<div>&larr; <a href="<?php echo $base_url;?>/account">back</a></div>

			<?php }else{ ?>


				<?php if( $form_error ){ ?>

				<div class="alert alert-error">
					<p>Oppss.. we found some errors.</p>
				</div>
				<?php } ?>


				<form action="" class="form-horizontal" method="post">
					<fieldset>
						<div class="control-group <?php if( $form_error_name ){ ?>error<?php } ?>">
							<label class="control-label">Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="name" value="<?php echo $input['name'];?>">
							</div>
						</div>

						<div class="control-group <?php if( $form_error_email ){ ?>error<?php } ?>">
							<label class="control-label">Email</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="email" value="<?php echo $input['email'];?>">
							</div>
						</div>

						<div class="control-group <?php if( $form_error_tel ){ ?>error<?php } ?>">
							<label class="control-label">Contact No.</label>
							<div class="controls">
								<input type="text" class="input-medium" name="tel" value="<?php echo $input['tel'];?>">
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Update Details</button>
						</div>
					</fieldset>	
				</form>

			<?php } ?>

		</div>
	</div><!-- update user details container ends -->

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

