<?php if(!class_exists('raintpl')){exit;}?><div class="container">
	<div class="row">
		<div class="msgcontainer">
			<div id="message1">
				<blockquote class="landing">
					<span style="color:#d54343">A Boxfool of Surprises</span>, delivered to you every quarter for only <span style="color:#d54343">RM60</span>!
				</blockquote>
			</div>
			<div id="message2">
				<blockquote class="landing">
					<span style="color:#d54343">Curated by Boxstars</span> - our panel of influential, fashionable people who know what's awesome.
				</blockquote>
			</div>
			<div id="message3">
				<blockquote class="landing">
					Get yours now: <a href="/eco" style="text-decoration:underline; color:#d54343">Boxfool of Eco!</a>
				</blockquote>
			</div>
		</div>

		<section class="featured">						
			<div class="box">
				<div id="subscribe"><a href="/eco/subscribe"><img src="images/dot_trans.gif" width="100" height="100" title="Subscribe Here" /></a></div>
				<div class="boxstar"><a href="/eco"><img src="/images/boxstar_ninieahmad_v2.png" title="Featured Boxstar: Ninie Ahmad | Click for more" /></a></div>
				<div class="emptybox"></div>
        <div class="featured-banner">
					5% off each Boxfool subscription goes to a charitable cause.
				</div>
			</div>
		</section>
	</div>

	<div class="row">
				<div class="email">

					<?php if( $form_success ){ ?>

					<div class="success">
						<h2 style="color:#060">Got it, thanks!</h2>
					</div>
					<?php }else{ ?>

					<form action="/newsletter/" method="post" class="form-horizontal newsletter-email">
						<div>
							<label for="email"><i class="icon-envelope"></i>
							<strong>Yes, keep me updated when new Boxes are up!</strong></label>
						</div>
							<input type="text" name="email" placeholder="Drop us your e-mail here" />
							<button class="btn" type="">Submit</button>
								<p class="help-block">
									<?php if( $form_error ){ ?>

										<?php if( $form_error_type['null'] ){ ?>

										There's a problem with your email.
										<?php } ?>

		
										<?php if( $form_error_type['syntax'] ){ ?>

										Hmm, the e-mail format doesn't seem quite right.
										<?php } ?>

										
										<?php if( $form_error_type['duplication'] ){ ?>

										The e-mail is already in the database.
										<?php } ?>

										
										<?php if( $form_error_type['database'] ){ ?>

										Oops, a database error has occurred! Please try again.
										<?php } ?>

									<?php } ?>

								</p>
					</form>
					<?php } ?>

			</div>
	</div>

	<!--
	<div class="row">
		<div class="vid-container">
			<iframe width="560" height="315" class="vid-box" src="http://www.youtube.com/embed/Ya3kW43s14M" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
	-->

</div>
