<?php
/* Smarty version 3.1.34-dev-7, created on 2020-12-29 09:49:33
  from 'C:\xampp\htdocs\ds_training\site\main\view\includes\hmenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5fea993dc08c75_57057196',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f16cb1104fe7f562e5afd942603f3e78fae4caa4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ds_training\\site\\main\\view\\includes\\hmenu.tpl',
      1 => 1608887225,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fea993dc08c75_57057196 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="hmenu" class="">
	<div id="hmenu-bg">
		<span class="hmenu-close"><i class="fa fa-remove"></i></span>
	</div>
	<div id="hmenu-canvas">
		<div id="hmenu-header">
			<?php if ($_smarty_tpl->tpl_vars['arg']->value['login'] == 0) {?>
			<a href="?mod=account&site=login">
				<i class="fa fa-user-circle-o"></i>
				<span>Hi, Vui lòng đăng nhập</span>
			</a>
			<?php } else { ?>
			<a href="?mod=account&site=index">
				<i class="fa fa-user-circle-o"></i>
				<span>Hi, <?php echo (($tmp = @$_smarty_tpl->tpl_vars['user']->value['name'])===null||$tmp==='' ? 'Đăng nhập' : $tmp);?>
</span>
			</a>
			<?php }?>
		</div>
		<div id="hmenu-content">
			<ul class="hmenu hmenu-translateX-left" data-id="1">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['a_main_category']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
				<li><div class="hmenu-item hmenu-title"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</div></li>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value['sub'], 's1', false, 'k1');
$_smarty_tpl->tpl_vars['s1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k1']->value => $_smarty_tpl->tpl_vars['s1']->value) {
$_smarty_tpl->tpl_vars['s1']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['k1']->value < 3) {?>
				<li>
					<a class="hmenu-item" data-id="<?php echo $_smarty_tpl->tpl_vars['s1']->value['id'];?>
">
						<?php echo $_smarty_tpl->tpl_vars['s1']->value['name'];?>

						<span class="pull-right"><i class="fa fa-chevron-right"></i></span>
					</a>
				</li>
				<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php if (count($_smarty_tpl->tpl_vars['v']->value['sub']) > 3) {?>
				<div class="collapse" id="more<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value['sub'], 's1', false, 'k1');
$_smarty_tpl->tpl_vars['s1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k1']->value => $_smarty_tpl->tpl_vars['s1']->value) {
$_smarty_tpl->tpl_vars['s1']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['k1']->value >= 3) {?>
				<li>
					<a class="hmenu-item" data-id="<?php echo $_smarty_tpl->tpl_vars['s1']->value['id'];?>
">
						<?php echo $_smarty_tpl->tpl_vars['s1']->value['name'];?>

						<span class="pull-right"><i class="fa fa-chevron-right"></i></span>
					</a>
				</li>
				<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
				<li><a type="button" class="hmenu-item hmenu-more" data-toggle="collapse" href="#more<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" role="button" aria-expanded="false">
					Xem tất cả <i class="fa fa-chevron-down"></i>
					</a>
				</li>
				<?php }?>
				<li class="hmenu-separator"></li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<li><div class="hmenu-item hmenu-title">Tài khoản</div></li>
				<li><a class="hmenu-item" href="?mod=account&site=index">Tài khoản của tôi</a></li>
				<li><a class="hmenu-item" href="?mod=account&site=orders">Đơn mua hàng</a></li>
				<li><a class="hmenu-item" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['url_helpcenter'];?>
">Trung tâm trợ giúp</a></li>
				<li><a class="hmenu-item" href="?mod=account&site=logout">Đăng xuất</a></li>
			</ul>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['a_main_category']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value['sub'], 's1');
$_smarty_tpl->tpl_vars['s1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['s1']->value) {
$_smarty_tpl->tpl_vars['s1']->do_else = false;
?>
			<ul class="hmenu hmenu-translateX-right" data-id="<?php echo $_smarty_tpl->tpl_vars['s1']->value['id'];?>
">
				<li><a class="hmenu-item hmenu-back"><i class="fa fa-arrow-left"></i> MAIN MEMU</a></li>
				<li><div class="hmenu-item hmenu-title"><?php echo $_smarty_tpl->tpl_vars['s1']->value['name'];?>
</div></li>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['s1']->value['sub'], 's2');
$_smarty_tpl->tpl_vars['s2']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['s2']->value) {
$_smarty_tpl->tpl_vars['s2']->do_else = false;
?>
				<li><a class="hmenu-item" href="<?php echo $_smarty_tpl->tpl_vars['s2']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['s2']->value['name'];?>
</a></li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	</div>
</div>

<?php echo '<script'; ?>
>
$('a.hmenu-item').click(function(){
	var data_id = $(this).attr('data-id');
	if(data_id && data_id!=0){
		$('ul.hmenu[data-id=1]').addClass('hmenu-translateX-left');
		$('ul.hmenu[data-id=1]').removeClass('hmenu-visible');
		$('ul.hmenu[data-id=1]').removeClass('hmenu-translateX');
		
		$('ul.hmenu[data-id='+data_id+']').addClass('hmenu-visible');
		$('ul.hmenu[data-id='+data_id+']').addClass('hmenu-translateX');
		$('ul.hmenu[data-id='+data_id+']').removeClass('hmenu-translateX-right');
	}
});

$('a.hmenu-back').click(function(){
	var data_id = $(this).parent().parent().attr('data-id');
	if(data_id && data_id!=0){
		$('ul.hmenu[data-id=1]').addClass('hmenu-visible');
		$('ul.hmenu[data-id=1]').addClass('hmenu-translateX');
		$('ul.hmenu[data-id=1]').removeClass('hmenu-translateX-left');
		
		$('ul.hmenu[data-id='+data_id+']').removeClass('hmenu-visible');
		$('ul.hmenu[data-id='+data_id+']').removeClass('hmenu-translateX');
		$('ul.hmenu[data-id='+data_id+']').addClass('hmenu-translateX-right');
	}
});
$('#hmenu .hmenu-close').click(function(){
	$('ul.hmenu').addClass('hmenu-translateX-left');
	$('ul.hmenu').removeClass('hmenu-visible');
	$('ul.hmenu').removeClass('hmenu-translateX');

	$('#hmenu').removeClass('hmenu-visible');
	$('#hmenu-bg').removeClass('hmenu-opaque');
	$('body').removeClass('lock-position');
});
$('.hmenu-open').click(function(){
	$('ul.hmenu[data-id=1]').removeClass('hmenu-translateX-left');
	$('ul.hmenu[data-id=1]').addClass('hmenu-visible');
	$('ul.hmenu[data-id=1]').addClass('hmenu-translateX');

	$('#hmenu').addClass('hmenu-visible');
	$('#hmenu-bg').addClass('hmenu-opaque');
	$('body').addClass('lock-position');
});
$('.hmenu-more').click(function(){
	var t = $(this).attr('aria-expanded');
	if(!t||t=='false'){
		$(this).html('Thu gọn <i class="fa fa-chevron-up"></i>');
	}else{
		$(this).html('Xem tất cả <i class="fa fa-chevron-down"></i>');
	}
});
<?php echo '</script'; ?>
><?php }
}
