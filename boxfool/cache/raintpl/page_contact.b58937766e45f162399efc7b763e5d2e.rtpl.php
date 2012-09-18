<?php if(!class_exists('raintpl')){exit;}?><div class="row">
	<div class="span12">
		<div class="jumbotron subhead">
			<h1>Contact Us</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="span12 contact">

		<div class="span8 contact_left">
		<?php if( $form_success ){ ?>

		<section>
			<p>Thank you for writing in. We will get in touch with you shotly.</p>
		</section>	
		<?php }else{ ?>

		<section>
			<p>Fill in the form below and click Submit.</p>
			<iframe src="https://docs.google.com/spreadsheet/embeddedform?formkey=dDliWE9hT3FocVkxVGVQbVY4aUNXWVE6MQ" width="500" height="648" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
			<!--
			<form method="post" action="">
			<table style="width:500px">
				<tr valign="top">
					<td>Name</td>
					<td><input type="text" class="text" name="contact_name" value="" /></td>
				</tr>
				<tr valign="top">
					<td>E-mail</td>
					<td><input type="text" class="text" name="contact_email" value="" /></td>
				</tr>
				<tr valign="top">
					<td>Location</td>
					<td><input type="text" class="text" name="contact_location" value="" /></td>
				</tr>
				<tr valign="top">
					<td>Comments / Enquiries</td>
					<td><textarea name="contact_comment" style="width:300px" rows="10"></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Submit" style="width:120px; height:30px" /></td>
				</tr>
			</table>
			//-->
			<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
			</form>
		</section>
		<?php } ?>

		</div>

		<div class="span4 contact_right">
			<table style="width:500px" cellpadding="5">
				<tr valign="top">
					<td colspan="2"><h2><b>EzyPzy Sdn Bhd</b></h2></td>
				</tr>
				<tr valign="top">
					<td>E-mail</td>
					<td><a href="mailto:hello@boxfool.com">hello@boxfool.com</a></td>
				</tr>
				<tr valign="top">
					<td>Website</td>
					<td>www.boxfool.com</td>
				</tr>
				<tr valign="top">
					<td>Address</td>
					<td>A-15-17 &amp; A-16-17, Block A<br />
					Menara Prima, Jalan PJU 1-37<br />
					Dataran Prima, 47301 Petaling Jaya<br />
					Selangor, Malaysia
					</td>
				</tr>
				<tr valign="top">
					<td>Tel</td>
					<td>03-7887 1709</td>
				</tr>
				<tr valign="top">
					<td>Fax</td>
					<td>03-7886 7591</td>
				</tr>
			</table>
		</div>
	</div>
</div>
