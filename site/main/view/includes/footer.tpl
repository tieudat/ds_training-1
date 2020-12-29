<footer id="footer">
	<div class="back-top text-center" id="totop">Back to top</div>
	<div class="container-fluid">
		<div class="cate-banner-wrap">
			<div class="row wrap-footer-col">
				{foreach from=$a_menu_foot item=data}
				<div class="col-xl-3">
					<h4 class="footer-title">{$data.name}</h4>
					<ul>
						{foreach from=$data.submenu item=sub1}
						<li><a href="{$sub1.url}">{$sub1.name}</a></li>
						{/foreach}
					</ul>
				</div>
				{/foreach}
			</div>
		</div>
	</div>
	<div class="footer-choose  d-none d-sm-block">
		<div class="container-fluid">
			<div class="footer-choose-wrap d-flex justify-content-center">
				<div class="logo-footer">
					<img src="{$arg.url_img}logo-white.png" height="30">
				</div>
				<div class="footer-choose-option-wrap">
					<div class="fake-select select-lang">
						<span class="icon-lang"></span> <span class="text-lang">Tiếng Việt - VI</span> <span class="up-down-arr"></span>

					</div>
					<div class="fake-select">
						<span class="icon-money"></span> <span class="text-lang">đ
							- Việt Nam đồng</span> <span class="up-down-arr"></span>
					</div>
					<div class="fake-select">
						<span class="icon-co"></span> <span class="text-lang">Việt Nam</span> <span class="up-down-arr"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-link d-none d-sm-block">
		<div class="container-fluid">
			<div class="cate-banner-wrap">
				<div class="wrap-footer-col">
					<div class="card-columns">
						<div class="card text-white bg-transparent">
							<a href="http://daisangroup.vn/">
								Daisan Group
								<br>
								<span class="">www.daisangroup.vn</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">
								Thế giới ốp lát
								<br>
								<span class="">www.thegioioplat.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">
								Daisan Express
								<br>
								<span class="">www.daisanexpress.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Daisan Export<br>
								<span class="">www.daisanexport.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Daisan Mart<br>
								<span class="">www.daisanmart.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Daisan Plus<br>
								<span class="">www.daisanplus.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Phân phối gạch bông<br>
								<span class="">www.phanphoigachbong.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Thế giới gạch bông<br>
								<span class="">www.thegioigachbong.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Mosaic Thăng Long<br>
								<span class="">www.mosaicthanglong.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Daisan Mosaic<br>
								<span class="">www.daisanmosaic.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Vina Mosaic<br>
								<span class="">www.vinamosaic.net</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Vietnam Mosaic<br>
								<span class="">www.vietnammosaic.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Saigon Mosaic<br>
								<span class="">www.saigonmosaic.net</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Viet Mosaic<br>
								<span class="">www.vietmosaic.net</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Gạch Inax<br>
								<span class="">www.gachinax.com.vn</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Gạch Prime<br>
								<span class="">www.gachprime.vn</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Daisan News<br>
								<span class="">www.daisannews.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Dự Án Toàn Quốc<br>
								<span class="">www.duantoanquoc.com</span>
							</a>
						</div>
						<div class="card text-white bg-transparent">
							<a href="#">Sông Lục<br>
								<span class="">www.songluc.com.vn</span>
							</a>
						</div>
					</div>
					<!--end card-columns-->
					<div class="pt-2 text-center">
						<ul class="list-inline">
							<li class="list-inline-item"><a href="#"> Điều khoản sử dụng </a></li>
							<li class="list-inline-item"><a href="#"> Quyền riêng tư </a></li>
							<li class="list-inline-item"><a href="#"> Trợ giúp </a></li>
							<li class="list-inline-item li_last">© 2009-2020, Daisan., JSC. or its affiliates</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bottomNavbar bg-white d-block d-sm-none">
		<div class="row row-sm">
			<div class="col text-center">
				<a href="./" class="active"><span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
					<p>Home</p>
				</a>
			</div>
			<div class="col text-center">
				<a href="#"><span class="icon"><i class="fa fa-rss" aria-hidden="true"></i></span>
					<p>Tin mới</p>
				</a>
			</div>
			<div class="col text-center">
				<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">
					<span class="icon"><i class="fa fa-commenting" aria-hidden="true"></i></span>
					<p>Liên hệ</p>
				</a>
			</div>
			<div class="col text-center">
				<a href="?mod=product&site=cart"><span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
					<p>Giỏ hàng</p>
				</a>
			</div>
			<div class="col text-center">
				<a href="?mod=account&site=index"><span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span>
					<p>Tài khoản</p>
				</a>
			</div>
		</div>
	</div>
</footer>

<div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog  modal-lg" role="document">
		<div class="modal-content rounded-0">
			<div class="modal-header">
				<h5>Để lại số điện thoại, chúng tôi sẽ gọi lại tư vấn ngay</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body mt-0">
				<div class="row" id="FormSendContact">
					<div class="col-md-5 col-12 text-center bg-col-left d-none d-sm-block">

						<div class="pt-4">
							<img src="https://daisan.vn/site/themes/webroot/images/Img_From_Rfq.jpg">
						</div>
						<div>
							<h4>Liên hệ tới chúng tôi</h4>
							<ul class="timeline">
								<li class="text-left">
									<p>Cho chúng tôi biết những gì bạn cần bằng cách điền vào
										biểu mẫu</p>
								</li>
								<li class="text-left">
									<p>Nhận chi tiết nhà cung cấp đã được xác minh</p>
								</li>
								<li class="text-left">
									<p>So sánh Báo giá và niêm phong thỏa thuận</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-7 col-12">
						<div class="pb-4">
							<select class="custom-select mb-3 rounded-0" name="location_id" required="">
								<option value="0">Toàn Quốc</option>
								<option value="1" data-lat="21.0159339" data-lng="105.8045047">Hà Nội</option>
								<option value="50" data-lat="10.7553411" data-lng="106.415029">Hồ Chí Minh</option>
								<option value="20" data-lat="10.7553411" data-lng="106.415029">Hải Phòng</option>
								<option value="59" data-lat="10.7553411" data-lng="106.415029">Cần Thơ</option>
								<option value="32" data-lat="10.7553411" data-lng="106.415029">Đà Nẵng</option>
								<option value="57" data-lat="10.7553411" data-lng="106.415029">An Giang</option>
								<option value="49" data-lat="10.7553411" data-lng="106.415029">Bà Rịa - Vũng Tàu
								</option>
								<option value="15" data-lat="10.7553411" data-lng="106.415029">Bắc Giang</option>
								<option value="4" data-lat="10.7553411" data-lng="106.415029">Bắc Kạn</option>
								<option value="62" data-lat="10.7553411" data-lng="106.415029">Bạc Liêu</option>
								<option value="18" data-lat="10.7553411" data-lng="106.415029">Bắc Ninh</option>
								<option value="53" data-lat="10.7553411" data-lng="106.415029">Bến Tre</option>
								<option value="47" data-lat="10.7553411" data-lng="106.415029">Bình Dương</option>
								<option value="45" data-lat="10.7553411" data-lng="106.415029">Bình Phước</option>
								<option value="39" data-lat="10.7553411" data-lng="106.415029">Bình Thuận</option>
								<option value="35" data-lat="10.7553411" data-lng="106.415029">Bình Định</option>
								<option value="63" data-lat="10.7553411" data-lng="106.415029">Cà Mau</option>
								<option value="3" data-lat="10.7553411" data-lng="106.415029">Cao Bằng</option>
								<option value="41" data-lat="10.7553411" data-lng="106.415029">Gia Lai</option>
								<option value="2" data-lat="10.7553411" data-lng="106.415029">Hà Giang</option>
								<option value="23" data-lat="10.7553411" data-lng="106.415029">Hà Nam</option>
								<option value="28" data-lat="18.3543226" data-lng="105.8668107">Hà Tĩnh</option>
								<option value="19" data-lat="18.3543226" data-lng="105.8668107">Hải Dương</option>
								<option value="60" data-lat="18.3543226" data-lng="105.8668107">Hậu Giang</option>
								<option value="11" data-lat="18.3543226" data-lng="105.8668107">Hòa Bình</option>
								<option value="21" data-lat="18.3543226" data-lng="105.8668107">Hưng Yên</option>
								<option value="37" data-lat="18.3543226" data-lng="105.8668107">Khánh Hòa</option>
								<option value="58" data-lat="18.3543226" data-lng="105.8668107">Kiên Giang</option>
								<option value="40" data-lat="18.3543226" data-lng="105.8668107">Kon Tum</option>
								<option value="8" data-lat="18.3543226" data-lng="105.8668107">Lai Châu</option>
								<option value="44" data-lat="18.3543226" data-lng="105.8668107">Lâm Đồng</option>
								<option value="13" data-lat="18.3543226" data-lng="105.8668107">Lạng Sơn</option>
								<option value="6" data-lat="18.3543226" data-lng="105.8668107">Lào Cai</option>
								<option value="51" data-lat="18.3543226" data-lng="105.8668107">Long An</option>
								<option value="24" data-lat="18.3543226" data-lng="105.8668107">Nam Định</option>
								<option value="27" data-lat="18.3543226" data-lng="105.8668107">Nghệ An</option>
								<option value="25" data-lat="18.3543226" data-lng="105.8668107">Ninh Bình</option>
								<option value="38" data-lat="18.3543226" data-lng="105.8668107">Ninh Thuận</option>
								<option value="16" data-lat="18.3543226" data-lng="105.8668107">Phú Thọ</option>
								<option value="36" data-lat="18.3543226" data-lng="105.8668107">Phú Yên</option>
								<option value="29" data-lat="18.3543226" data-lng="105.8668107">Quảng Bình</option>
								<option value="33" data-lat="18.3543226" data-lng="105.8668107">Quảng Nam</option>
								<option value="34" data-lat="18.3543226" data-lng="105.8668107">Quảng Ngãi</option>
								<option value="14" data-lat="18.3543226" data-lng="105.8668107">Quảng Ninh</option>
								<option value="30" data-lat="18.3543226" data-lng="105.8668107">Quảng Trị</option>
								<option value="61" data-lat="18.3543226" data-lng="105.8668107">Sóc Trăng</option>
								<option value="9" data-lat="18.3543226" data-lng="105.8668107">Sơn La</option>
								<option value="46" data-lat="18.3543226" data-lng="105.8668107">Tây Ninh</option>
								<option value="22" data-lat="18.3543226" data-lng="105.8668107">Thái Bình</option>
								<option value="12" data-lat="18.3543226" data-lng="105.8668107">Thái Nguyên</option>
								<option value="26" data-lat="18.3543226" data-lng="105.8668107">Thanh Hóa</option>
								<option value="31" data-lat="18.3543226" data-lng="105.8668107">Thừa Thiên Huế</option>
								<option value="52" data-lat="18.3543226" data-lng="105.8668107">Tiền Giang</option>
								<option value="54" data-lat="18.3543226" data-lng="105.8668107">Trà Vinh</option>
								<option value="5" data-lat="18.3543226" data-lng="105.8668107">Tuyên Quang</option>
								<option value="55" data-lat="18.3543226" data-lng="105.8668107">Vĩnh Long</option>
								<option value="17" data-lat="18.3543226" data-lng="105.8668107">Vĩnh Phúc</option>
								<option value="10" data-lat="18.3543226" data-lng="105.8668107">Yên Bái</option>
								<option value="42" data-lat="18.3543226" data-lng="105.8668107">Đắk Lắk</option>
								<option value="43" data-lat="18.3543226" data-lng="105.8668107">Đắk Nông</option>
								<option value="7" data-lat="18.3543226" data-lng="105.8668107">Điện Biên</option>
								<option value="48" data-lat="18.3543226" data-lng="105.8668107">Đồng Nai</option>
								<option value="56" data-lat="18.3543226" data-lng="105.8668107">Đồng Tháp</option>
							</select>
							<textarea class="form-control rounded-0 mb-3" name="description"
								placeholder="Nội dung yêu cầu" required=""></textarea>
							<input type="number" class="form-control rounded-0" name="phone"
								placeholder="Nhập số điện thoại" required="">
						</div>
						<button type="button" class="btn btn-primary btn-block btn-sendcontact"
							onclick="SendPhoneContact()">Gửi thông tin yêu cầu</button>

						<div class="pt-3">
							<h4 class="d-none d-sm-block">Tổng đài hỗ trợ trực tuyến</h4>
							<ul class="timeline d-none d-sm-block">
								<li class="text-left">
									<p>
										Tư vấn mua hàng (Miễn phí): 1800 6464 98<br> <small>(Tư
											vấn, báo giá sản phẩm 8-21h kể cả T7, CN)</small>
									</p>
								</li>
								<li class="text-left">
									<p>
										Phòng IT: 0964.36.8282<br> <small>(Hỗ trợ 24/7.
											Đăng ký mở gian hàng trên hê thống)</small>
									</p>
								</li>
							</ul>
							<hr>
							<div class="row row-nm">
								<div class="col-12">
									<a class="btn btn-block btn-danger rounded-pill mb-3 btn-lg" href="tel:1800646498">
										<i class="fa fa-phone"></i> Tư vấn mua hàng: 1800 6464 98
									</a>
								</div>
								<div class="col-6">
									<a class="btn btn-block btn-outline-info rounded-pill" href="https://zalo.me/0962951212">
										<i class="fa fa-commenting-o"></i> Nhắn tin qua Zalo
									</a>
								</div>
								<div class="col-6">
									<a class="btn btn-block btn-outline-info rounded-pill" href="https://m.me/daisanvn">
										<i class="fa fa-commenting-o"></i> Nhắn tin Facebook
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="fb-customerchat" attribution=setup_tool
	page_id="444802002267924"
	logged_in_greeting="Chào bạn! Bạn đang cần sản phẩm gì? Có thể gửi tin nhắn cho chúng tôi tại đây."
	logged_out_greeting="Chào bạn! Bạn đang cần sản phẩm gì? Có thể gửi tin nhắn cho chúng tôi tại đây.">
</div>
