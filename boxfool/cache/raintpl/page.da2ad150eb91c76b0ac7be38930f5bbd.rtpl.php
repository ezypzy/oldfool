<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>

<section class="main-content">
    <div class="container">
        <div class="row" style="background:#fff">
            <div class="span12">
                <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("".$breadcrumb."") . ( substr("".$breadcrumb."",-1,1) != "/" ? "/" : "" ) . basename("".$breadcrumb."") );?>

                <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("".$page."") . ( substr("".$page."",-1,1) != "/" ? "/" : "" ) . basename("".$page."") );?>

						</div>
        </div>
    </div>
</section>
<div class="row"><div class="span12"><p>&nbsp;</p></div></div>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

