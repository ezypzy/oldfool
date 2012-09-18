<?php if(!class_exists('raintpl')){exit;}?>

	<!-- update user details container start -->
	<div class="row">
		<div class="span10">
			<div class="page-header">
				<h1>Update Your Details</h1>
			</div>

			<?php if( $form_success ){ ?>


				<div class="alert alert-success">
					<p>Shipping address updated.</p>
				</div>

			<?php }else{ ?>


				<?php if( $form_error ){ ?>

				<div class="alert alert-error">
					<p>All fields are compulsory.</p>
				</div>
				<?php } ?>


				<form action="" class="form-horizontal" method="post">
					<fieldset>
						<div class="control-group <?php if( $form_error_address1 ){ ?>error<?php } ?>">
							<label class="control-label">Address</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="address1" value="<?php echo $input['address1'];?>" maxlength="255" />
							</div>
						</div>

						<div class="control-group <?php if( $form_error_address2 ){ ?>error<?php } ?>">
							<label class="control-label"></label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="address2" value="<?php echo $input['address2'];?>" maxlength="255" />
							</div>
						</div>

						<div class="control-group <?php if( $form_error_address3 ){ ?>error<?php } ?>">
							<label class="control-label"></label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="address3" value="<?php echo $input['address3'];?>" maxlength="255" />
							</div>
						</div>

						<div class="control-group <?php if( $form_error_postcode ){ ?>error<?php } ?>">
							<label class="control-label">Postcode</label>
							<div class="controls">
								<input type="text" class="input-medium" name="postcode" value="<?php echo $input['postcode'];?>" maxlength="10" />
							</div>
						</div>

						<div class="control-group <?php if( $form_error_city ){ ?>error<?php } ?>">
							<label class="control-label">City</label>
							<div class="controls">
								<input type="text" class="input-medium" name="city" value="<?php echo $input['city'];?>" maxlength="255" />
							</div>
						</div>

						<div class="control-group <?php if( $form_error_state ){ ?>error<?php } ?>">
							<label class="control-label">State</label>
							<div class="controls">
								<select name="state">
									<option value="KL" <?php if( $input['state'] == 'KL' ){ ?>selected<?php } ?>>Kuala Lumpur</option>
									<option value="Selangor" <?php if( $input['state'] == 'Selangor' ){ ?>selected<?php } ?>>Selangor</option>
								</select>
							</div>
						</div>

						<div class="control-group <?php if( $form_error_country ){ ?>error<?php } ?>">
							<label class="control-label">Country</label>
							<div class="controls">
								<input type="text" class="input-medium uneditable-input" name="country" value="<?php echo $input['country'];?>">
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

