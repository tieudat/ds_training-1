<div class="">
	<div class="container-fluid">
		<div class="cate-banner-wrap cate-banner-wrap-inner d-none d-md-block">
			<div class="text-center d-none d-sm-block">
				<div class="row justify-content-center row-sm">
					{foreach from=$a_ad.adhome.p1 item=data}
					<div class="col-5">
						<a href="{$data.alias}" target="_blank"><img src="{$data.image}" class="img-fluid"></a>
					</div>
					{/foreach}
				</div>
			</div>
		</div>
		<section class="d-flex cate-banner-wrap cate-banner-wrap-inner bg-white">
			<div class="cate-banner-menu-vertical d-none d-sm-block">
				<h5 class="cate-banner-menu-vertical-title">MY MARKETS</h5>
				<ul class="cate-banner-menu-vertical-title-ul">
					{foreach from=$a_main_category key=k item=v}
					{if $k lt 7}
					<li class="mega-menu-has-child">
						<a href="{$v.url}">
							<span class="icon-cate-banner">
								<img src="{$v.image}">
							</span>
							<span class="cate-banner-text text-oneline">{$v.name}</span>
							<span class="pull-right cate-banner-chevron"><i class="fa fa-chevron-right"></i></span>
						</a>
						<div class="mega-menu-dropdown mega-menu-lg mega-menu-dropdown-header">
							<div class="row">
								{foreach from=$v.sub key=k1 item=sub1}
								<div class="col-xl-4 col-md-4 col-sm-4 col-mega-vertical col-cus-padding">
									<h3 class="mega-menu-heading line-1">
										<a href="{$sub1.url}">{$sub1.name}</a>
									</h3>
									<ul>
										{foreach from=$sub1.sub key=k2 item=sub2}
										{if $k2 lt 6}
										<li><a href="{$sub2.url}" class="line-1">{$sub2.name}</a></li>
										{/if}
										{/foreach}
									</ul>
								</div>
								{/foreach}
							</div>
						</div>
					</li>
					{/if}
					{/foreach}
					<li class="mega-menu-has-child"><a href="?mod=product&site=allcategory">
							<span class="icon-cate-banner" style="padding:6px;">
								<img src="{$arg.url_img}all-36-36.png" style="width: 20px;">
							</span>
							<span class="cate-banner-text text-oneline">Tất Cả Danh Mục Sản Phẩm</span>
						</a>
						<ul class="mega-menu-dropdown mega-menu-dropdown-header">
							{foreach from=$a_main_category key=k item=v}
							{if $k gt 6}
							<li><a href="{$v.url}" class="line-1">{$v.name}</a></li>
							{/if}
							{/foreach}
						</ul>
					</li>
				</ul>
			</div> <!-- end cate-banner-menu-vertical-->
			<div class="cate-banner-slide">
				<div class="owl-carousel owl-1">
					{foreach from=$a_slider key=k item=v}
					<div class="item">
						<img src="{$v.image}" alt="" class="w-100">
					</div>
					{/foreach}
				</div>
			</div>
			<!--end cate-banner-slide-->
			<div class="cate-banner-select d-none d-sm-block">
				<h5 class="title-bg-blue ">Chương Trình Khuyến Mại</h5>
				<div class="promotion-list">
					{foreach from=$event item=v}
					<div class="promotion-list-line">
						<a href="" class="overlay-link"></a>
						<div class="title line-1">{$v.name}</div>
						<div class="view-more"><a href="{$v.url}">View more</a></div>
						<div class="item-banner">
							<img src="{$v.avatar}" class="zoom-in">
						</div>
					</div>
					{/foreach}
				</div>
			</div>
			<!--end cate-banner-select-->

		</section>
	</div>
</div>

<div class="main-content-wrap py-3">
	<section class="section-line-cate d-block d-sm-none">
		<ul class="nav">
			<li class="nav-item text-center">
				<a class="nav-link " href="javascript:void(0)" id="collapse_all_category"><img
						src="{$arg.url_img}m-ic-cate.png" height="30"></a>
				<p>Danh mục</p>
			</li>
			<li class="nav-item text-center">
				<a class="nav-link " href="{$arg.url_sourcing}"><img src="{$arg.url_img}m-ic-rfq.png"
						height="30"></a>
				<p>RFQ</p>
			</li>
			<li class="nav-item text-center">
				<a class="nav-link " href="#"><img src="{$arg.url_img}m-ic-event.png" height="30"></a>
				<p>Trưng bày</p>
			</li>
			<li class="nav-item text-center">
				<a class="nav-link " href="{$arg.url_helpcenter}"><img src="{$arg.url_img}m-ic-help.png" height="30"></a>
				<p>Trợ giúp</p>
			</li>
		</ul>
	</section>
	<!--end section cate-banner--->


	<section class="section-new-products">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<div class="row row-nm zone-top">
					<div class="col-md-6 col-6 d-block d-sm-none">
						<div class="card round10 border-0 ">
							<div class="d-flex align-items-center pb-2 px-sm-3 pt-2">
								<div class="flex-grow-1 text-oneline">
									<a href="?site=promotions&mod=product&src=HomePage"
										class="text-b text-nm text-dark">
										<span class="new-product-box-title-icon">
											<img src="{$arg.url_img}TB1XEafzAL0gK0jSZFAXXcA9pXa-40-40.png" height="16">
										</span>Khuyến Mại
									</a>
								</div>
							</div>
							<div class="row row-sm">
								{foreach from=$a_product_promo key=k item=v}
								<div class="col-md-3 col-6 {if $k ge 2}d-none d-lg-block{/if}">
									<div class="item p-1 p-sm-2 text-center">
										<a href="?site=promotions&mod=product&categoryId={$v.taxonomy_id}&src=HomePage"
											class="overlay-link"></a>
										<div class="new-product-box-img">
											<img class="img-fluid" src="{$v.avatar}">
											<span class="item-promo">-{$v.promo}%</span>
										</div>
										<p class="text-oneline">{$v.price_sale}</p>
									</div>
								</div>
								{/foreach}
							</div>
							<!-- end row -->
						</div>
					</div>
					<!-- END COL-4 -->
					<div class="col-md-6 col-6">
						<div class="card round10 border-0 ">
							<div class="d-flex align-items-center pb-2 px-sm-3 pt-2">
								<div class="flex-grow-1 text-oneline">
									<a href="?site=toprank&mod=product&src=HomePage" class="text-b text-nm text-dark">
										<span class="new-product-box-title-icon">
											<img src="{$arg.url_img}TB1XEafzAL0gK0jSZFAXXcA9pXa-40-40.png" alt=""
												height="16">
										</span> Top Bán Chạy
									</a>
								</div>
							</div>
							<div class="row row-sm">
								{foreach from=$a_product_toprank key=k item=v}
								<div class="col-md-3 col-6 {if $k ge 2}d-none d-lg-block{/if}">
									<div class="item p-1 p-sm-2 text-center">
										<a href="?site=toprank&mod=product&categoryId={$v.taxonomy_id}&src=HomePage"
											class="overlay-link"></a>
										<div class="new-product-box-img">
											<img class="img-fluid" src="{$v.avatar}">
										</div>
										<p class="text-oneline">MOD {$v.minorder} {$v.unit}</p>
									</div>
								</div>
								{/foreach}
							</div>
							<!-- end row -->
						</div>
					</div>
					<!-- END COL-4 -->
					<div class="col-md-6 col-6">
						<div class="card round10 border-0 new-product-box">
							<div class="d-flex bd-highlight pb-2 px-sm-3 pt-2">
								<div class="flex-grow-1 bd-highlight">
									<a href="?site=new&mod=product&src=HomePage" class="text-b text-nm text-dark">
										<span class="new-product-box-title-icon">
											<img src="{$arg.url_img}icon-packet.png" alt="" height="16">
										</span>Sản Phẩm Mới</a>
								</div>
							</div>
							<div class="row row-sm px-sm-3 pb-sm-3 px-0">
								{foreach from=$a_product_new key=k item=v}
								<div class="col-md-3 col-6 {if $k ge 2}d-none d-lg-block{/if}">
									<div class="item text-center">
										<a href="?site=new&mod=product&categoryId={$v.taxonomy_id}&src=HomePage"
											title="{$v.name}" class="overlay-link"></a>
										<div class="new-product-box-img">
											<img class="img-fluid" src="{$v.avatar}">
										</div>
										<p class="text-oneline">{$v.price}</p>
									</div>
								</div>
								{/foreach}
							</div>
							<!-- end row -->
						</div>
					</div>
					<!-- END COL-4 -->


					<div class="col-md-6 col-6 d-block d-sm-none">
						<div class="card round10 border-0 new-product-box">
							<div class="d-flex bd-highlight pb-2 px-sm-3 pt-2">
								<div class="flex-grow-1 bd-highlight">
									<a href="?site=readytoship&mod=product&src=HomePage"
										class="text-b text-nm text-dark">
										<span class="new-product-box-title-icon">
											<img src="{$arg.url_img}icon-packet.png" alt="" height="16">
										</span>Có Sẵn Trong Kho</a>
								</div>
							</div>
							<div class="row row-sm px-sm-3 pb-sm-3 px-0">
								{foreach from=$a_product_readytoship key=k item=v}
								<div class="col-md-3 col-6 {if $k ge 2}d-none d-lg-block{/if}">
									<div class="item text-center">
										<a href="?site=readytoship&mod=product&categoryId={$v.taxonomy_id}&src=HomePage"
											title="{$v.name}" class="overlay-link"></a>
										<div class="new-product-box-img">
											<img class="img-fluid" src="{$v.avatar}">
										</div>
										<p class="text-oneline">{$v.price}</p>
									</div>
								</div>
								{/foreach}
							</div>
							<!-- end row -->
						</div>
					</div>
					<!-- END COL-4 -->


					<div class="col-xl-6 col-sm-6 col-6 d-none d-sm-block">
						<div class="card round10 border-0 mt-2 mt-sm-3">
							<div class="pb-2 px-3 pt-2 d-none d-sm-block">
								<div class="flex-grow-1 bd-highlight card-zone-body bg-2">
									<h3 class="text-b my-2">Sản phẩm sẵn sàng giao hàng</h3>
									<p style="margin-right: 200px;">Nguồn từ 15 triệu sản phẩm
										sẵn sàng xuất xưởng và rời khỏi cơ sở trong vòng 15 ngày.</p>
								</div>

							</div>
							<div class="card-body pt-0">
								<div class="row row-sm">
									<div class="col-xl-6 col-md-6 col-sm-6 col-6">
										<div class="card bg-light border-0">
											<div class="card-body">
												<h3 class="text-nm-1 text-b text-center mb-4"><a
														href="?site=readytoship&mod=product">Sản Phẩm Có Sẵn Trong
														Kho</a></h3>
												<div class="row row-sm">
													{foreach from=$a_product_readytoship item=v}
													<div class="col-xl-4 col-4">
														<div class="bg-light">
															<a
																href="?site=readytoship&categoryId={$v.taxonomy_id}&mod=product">
																<img src="{$v.avatar}" class="img-fluid">
															</a>
														</div>
													</div>
													{/foreach}
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-md-6 col-sm-6 col-6">
										<div class="card bg-light border-0">
											<div class="card-body">
												<h3 class="text-nm-1 text-b text-center mb-4"><a
														href="?site=promotions&mod=product">Sản Phẩm Khuyến Mại</a></h3>
												<div class="row row-sm">
													{foreach from=$a_product_promo item=v}
													<div class="col-xl-4 col-4">
														<div class="bg-light">
															<a
																href="?site=promotions&categoryId={$v.taxonomy_id}&mod=product">
																<img src="{$v.avatar}" class="img-fluid">
															</a>
														</div>
													</div>
													{/foreach}
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end row -->
							</div>
							<!-- end card-body -->
						</div>
					</div>
					<!-- END COL-6 -->
					<div class="col-xl-6 col-sm-6 col-6 d-none d-sm-block">
						<div class="card round10 border-0 mt-2 mt-sm-3">
							<div class="pb-2 px-3 pt-2 d-none d-sm-block">
								<div class="flex-grow-1 bd-highlight card-zone-body bg-1">
									<h3 class="text-b my-2">Sản phẩm tùy chỉnh</h3>
									<p style="margin-right: 200px;">Hợp tác với một trong 60.000
										nhà sản xuất giàu kinh nghiệm với khả năng thiết kế &amp; sản xuất
										và giao hàng đúng hạn.</p>
								</div>

							</div>
							<div class="card-body pt-0">
								<div class="row row-sm">
									<div class="col-xl-6 col-md-6 col-sm-6 col-6">
										<div class="card bg-light border-0">
											<div class="card-body">
												<h3 class="text-nm-1 text-b text-center mb-4">
													<a href="?site=oem&mod=page">Sản Xuất Theo Yêu Cầu</a>
												</h3>
												<div class="row row-sm">
													{foreach from=$a_product_page_oem item=v}
													<div class="col-xl-4 col-4">
														<div class="bg-light">
															<a href="?site=oem&categoryId={$v.taxonomy_id}&mod=page">
																<img src="{$v.avatar}" class="img-fluid">
															</a>
														</div>
													</div>
													{/foreach}
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-md-6 col-sm-6 col-6">
										<div class="card bg-light border-0">
											<div class="card-body">
												<h3 class="text-nm-1 text-b text-center mb-4"><a
														href="?site=toprank&mod=page">Nhà Cung Cấp Hàng Đầu</a></h3>
												<div class="row row-sm">
													{foreach from=$a_product_page_toprank item=v}
													<div class="col-xl-4 col-4">
														<div class="bg-light">
															<a
																href="?site=toprank&categoryId={$v.taxonomy_id}&mod=page">
																<img src="{$v.avatar}" class="img-fluid">
															</a>
														</div>
													</div>
													{/foreach}
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end row -->
							</div>
							<!-- end card-body -->
						</div>
					</div>
					<!-- END COL-6 -->
				</div>
			</div>
		</div>
	</section>

	{foreach from=$a_home_category key=k item=data}
	<section class="section-home-cate section-product-line mt-4">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<h2 class="title-has-line"><a href="{$data.url}">{$data.name}</a></h2>
				<div class="category-info">
					<a href="{$data.url}">
						<div class="banner-info">
							<h3>{$data.banner.title}</h3>
							<img src="{$data.banner.image}">
							<span style="color: rgb(216, 180, 135);">Xem ngay</span>
						</div>
					</a>
					<div class="product-item">
						<div class="product-info">
							<a href="?site=oem&mod=page&categoryId={$data.id}" class="overlay-link">
								<div class="item-info">
									<h4>
										<img src="{$arg.url_img}TB1neG1rHj1gK0jSZFOXXc7GpXa-32-32.png"><span>Nhà Máy Gia
											Công</span>
									</h4>
									<div class="info-sub">
										<span>Gia công sản phẩm theo yêu cầu</span>
									</div>
									<div class="certificate">
										<i class="icbu-certificate-icon icbu-certificate-icon-verified"
											data-spm-anchor-id="a2700.8293689.0.i5.2ce267afDE4CmZ"></i><i
											class="icbu-certificate-icon icbu-certificate-icon-cb"></i><i
											class="icbu-certificate-icon icbu-certificate-icon-ce"></i><i
											class="icbu-certificate-icon icbu-certificate-icon-emc"></i><i
											class="icbu-certificate-icon icbu-certificate-icon-gs"></i><i
											class="icbu-certificate-icon icbu-certificate-icon-rohs"></i><i
											class="icbu-certificate-icon icbu-certificate-icon-tuv"></i>
									</div>
									<img class="zoom-in-1" src="{$data.products[0]['avatar']}" style="height: 160px;">
								</div>
							</a>
						</div>
						<div class="product-info">
							<a href="?site=toprank&mod=product&categoryId={$data.id}">
								<div class="item-info">
									<h4><span>Top Sản Phẩm Nổi Bật</span></h4>
									<div class="info-sub">
										<img src="{$arg.url_img}TB1WB9WrQP2gK0jSZPxXXacQpXa-32-32.png">
										<span>{$data.products[1]['name']}</span>
									</div>
									<img class="zoom-in-1" src="{$data.products[1]['avatar']}" style="height: 85px;">
								</div>
							</a>
							<a href="?site=promotions&mod=product&categoryId={$data.id}">
								<div class="item-info">
									<h4><span>Top Sản Phẩm Bán Chạy</span></h4>
									<div class="info-sub">
										<img
											src="{$arg.url_img}TB1WB9WrQP2gK0jSZPxXXacQpXa-32-32.png"><span>{$data.products[2]['name']}</span>
									</div>
									<img class="zoom-in-1" src="{$data.products[2]['avatar']}" style="height: 85px;">
								</div>
							</a>
						</div>

						<div class="product-info">
							{foreach from=$data.sub key=k item=sub}
							{if $k lt 2}
							<a href="{$sub.url}">
								<div class="item-info">
									<h4><span>{$sub.name}</span></h4>
									<img class="zoom-in-1" src="{$sub.image}" style="height: 85px;">
								</div>
							</a>
							{/if}
							{/foreach}
						</div>
						<div class="product-info">
							{foreach from=$data.sub key=k item=sub}
							{if $k gte 2}
							<a href="{$sub.url}">
								<div class="item-info">
									<h4><span>{$sub.name}</span></h4>
									<img class="zoom-in-1" src="{$sub.image}" style="height: 85px;">
								</div>
							</a>
							{/if}
							{/foreach}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end section-product-line -->
	{/foreach}
	<!--end section-product-line -->
	<section class="moreChannel d-block d-sm-none">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<div class="card round10 border-0 ">
					<div class="d-flex align-items-center pb-2 px-sm-3 pt-2">
						<div class="flex-grow-1 text-oneline">
							<a href="" class="text-b text-nm-1 text-dark">
								<span class="new-product-box-title-icon">
								</span>Các kênh khác</a>
						</div>
					</div>
					<div class="row row-sm">
						{foreach from=$a_home_category key=k item=data}
						<div class="col-3 ">
							<div class="item p-1 p-sm-2 text-center">
								<p class="line-2"><a href="{$data.url}">{$data.name}</a></p>
								<div class="img-item-chanel">
									<img class="img-fluid" src="{$data.image}">
								</div>
							</div>
						</div>
						{/foreach}
						<div class="col-3 ">
							<div class="item p-1 p-sm-2 text-center">
								<p class="line-2"><a href="?site=toprank&mod=page">Nhà cung cấp hàng đầu</a></p>
								<div class="img-item-chanel">
									{foreach from=$a_product_page_toprank key=k item=v}
									{if $k eq 0}<img class="img-fluid" src="{$v.avatar}">{/if}
									{/foreach}
								</div>
							</div>
						</div>
					</div>
					<!-- end row -->
				</div>
			</div>
		</div>
	</section>
	<section class="section-product-line section-market-list clearfix mt-4 d-none d-sm-block">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<div class="w-100">
					<div class="row">
						<div class="col-xl-6">
							<h2 class="title-has-line">
								<a href="?site=promotions&mod=product">Khuyến Mại Trong Tuần</a>
							</h2>
							<div class="d-flex">
								<div class="banner-layout bg-1">
									<h3>Giảm giá từ 10%</h3>
									<p>Khuyến mãi còn:</p>
									<div class="countdown" data-countdown="{$arg.end_countdown}"></div>
									<a class="link" href="?site=promotions&mod=product">Xem ngay</a>
								</div>
								<div class="list-layout">
									<div class="d-flex w-100">
										{foreach from=$a_product_promo key=k item=v}
										{if $k lt 2}
										<div class="new-product-box-col">
											<a href="?site=promotions&mod=product" class="overlay-link"></a>
											<div class="new-product-box-img">
												<img src="{$v.avatar}" alt="" class="zoom-in">
											</div>
											<div class="new-product-box-info">
												<p class="new-price">{$v.price_sale}</p>
												<p class="old-price">
													<del>{$v.price|default:0|number_format}đ</del>
													<span class="tag-sale">{$v.promo}%</span>
												</p>
											</div>
										</div>
										{/if}
										{/foreach}
									</div>
								</div>
							</div>

							<!-- end row -->
						</div>
						<!-- END COL-6 -->
						<div class="col-xl-6">
							<h2 class="title-has-line">
								<a href="?site=readytoship&mod=product">Mua Hàng Giao Ngay</a>
							</h2>
							<div class="d-flex">
								<div class="banner-layout bg-2">
									<h3>Một loạt sản phẩm có sẵn trong kho, giao hàng nhanh chóng</h3>
									<a class="link" href="?site=readytoship&mod=product">Xem ngay</a>
								</div>
								<div class="list-layout">
									<div class="d-flex w-100">
										{foreach from=$a_product_readytoship key=k item=v}
										{if $k lt 2}
										<div class="new-product-box-col">
											<a href="?site=readytoship&mod=product" class="overlay-link"></a>
											<div class="new-product-box-img">
												<img src="{$v.avatar}" alt="" class="zoom-in">
											</div>
											<div class="new-product-box-info">
												<p class="new-price">{$v.price}</p>
												<p class="old-price">{$v.minorder} {$v.unit}</p>
											</div>
										</div>
										{/if}
										{/foreach}
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
					</div>
					<!-- END COL-6 -->
				</div>
			</div>
		</div>
	</section>
	<!--end section market list-->
	<section class="section-require mt-4 d-none d-sm-block">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<div class="require-block w-100 bg-white">
					<div class="row justify-content-around">
						<div class="col-md-5 d-none d-sm-block" id="connect-buyer1">
							<div class="card-body">
								<div class="p-15">
									<h2>Nhận <b>miễn phí</b> báo giá từ nhiều nhà bán hàng</h2>
									<ul>
										<li><i class="hm-icn9"></i>
											<p>Cho chúng tôi biết<br> <b>Bạn cần gì</b></p>
										</li>
										<li><i class="hm-icn10"></i>
											<p>Nhận báo giá <br>từ <b>người bán hàng</b></p>
										</li>
										<li><i class="hm-icn11"></i>
											<p>Thỏa thuận <br>để <b> chốt giao dịch</b></p>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-4" id="quote-form">
							<div class="card-body">
								<div class="p-15">
									<h4>Để Lại Yêu Cầu Của Bạn</h4>
									<form id="SendRFQ" class="general-form menu-item-right">
										<div class="form-group">
											<input type="text" class="form-control" name="title"
												placeholder="Nhập tên sản phẩm/ dịch vụ">
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i
														class="fa fa-envelope-o" aria-hidden="true"></i></span>
											</div>
											<input type="text" class="form-control" placeholder="Nhập email của bạn"
												aria-label="Username" aria-describedby="basic-addon1">
										</div>
										<label for="" class="small-dess">Người bán sẽ liên hệ qua email</label>
										<div class="form-group">
											<input type="text" class="form-control" name="number"
												placeholder="Nhập số lượng cần mua">
										</div>
										<div class="d-flex justify-content-start">
											<button type="button" onclick="SendRFQ();" class="btn btn-requirement">Gửi
												yêu cầu của bạn</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end section requied-->

	<section class="section-product-line mt-4">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<h2 class="title-has-line"><a href="#">Sản Phẩm Gợi Ý Cho Bạn</a></h2>
				<div id="product_justforyou"></div>
			</div>
		</div>
	</section>

	<section class="section-city in-mart-sec mt-4 mb-3">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<div class="city-wrap">
					<h2 class="india-title">
						<a href="?mod=page&site=index" class="text-dark">Tìm nhà cung cấp theo Top tỉnh thành</a>
					</h2>
					<div class="row city-link d-flex">
						{foreach from=$hot_location item=v}
						<div class="col ct1">
							<a href="?mod=page&site=index&location={$v.Id}">
								<img alt="{$v.Name}" src="{$v.img}">
								<span class="txt">{$v.Name}</span>
							</a>
						</div>
						{/foreach}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end section-city-->
</div>
<div class="filter fcategory d-block d-sm-none">
	<div class="d-flex justify-content-start bd-highlight p-3 border-bottom">
		<div class="bd-highlight"><a href="{$arg.domain}"><img src="{$arg.stylesheet}images/arrow-l.png"></a></div>
		<div class="bd-highlight text-lg text-b pl-3">Tất cả danh mục</div>
		<div class="bd-highlight">&nbsp;</div>
	</div>
	<ul>
		{foreach from=$a_main_category item=v}
		<li class="nav-item"><a href="{$v.url}" class="nav-link d-flex align-items-center text-nm-1 text-dark"><img
					src="{$v.image}" height="50"><span class="pl-2">{$v.name}</span><span
					class="pull-right cate-banner-chevron"><i class="fa fa-chevron-right"></i></span>
			</a></li>
		{/foreach}
	</ul>
</div>
{literal}
<script>
	$('.owl-1').owlCarousel({
		loop: true,
		thumbsPrerendered: true,
		items: 1,
		nav: true,
		thumbs: true,
		autoplay:true,
      	autoplayTimeout:5000,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]
	});
	function SendRFQ() {
		var title = $('#SendRFQ input[name=title]').val();
		setTimeout(function () {
			location.href = 'https://v2.daisan.vn/sourcing?site=createRfq&title=' + title;
		}, 1000);
	}
</script>
<script type="text/javascript">
	$('#collapse_all_category').on('click', function () {
		$(".filter").addClass("active");
		$('.overlay').fadeIn();
	});
</script>
{/literal}