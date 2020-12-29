<div id="hmenu" class="">
	<div id="hmenu-bg">
		<span class="hmenu-close"><i class="fa fa-remove"></i></span>
	</div>
	<div id="hmenu-canvas">
		<div id="hmenu-header">
			{if $arg.login eq 0}
			<a href="?mod=account&site=login">
				<i class="fa fa-user-circle-o"></i>
				<span>Hi, Vui lòng đăng nhập</span>
			</a>
			{else}
			<a href="?mod=account&site=index">
				<i class="fa fa-user-circle-o"></i>
				<span>Hi, {$user.name|default:'Đăng nhập'}</span>
			</a>
			{/if}
		</div>
		<div id="hmenu-content">
			<ul class="hmenu hmenu-translateX-left" data-id="1">
				{foreach from=$a_main_category item=v}
				<li><div class="hmenu-item hmenu-title">{$v.name}</div></li>
				{foreach from=$v.sub key=k1 item=s1}
				{if $k1 lt 3}
				<li>
					<a class="hmenu-item" data-id="{$s1.id}">
						{$s1.name}
						<span class="pull-right"><i class="fa fa-chevron-right"></i></span>
					</a>
				</li>
				{/if}
				{/foreach}
				{if count($v.sub) gt 3}
				<div class="collapse" id="more{$v.id}">
				{foreach from=$v.sub key=k1 item=s1}
				{if $k1 gte 3}
				<li>
					<a class="hmenu-item" data-id="{$s1.id}">
						{$s1.name}
						<span class="pull-right"><i class="fa fa-chevron-right"></i></span>
					</a>
				</li>
				{/if}
				{/foreach}
				</div>
				<li><a type="button" class="hmenu-item hmenu-more" data-toggle="collapse" href="#more{$v.id}" role="button" aria-expanded="false">
					Xem tất cả <i class="fa fa-chevron-down"></i>
					</a>
				</li>
				{/if}
				<li class="hmenu-separator"></li>
				{/foreach}
				<li><div class="hmenu-item hmenu-title">Tài khoản</div></li>
				<li><a class="hmenu-item" href="?mod=account&site=index">Tài khoản của tôi</a></li>
				<li><a class="hmenu-item" href="?mod=account&site=orders">Đơn mua hàng</a></li>
				<li><a class="hmenu-item" href="{$arg.url_helpcenter}">Trung tâm trợ giúp</a></li>
				<li><a class="hmenu-item" href="?mod=account&site=logout">Đăng xuất</a></li>
			</ul>
			{foreach from=$a_main_category item=v}
			{foreach from=$v.sub item=s1}
			<ul class="hmenu hmenu-translateX-right" data-id="{$s1.id}">
				<li><a class="hmenu-item hmenu-back"><i class="fa fa-arrow-left"></i> MAIN MEMU</a></li>
				<li><div class="hmenu-item hmenu-title">{$s1.name}</div></li>
				{foreach from=$s1.sub item=s2}
				<li><a class="hmenu-item" href="{$s2.url}">{$s2.name}</a></li>
				{/foreach}
			</ul>
			{/foreach}
			{/foreach}
		</div>
	</div>
</div>

<script>
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
</script>