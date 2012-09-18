<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>

<div class="clearfix"></div>
<section class="featured">
    <div class="box">
        <div class="box-top">&nbsp;</div>
        <ul class="boxstars">
            <li class="first">
                <img src="images/featured/davidchong.png" alt="David Chong">
                <a href="#" class="learnmore">Learn more</a>
            </li>
            <li class="last">
                <img src="images/featured/chloe.png" alt="Ms. Chloe">
                <a href="#" class="learnmore">Learn more</a>
            </li>
        </ul>
        <div class="box-bottom">
            <blockquote class="quote-left quote">
                His quote here
            </blockquote>
            <blockquote class="quote-right quote">
                Her quote here
            </blockquote>
        </div>
        <div class="featured-banner">
            Handpicked "Boxfool of Surprises" delivered to you every quarter for only RM90
        </div>
    </div>
</section>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

