<?php if(!class_exists('raintpl')){exit;}?><div class="container">
	<div class="row">
		<div class="login_form_container">
			<div class="login_left">
				<h1>Login</h1>
				<p>to your Boxfool account</p>
			</div>
			<div class="login_right">
			<?php if( $form_success ){ ?>

				<div class="alert alert-success">
					<p><strong>Login success.</strong> Click here to go to your account page.</p>
				</div>
			<?php }else{ ?>

				<?php if( $form_error ){ ?>

				<div class="alert alert-error">
					<p><strong>Login Error.</strong> Check your email and password.</p>
				</div>
				<?php } ?>

				<form action="" method="post">
					<label>Email Address</label>
					<input type="text" name="email" placeholder="Your email" class="input-medium" value="<?php echo $input_data['email'];?>">
					<label>Password</label>
					<input type="password" name="password" placeholder="Your password" class="input-medium">
					<button type="submit" class="btn">Login &rarr;</button>
				</form>
			<?php } ?>

			</div>
		</div>
	</div>
</div>
