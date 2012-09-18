<?php if(!class_exists('raintpl')){exit;}?>

	<!-- subscribed boxfool container start -->
	<div class="row">
		<div class="span10">
			<div class="page-header">
				<h1>Your Subscriptions</h1>
			</div>
			<div class="boxfool_information_container">
				<img src="<?php echo $base_url;?>/public/images/boxstar_ninieahmad_2.jpg" alt="" class="boxfool_image">
				<div class="info_container">
					<p class="lead">Boxfool of Eco</p>
					<p>A box of eco-friendly, nature loving and wholesome organic stuff. Curated by Ninie Ahmad.</p>
					<p>Ships <strong>15th September 2012</strong></p>
				</div>
			</div>
		</div>
	</div><!-- subscribed boxfool container ends -->

	<!-- account information container start -->
	<div class="row">
		<div class="span10">
			<div class="page-header">
				<h2>Account <small>(<a href="<?php echo $base_url;?>/account/logout">Logout</a> &rarr;)</small></h2>
			</div>
			<div class="span3">
				<p class="lead">Your Account</p>
				<p>
				<div><i class="icon-user"></i> <?php echo $user_info['name'];?></div>
				<div><i class="icon-envelope"></i> <?php echo $user_info['email'];?></div>
				<div><i class="icon-phone"></i> <?php echo $user_info['tel'];?></div>
				</p>
				<p><a href="<?php echo $base_url;?>/account/details">Update Account</a></p>
				<p>&nbsp;</p>
			</div>
			<div class="span3">
				<p class="lead">Your Password</p>
				<p><a href="<?php echo $base_url;?>/account/password">Change Password</a></p>
			</div>
			<div class="span3">
				<p class="lead">Shipping Address</p>
				<address>
					<?php echo $user_info['address1'];?><br/>
					<?php if( $user_info['address2'] != '' ){ ?>

						<?php echo $user_info['address2'];?><br/>
					<?php } ?>

					<?php if( $user_info['address3'] != '' ){ ?>

						<?php echo $user_info['address3'];?><br/>
					<?php } ?>

					<?php echo $user_info['postcode'];?>, <?php echo $user_info['city'];?><br/>
					<?php echo $user_info['state'];?>, <?php echo $user_info['country'];?><br/>
				</address>
				<p><a href="<?php echo $base_url;?>/account/address">Update address</a></p>
			</div>
		</div>
	</div><!-- account information container ends -->

	<!-- just a spacer -->
	<div class="row">
		<div class="span10">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
	</div>

	
