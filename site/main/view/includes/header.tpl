<header>
	<div id="head_link">
		<img class="d-none d-md-block w-100" src="{$arg.img_gen}a.jpg">
	</div>
	<div id="head_top">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg">
				<button class="btn btn-menu hmenu-open" type="button">
					<img src="https://v2.daisan.vn/site/main/webroot/images/nav-menu-black.png" height="18">
				</button>
				<a class="navbar-brand" href="./"><img src="{$arg.logo.image|default:$arg.noimg}" height="32"></a>
				<div class="d-flex align-items-center ml-auto d-block d-sm-none">
					<div class="p-2 bd-highlight">
						{if $arg.login eq 0}
						<a href="./login" class="">Đăng nhập </a>
						{else}
						Chào, <b>{$hcache.user.name|default:'Đăng nhập'}</b>
						{/if}
					</div>
					<div class="p-2 bd-highlight shoping-cart">
						<a href="?mod=product&site=cart">
							<span class="icon-menu"><img src="{$arg.url_img}cart-black.png" height="27">
							</span> <span class="badge" id="cart-number-mb">0</span>
						</a>
					</div>
				</div>
				<div class="form-search d-block d-sm-none">
					<input type="text" id="mKeyword" value="{$main_filter.key|default:''}" placeholder="Search Daisan">
					<button class="btn search-btn" onclick="msearch();">
						<i class="fa fa-search"></i>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<div class="form-search input-group my-2 my-lg-0">
						<input type="hidden" id="filter_cate_id" value="{$main_filter.t|default:0}">
						<div class="input-group-prepend">
							<button class="open-cate">{$main_filter.t_txt|default:'Tất cả'} <i class="fa fa-caret-down"></i></button>
						</div>
						<input class="form-control" type="text" id="Keyword" value="{$main_filter.key|default:''}">
						<button class="btn search-btn" type="button" onclick="search();"><i class="fa fa-search fa-fw"></i></button>

						<div class="cate-in-search">
							<div class="card card-body border-0">
								<h2 class="text-lg text-b">Tìm trong danh mục ...</h2>
								<div class="row">
									<div class="col-4">
										<a href="javascript:void(0);" onclick="set_search_cate(0);" id="search_cate_0" class="line-1 mb-2 d-block">Tất cả danh mục</a>
									</div>
									{foreach from=$a_main_category key=k item=v}
									<div class="col-4">
										<a href="javascript:void(0);" onclick="set_search_cate({$v.id});" id="search_cate_{$v.id}" class="line-1 mb-2 d-block" title="{$v.name}">{$v.name}</a>
									</div>
									{/foreach}
								</div>
							</div>

						</div>
					</div>
					<ul class="navbar-nav ml-auto nav-right">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<p class="mb-0"><small>Chào, {$hcache.user.name|default:'Đăng nhập'}</small></p>
								Tài khoản của tôi
							</a>
							<div class="dropdown-menu dropdown-menu-hover dropdown-menu-right"
								aria-labelledby="bd-versions">
								{if $arg.login eq 0}
								<a class="btn btn-warning btn-block mt-3" href="?mod=account&site=login">Đăng nhập tài khoản</a>
								<a class="btn btn-secondary btn-block mb-3" href="?mod=account&site=register">Đăng ký tài khoản</a>
								{else}
								<a class="dropdown-item" href="?mod=account&site=orders">Quản lý mua hàng<!-- <span class="pull-right">3</span> --></a>
								<a class="dropdown-item" href="{$arg.url_helpcenter}">Chính sách vận chuyển</a>
								<a class="dropdown-item" href="{$arg.url_helpcenter}">Dịch vụ khách hàng</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?mod=account&site=pages">Gian hàng bán</a>
								<!-- <a class="dropdown-item" href="#">Sản phẩm theo dõi</a> -->
								<a class="dropdown-item" href="?mod=account&site=rfq">Yêu cầu báo giá</a>
								<a class="dropdown-item" href="?mod=account&site=index">Tài khoản của tôi</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?mod=account&site=logout">Đăng xuất</a>
								{/if}
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?mod=account&site=orders">
								<p class="mb-0"><small>Quản lý</small></p>
								Đơn hàng
							</a>
						</li>
						<li class="nav-item nav-cart">
							<a class="nav-link" href="?mod=product&site=cart">
								<img src="{$arg.url_img}cart-black.png" height="30">
								<span class="cart-number" id="cart-number">0</span>
								Cart
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div id="head_main">
		<div class="container-fluid">
			<div class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar align-items-center navbar-nav-scroll ">
				<div class="dropdown" id="hplace">
					<a class="ship-location" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown"> 
						<span class="img-location-ship"></span>
						Giao tới<br>{$hcache.place.name|default:'Hà Nội'}
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						{foreach from=$tax.province item=v}
						<a class="dropdown-item" href="javascript:void(0)" onclick="SetDelive({$v.Id}, '{$v.Name}');">{$v.Name}</a>
						{/foreach}
					</div>
				</div>
				<div class="pl-sm-5 pl-0">
					<ul class="navbar-nav bd-navbar-nav flex-row">
						<li class="nav-item">
							<a class="nav-link py-1 line-1" href="?site=promotions&mod=product">Ưu Đãi Hôm Nay</a>
						</li>
						<li class="nav-item">
							<a class="nav-link py-1 line-1" href="{$arg.url_sourcing}">Yêu Cầu Báo Giá</a>
						</li>
						<li class="nav-item">
							<a class="nav-link py-1 line-1" href="{$arg.url_helpcenter}search.html?cId=932">Bán Cùng Daisan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link py-1 line-1" href="{$arg.url_helpcenter}search.html?cId=898">Chính Sách Khách Hàng</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle py-1 line-1" data-toggle="dropdown" href="#">Các Lĩnh Vực</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="https://books.daisan.vn" target="_blank">Daisan Books (Sách)</a> 
								<a class="dropdown-item" href="https://beauty.daisan.vn" target="_blank">Daisan Beauty (Làm đẹp)</a> 
								<a class="dropdown-item" href="https://auto.daisan.vn" target="_blank">Daisan Auto (Xe cộ)</a>
								<a class="dropdown-item" href="https://agri.daisan.vn" target="_blank">Daisan Agri (Nông nghiệp)</a>
							</div></li>

					</ul>
				</div>

				<ul class="navbar-nav ml-md-auto d-none d-sm-block">
					<li class="nav-item">
						<a class="nav-link pl-2 pr-1 mx-1 py-1 font-weight-bold" href="{$arg.url_helpcenter}">
							<i class="fa fa-bell-o fa-fw"></i>Trung tâm trợ giúp Daisan</a>
					</li>

				</ul>
			</div>
		</div>
	</div>
</header>