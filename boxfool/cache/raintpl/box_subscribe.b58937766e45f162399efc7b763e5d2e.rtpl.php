<?php if(!class_exists('raintpl')){exit;}?>


	<!-- form container start -->
	<div class="row">

		<?php if( $show_paypal_form == false ){ ?>


		<div class="span8">
			<h2>Step 1 of 2</h2>

			<?php if( $form_error ){ ?>

			<div class="alert alert-error">
				<p><strong>Whoops, the form is incomplete. Please check the following:</strong></p>
				<ol>
					<?php $counter1=-1; if( isset($form_error_list) && is_array($form_error_list) && sizeof($form_error_list) ) foreach( $form_error_list as $key1 => $value1 ){ $counter1++; ?>

					<li><?php echo $value1["message"];?></li>	
					<?php } ?>

				</ol>
			</div>
			<?php } ?>

			
			<form action="" method="post" class="form-horizontal" accept-charset="utf-8">

				<fieldset>
					<legend>Personal Details</legend>
					<div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_name;?><?php } ?>">
						<label class="control-label" for="name">Name</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="name" value="<?php if( $form_submit ){ ?><?php echo $input_data["name"];?><?php } ?>">
						</div>
					</div>
					<div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_email;?><?php } ?>">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="email" value="<?php if( $form_submit ){ ?><?php echo $input_data["email"];?><?php } ?>">
						</div>
					</div>
					<div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_tel;?><?php } ?>">
						<label class="control-label" for="tel">Telephone</label>
						<div class="controls">
							<input type="text" class="input-medium" name="tel" value="<?php if( $form_submit ){ ?><?php echo $input_data["tel"];?><?php } ?>">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Ship to:</legend>
				  <div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_address1;?><?php } ?>">
						<label class="control-label" for="address1">Address</label>
				    <div class="controls">
				      <input type="text" class="input-xlarge" name="address1" value="<?php if( $form_submit ){ ?><?php echo $input_data["address1"];?><?php } ?>">
				    </div>
				  </div>
				  <div class="control-group">
						<label class="control-label" for="address2">&nbsp;</label>
				    <div class="controls">
				      <input type="text" class="input-xlarge" name="address2" value="<?php if( $form_submit ){ ?><?php echo $input_data["address2"];?><?php } ?>">
				    </div>
				  </div>
				  <div class="control-group">
						<label class="control-label" for="address3">&nbsp;</label>
				    <div class="controls">
				      <input type="text" class="input-xlarge" name="address3" value="<?php if( $form_submit ){ ?><?php echo $input_data["address3"];?><?php } ?>">
				    </div>
				  </div>
				  <div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_postcode;?><?php } ?>">
						<label class="control-label" for="postcode">Postcode</label>
				    <div class="controls">
				      <input type="text" class="input-small" name="postcode" maxlength="6" value="<?php if( $form_submit ){ ?><?php echo $input_data["postcode"];?><?php } ?>">
				    </div>
				  </div>
				  <div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_city;?><?php } ?>">
						<label class="control-label" for="city">City</label>
				    <div class="controls">
				      <input type="text" class="input-medium" name="city" value="<?php if( $form_submit ){ ?><?php echo $input_data["city"];?><?php } ?>" />
				    </div>
				  </div>
				  <div class="control-group <?php if( $form_error ){ ?><?php echo $form_error_state;?><?php } ?>">
				    <label class="control-label" for="state">State</label>
				    <div class="controls">
							<select name="state">
								<option value="KL" selected>Kuala Lumpur</option>
								<option value="Selangor">Selangor<option>
							</select>
							<p class="help-block">We currently deliver within the Klang Valley only. Shipping is free.</p>
						</div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="country">Country</label>
				    <div class="controls">
							<input type="text" name="country" class="input-small uneditable-input" value="Malaysia" />
				    </div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Next Step: Payment &#187;</button>
					</div>
				</fieldset>
				
			</form>
		</div>

		<?php }else{ ?>


		<div class="span8">
			<h2>Step 2 of 2</h2>
			<p>&nbsp;</p>	
			<h1>Your Boxfool of <?php echo $box_theme['name'];?> will be shipped to:</h1>
			<p>&nbsp;</p>
			<div class="well">
				<h2><?php echo $sub_name;?></h2>
				<p><?php echo $sub_address;?></p>
				<p>Tel: <?php echo $sub_tel;?><br />
				E-mail: <?php echo $sub_email;?></p>
			</div>
			<p>&nbsp;</p>

			<fieldset>
				<legend></legend>
			</fieldset>

			<p>&nbsp;</p>
			<h3>Click on a payment option below:</h3>
			<p>&nbsp;</p>

			<div style="width:300px; float:left">
				<fieldset>
					<legend><h2>PayPal / Credit Card</h2></legend>
					<p>&nbsp;</p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="<?php echo $input_data['paypal_id'];?>" />
						<input type="image" style="width:147px; height:47px" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" />
					</form>
			
					<!--
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="<?php echo $input_data['paypal_id'];?>">
						<input type="hidden" name="custom" value="<?php echo $sub_email;?>">
						<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
					-->
				</fieldset>
			</div>

			<div style="width:300px; float:right">
				<fieldset>
					<legend><h2>Bank Transfer</h2></legend>
					<p>&nbsp;</p>
					<p>Payment can be made via direct bank-in or transfer to:</p>
					<p style="padding-left:25px;">Account No: <b>247-201-200344-6</b><br />
					Name: EzyPzy Sdn Bhd<br />
					Bank: AmBank (M) Berhad</p>
					<p>Once transferred, send a scanned image of the bank-in slip or screenshot of the payment confirmation page to <a href="mailto:hello@boxfool.com">hello@boxfool.com</a>.</p>
					<p><a href="<?php echo $base_url;?>/thank-you" class="btn btn-primary">OK I'll do this!</a></p>
				</fieldset>
			</div>

			<div style="clear:both"></div>
			<p>Enquiries? Write to <a href="mailto:hello@boxfool.com">hello@boxfool.com</a></p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>		
		</div>

		<?php } ?>


		<div class="span4">
			<h2>Subscribing to:<br />
			<small><a href="/eco" style="text-decoration:underline">Boxfool of <?php echo $box_theme['name'];?></a></small></h2>

			<div class="thumbnail">
				<img src="<?php echo $base_url;?>/public/images/subscribe_eco.jpg" alt="" />
        <div class="caption">
					<p>A Boxfool of eco-friendly, wholesome organic products. Curated by your favorite yoga instructor Ninie Ahmad.</p>
					<p>Ships 15th September 2012</p>
					<h2>RM <?php echo $box_theme['price'];?> / box</h2>
				</div>
      </div>
		</div>
	</div>
	<!-- form container ends -->

