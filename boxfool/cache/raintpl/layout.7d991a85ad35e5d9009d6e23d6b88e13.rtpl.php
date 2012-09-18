<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $window_title;?></title>
	</head>
	<body>
	
		<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("".$adm_page."") . ( substr("".$adm_page."",-1,1) != "/" ? "/" : "" ) . basename("".$adm_page."") );?>


	</body>
</html>
