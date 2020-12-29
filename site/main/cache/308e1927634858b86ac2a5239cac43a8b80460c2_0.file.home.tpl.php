<?php
/* Smarty version 3.1.34-dev-7, created on 2020-12-29 09:51:03
  from 'C:\xampp\htdocs\ds_training\site\main\view\layouts\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5fea9997835d99_94738205',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '308e1927634858b86ac2a5239cac43a8b80460c2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ds_training\\site\\main\\view\\layouts\\home.tpl',
      1 => 1609210260,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/header.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
),false)) {
function content_5fea9997835d99_94738205 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta http-equiv="Content-Type" content="application/xhtml+xml">
<base href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['domain'];?>
">
<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['metadata']->value['title'])===null||$tmp==='' ? 'Daisan.vn' : $tmp);?>
</title>
<meta name="keywords" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['metadata']->value['keyword'])===null||$tmp==='' ? 'daisan' : $tmp);?>
" />
<meta name="description" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['metadata']->value['description'])===null||$tmp==='' ? 'daisan' : $tmp);?>
" />
<meta name="robots" content="INDEX,FOLLOW"/>
<meta name="revisit-after" content="1 days" />
<meta property="og:image" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['metadata']->value['image'])===null||$tmp==='' ? '' : $tmp);?>
" />
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['img_gen'];?>
favicon.ico" rel="shortcut icon" type="image/x-icon">


<!-- Bootstrap -->
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/jquery-ui.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/pnotify.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/animate.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/custom.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/style.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/mobile.css" rel="stylesheet">


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery-3.2.1.slim.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery-1.12.4.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/popper.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/bootstrap.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/pnotify.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery-ui.min.js" type="text/javascript"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>var str_arg = '<?php echo $_smarty_tpl->tpl_vars['js_arg']->value;?>
';<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/custom.js"><?php echo '</script'; ?>
>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
</head>
<body>
	
	<?php $_smarty_tpl->_subTemplateRender('file:../includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	<?php $_smarty_tpl->_subTemplateRender('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
</body>
</html><?php }
}
