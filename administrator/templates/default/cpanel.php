<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo  $this->language; ?>" lang="<?php echo  $this->language; ?>" dir="<?php echo  $this->direction; ?>" id="minwidth" >
<head>
<jdoc:include type="head" />

<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/template.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/960_fluid.css" rel="stylesheet" type="text/css" media="screen and (min-width:1025px)" />
<link href="templates/tablet/css/960_fluid.css" rel="stylesheet" type="text/css" media="screen and (max-width: 1024px)" />
<?php if($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo  $this->template ?>/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<!--[if IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/<?php echo  $this->template ?>/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="templates/<?php echo  $this->template ?>/css/rounded.css" />

<?php if(JModuleHelper::isEnabled('menu')) : ?>
	<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/menu.js"></script>
	<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/index.js"></script>
<?php endif; ?>

</head>
<body id="minwidth-body" class="<?php echo JRequest::getVar('option', 'cmd'); ?>">
	<div id="header-box">
		<div class="container_16 clearfix">
			<div class="grid_16">
				<div id="module-status">
					<jdoc:include type="modules" name="status"  />
				</div>
				<div id="module-menu">
					<jdoc:include type="modules" name="menu" />
				</div>
			</div>
		</div>
	</div>
	<div id="content-box">
		<div id="element-box" class="container_16 clearfix">
			<div class="grid_16 frame cpanel clearfix">
				<div class="grid_8">
					<jdoc:include type="modules" name="icon" />
				</div>
				<div class="grid_8">
					<jdoc:include type="message" />
					<jdoc:include type="component" />
				</div>
			</div>
		</div>
	</div>
</body>
</html>
