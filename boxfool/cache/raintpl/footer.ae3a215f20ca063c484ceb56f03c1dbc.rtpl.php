<?php if(!class_exists('raintpl')){exit;}?><?php if( $is_home ){ ?>

<div class="container">
    <div class="row">
        <section class="bottom-content">
            <div class="hiw-header">
                <span class="hiw-left"></span>
            </div>
            <div class="span12">
                <div class="row">
                    <div class="span3">
                        <div class="content">
                            <h3>We Curate</h3>
                            <p style="text-align:left"><img src="/images/icon_curate.png" alt="We Curate" class="left" />Boxstars choose their favorite items for a Boxfool theme.</p>
                            <!--span class="guaranteed-stamp"></span-->
                        </div>
                    </div>
                    <div class="span3 col">
                        <div class="content">
                            <h3>You Subscribe</h3>
                            <p style="text-align:left"><img src="/images/icon_subscribe.png" alt="You Subscribe" class="left" />Flexible payment options: credit card, PayPal and bank transfers.</p>
                        </div>
                    </div>
                    <div class="span3 col">
                        <div class="content">
                            <h3>You Receive</h3>
                            <p style="text-align:left"><img src="/images/icon_receive.png" alt="You Receive" class="left" />Every quarter, your Boxfool is sent directly to your doorstep.</p>
                        </div>
                    </div>
                    <div class="span3 col">
                        <div class="content">
                            <h3>You Like</h3>
                            <p style="text-align:left"><img src="/images/icon_like.png" alt="You Like" class="left" />Enjoy your Boxfool of goodies! Love it? Tell your friends!
                            </p>
                        </div>

                        <!--span class="sprite box-stamps"></span-->

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php } ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span4">
                        <div class="content">
                            <p><b>Boxfool sends you a pack of awesome goodies every 3 months.</b> Based around specific themes, all Boxfool items are handpicked by our panel of Boxstars - influential individuals who are interesting, original and have good taste. Go on, surprise yourself!</p>
                            <address class="contact">
                                p: <span class="phonenum">(+603) 7887 1709</span>
																<br />e: <a href="mailto:hello@boxfool.com">hello@boxfool.com</a>
                            </address>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="content">
                            <h3 class="title"><a href="http://twitter.com/boxfool" style="color:#fff">Twitter</a></h3>
                            <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("".$tweetfools."") . ( substr("".$tweetfools."",-1,1) != "/" ? "/" : "" ) . basename("".$tweetfools."") );?>

                        </div>
                    </div>
                    <div class="span4">
                        <div class="content">
                            <h3 class="title"><span style="color:#ccc">fool</span>low Us</h3>
                            <div class="social-networks">
                                <ul class="social-links">
                                    <li><a href="http://www.facebook.com/boxfool" target="_blank"><span class="sprite facebook"></span></a></li>
                                    <li><a href="http://twitter.com/boxfool" target="_blank"><span class="sprite twitter"></span></a></li>
                                    <li><a href="http://pinterest.com/boxfool" target="_blank"><span class="sprite pinterest"></span></a></li>
                                </ul>
                                <!--span class="certified"></span-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"><div class="span12"><span class="link-top"></span></div></div>
                <ul class="links">
                    <li><a href="/about">About</a></li>
										<li><a href="/faq">FAQ</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <!--li><a href="#">Policies</a></li-->
                </ul>
                <span class="copy">&copy; Boxfool <?php echo date( "Y" );?>. A product by EzyPzy Sdn Bhd.</span>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="/js/boxfool.js"></script>
</body>
</html>
