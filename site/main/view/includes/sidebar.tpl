<div class="p-3">
	<div id="avatar" class="text-center">
		<div class=" mx-4"><img class="rounded-circle" alt="avatar" src="{$user.avatar}" width="100%"></div>
	</div>
	<h4 class="mt-3 text-center">{$user.name|default:''}</h4>
</div>

<div class="list-group list-group-flush">
	<a href="?mod=account&site=index" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-user-o"></i> Thông tin tài khoản</a>
	<a href="?mod=account&site=pages" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-diamond"></i> Quản lý gian hàng</a>
	<a href="?mod=account&site=pagefavorites" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-eye"></i> Gian hàng theo dõi</a>
	<a href="?mod=account&site=productfavorites" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-heart-o"></i> Sản phẩm quan tâm</a>
	<a href="?mod=account&site=orders" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-shopping-cart"></i> Đơn đặt hàng</a>
	<a href="?mod=account&site=messages" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-envelope-o"></i> Tin nhắn và liên hệ</a>
	<a href="?mod=account&site=rfq" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-file-o"></i> Danh sách nhu cầu</a>
	<a href="#" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-cog"></i> Cài đặt riêng tư</a>
</div>

