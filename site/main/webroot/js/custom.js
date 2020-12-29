var arg = JSON.parse(str_arg);
$(function () {
	$('.lazy').lazy();
});

window.onload = function () {
	google.accounts.id.initialize({
		client_id: arg.client_id,
		callback: handle_login
	});
	if (arg.login == 0) google.accounts.id.prompt();
}

function handle_login(element) {
	var dbUser = parseJwt(element.credential);
	var datalogin = {};
	datalogin.id = dbUser.sub;
	datalogin.name = dbUser.name;
	datalogin.avatar = dbUser.picture;
	datalogin.email = dbUser.email;
	datalogin.action = 'ajax_login_google';
	$.post("./?mod=account&site=login", datalogin).done(function (e) {
		var rt = JSON.parse(e);
		if (rt.code == 0) {
			endloading();
			return false;
		} else {
			endloading();
			location.reload();
		}
	});
	return false;
}

function parseJwt(token) {
	var base64Url = token.split('.')[1];
	var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
	var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
		return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	}).join(''));
	return JSON.parse(jsonPayload);
};

$(document).ready(function () {
	var arr_keyword = [];
	$.getJSON(arg.json_keyword, function (data) {
		$.each(data, function (key, value) {
			if ($.inArray(value, arr_keyword) === -1) {
				arr_keyword.push(value)
			}
		});
	});
	var w = parseInt($('.open-cate').width())+40;
	$('#Keyword').css('padding-left',w);

	/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
	$(document).click(function (e) {
		var container = $("#search_suggest_api");
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			container.hide();
		}
	});

	$("#Keyword_api").keyup(function () {
		$("#search_suggest_api").html("");
		var a = true;
		// if (event.which == 32)
		if (event.which == 32) {
			$("#search_suggest_api").css("display", "block");
			var Keyword = $("#Keyword_api").val();
			var data = {};
			data.key = Keyword;
			$.post('?mod=product&site=suggest', data).done(function (e) {
				var data = JSON.parse(e);
				var xhtml = `<div class="wrap-suggest">
								<ul class="nav flex-column main-suggest">`;

				data.forEach((e, i) => {
					if (e.category != '') {
						xhtml += `<li class="nav-item"><a href="/product?k=` + e.category + `" class="main-suggest-text nav-link"><i class="fa fa-search fa-fw"></i>` + e.category + `<i class="fa fa-angle-right fa-fw" aria-hidden="true"></i></a>`;
						if (e.attribute_contents != null) {
							xhtml += `<span class="w-10 text-right"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
									<ul class="sub-suggest">`;
							e.attribute_contents.forEach((items) => {
								xhtml += `<li class="sub-suggest-text">
											<div class="row">
												<span class="col-md-12 mr-2 mt-2 mb-2 mt-lg-0 "><b>`+ items.name + `:</b></span>
												<div class="col-md-12">`;
								items.contents.forEach(items2 => {
									console.log(items2);
									if (items2.img_name != '') {
										xhtml += `<a href="/product?k=` + e.category + `&attribute_keyword=` + items2.name + `"
											class="form-check form-check-inline mr-2 mt-2 mb-2 mt-lg-0 ">
											<div class="card" style="min-width: 55px;">
												<img class="img-attr"
													src="/site/upload/attribute/`+ items2.img_name + `"
													title="Loại A">
												<div class="card-body p-1 text-center">
													<span>`+ items2.name + `</span>
												</div>
											</div>
										</a>`;
									} else {
										xhtml += `<a href="/product?k=` + e.category + `&attribute_keyword=` + items2.name + `"
											class="form-check form-check-inline mr-2 mt-2 mb-2 mt-lg-0 bg-white">
												<span>`+ items2.name + `</span>
										</a>`;
									}
								});
								xhtml += `</div></div></li>`;
							});
							xhtml += `</ul>`;
						}
						xhtml += `</li>`;
					}
				});

				xhtml += `</ul></div>`;

				$("#search_suggest_api").html(xhtml);
			});
		}
	});
	$(".open-cate").click(function () {
		$(this).parent().toggleClass("round");
		$('.cate-in-search').toggleClass('active')
	});
	// $("#search_suggest_api").mouseout(function (){
	// 	$("#search_suggest_api").css("display", "none");
	// });
	$("#Keyword").autocomplete({
		source: function (request, response) {
			var results = $.ui.autocomplete.filter(arr_keyword, request.term);
			response(results.slice(0, 10));
		}
	});

	$('#Keyword').keypress(function (event) {
		if (event.which == 13) search();
	});

	$('#Keyword_api').keypress(function (event) {
		if (event.which == 13) search();
	});

	$("#mKeyword").autocomplete({
		source: function (request, response) {
			var results = $.ui.autocomplete.filter(arr_keyword, request.term);
			response(results.slice(0, 10));
		}
	});

	$('#mKeyword').keypress(function (event) {
		if (event.which == 13) msearch();
	});
	$(".navbar-toggler").click(function () {
		$("#menu-mobile").show();
	});
	$(".close").click(function () {
		$("#menu-mobile").hide();
	});
	$("#totop").click(function () {
		$("html, body").animate({ scrollTop: 0 }, 500);
		return false
	});
	if ($("#horizontalmenu").length) {
		$('#horizontalmenu').ddscrollSpy({ // initialize first demo
			scrolltopoffset: 0
		});
	}
	$('.left-filters__filter-wrapper').on('hidden.bs.collapse', toggleIcon);
	$('.left-filters__filter-wrapper').on('shown.bs.collapse', toggleIcon);

	$(".all-category-menu a").bind("click", function (e) {
		e.preventDefault(); // prevent hard jump, the default behavior
		var target = $(this).attr("href"); // Set the target as variable
		$("html, body").stop().animate({
			scrollTop: $(target).offset().top - 140,
		}, 600, function () {
			// location.hash = target; //attach the hash (#jumptarget) to the pageurl
		}
		);
	});
	$(window).scroll(function () {
		var scrollDistance = $(window).scrollTop();
		$(".sub-category-menu.active").each(function (i) {
			if ($(this).position().top + 50 <= scrollDistance) {
				$(".all-category-menu li.active").removeClass("active");
				$(".all-category-menu li").eq(i).addClass("active");
			}
		});
	});

	setTimeout(function () {
		$('#product_justforyou').load('?mod=product&site=load_just_for_you');
	}, 800);

	$(".open-mega-menu").click(function () {
		$('body').addClass('no-scroll-active')
		$('.mega-menu').addClass('active');
		$('.overlay').fadeIn();
	});
	$(".close-mega").click(function () {
		$('body').removeClass('no-scroll-active')
		$('.mega-menu').removeClass('active');
		$('.overlay').fadeOut();
	});

	$('[data-countdown]').each(function () {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function (event) {
			$this.html(event.strftime('<span>%D</span>:<span>%H</span>:<span>%M</span>:<span>%S</span>'));
		});
	});
	$('#cart-number').load('?mod=product&site=cart',{'action':'get_number'});
	$('#cart-number-mb').load('?mod=product&site=cart',{'action':'get_number'});
});

$(window).scroll(function () {
	if ($(this).scrollTop() > $(window).height() - 300) $(".contact-supplier").addClass('fixed');
	else $(".contact-supplier").removeClass('fixed');
});

function URLToArray(url) {
	var request = {};
	var pairs = url.substring(url.indexOf('?') + 1).split('&');
	for (var i = 0; i < pairs.length; i++) {
		if (!pairs[i]) continue;
		var pair = pairs[i].split('=');
		request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
	}
	return request;
}

function search(kid) {
	if ($("#Keyword").length > 0) {
		var Keyword = $("#Keyword").val();
	}
	if ($("#Keyword_api").length > 0) {
		var Keyword = $("#Keyword_api").val();
	}
	var filter_cate_id = $("#filter_cate_id").val();
	var str_key = findAndReplace(Keyword," ","+");
	var Type = $("#Type").val();
	var search_router = (Type == 0) ? 'product' : (Type == 1 ? 'supplier' : 'product');
	window.location.href = arg.domain+search_router+"?k="+encodeURI(str_key)+"&t="+filter_cate_id;
	return false;
}

function msearch(kid) {
	var Keyword = $("#mKeyword").val();
	var str_key = findAndReplace(Keyword, " ", "+");
	var url;
	if (Keyword == '') {
		noticeMsg('Message', 'Vui lòng nhập từ khóa...', 'error');
		$("#mKeyword").focus();
		return false;
	} else if (Keyword != '') {
		window.location.href = arg.domain + "product?k=" + encodeURI(str_key);
	}
}

function findAndReplace(string, target, replacement) {
	var i = 0, length = string.length;
	for (i; i < length; i++) {
		string = string.replace(target, replacement);
	}
	return string;
}
function LoadKeyword(key) {
	var data = {};
	data.key = key;
	$("#search_suggest").load('?mod=home&site=load_search_suggest', data, function (e) {
		console.log(e);
		if (e != '') $("#search_suggest").show();
		else $("#search_suggest").hide();
	});
}

var item = 0;
function GetKeyword(e) {
	if (e.keyCode == '38' || e.keyCode == '40') {
		var maxitem = $("#search_suggest li").length;
		if (e.keyCode == '38') {
			if (item == 0) item = maxitem;
			else item -= 1;
		} else if (e.keyCode == '40') {
			if (item == maxitem) item = 0;
			else item += 1;
		}
		$("#search_suggest li").removeClass('active');
		$("#SugId" + item).addClass('active');
		var itemvalue = $("#SugId" + item + " a").html();
		$("#Keyword").val(itemvalue);
	}
}

function showAllCategory(parent_id) {
	if (parent_id == -1) {
		$("#m-category").hide();
		return false;
	}
	$("#m-category").load('?mod=home&site=load_category', { 'parent_id': parent_id }, function () {
		$("#m-category").show();
	});
}
function add_cart(id, order_now) {
	var number = $('#addcart_number').val();
	var url = '?mod=product&site=addcart&pid='+id+'&number='+number;
	loading();
	$.post(url, {}).done(function (e) {
		if(order_now && order_now==1){
			location.href = "./?mod=product&site=cart";
			return false;
		}else{
			$('#cart-number').load('?mod=product&site=cart',{'action':'get_number'});
			$('#cart-number-mb').load('?mod=product&site=cart',{'action':'get_number'});
			noticeMsg('Thông báo', 'Đưa sản phẩm vào giỏ hàng thành công', 'success');
			endloading();
		}
	});
}

function noticeMsg(title, text, type) {
	if (type == null) type = "info";
	var notice = new PNotify({
		title: title,
		text: text,
		type: type,
		mouse_reset: false,
		buttons: { sticker: false },
		animate: { animate: true, in_class: 'fadeInDown', out_class: 'fadeOutRight' }
	});
	notice.get().click(function () {
		notice.remove();
	});
}
function showSearch() {
	$("#main").fadeOut(100);
	$("#content-search").fadeIn(50);
	$("#mKeyword").focus();
}
function goBack() {
	$("#content-search").fadeOut(50);
	$("#main").fadeIn(100);
}
function goback() {
	$(".mega-menu-dropdown-header").removeClass("show");
}

function goBackHistory() {
	window.history.back();
}
function loading() {
	$("#loading").show();
}

function endloading() {
	$("#loading").hide();
}

function SetMoney(obj) {
	var n = 0;
	var value = $(obj).val().replace(/,/g, "");
	if (value == null || value == '') value = 0;
	var re = '\\d(?=(\\d{' + (3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
	var rt = parseFloat(value).toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	if (rt == 0) rt = '';
	$(obj).val(rt);
}
function SetLocation(value) {
	var location1 = $("#Location_" + value).val();
	// console.log(location1);
	$.post('?mod=system&site=ajax_set_location_used', { 'location1': location1 }).done(function (e) {
		var data = JSON.parse(e);
		// location.reload();
		window.location.href = data.url;
	});
}
function SetLocationMobile(id) {
	$.post('?mod=system&site=ajax_set_location_used', { 'location1': id }).done(function (e) {
		var data = JSON.parse(e);
		//location.reload();
		window.location.href = data.url;
	});
}
function GetSupplierLocation(id) {
	$.post('?mod=system&site=ajax_set_location_used', { 'location1': id }).done(function (e) {
		var data = JSON.parse(e);
		//location.reload();
		window.location.href = data.url;
	});
}
function toggleIcon(e) {
	$(e.target)
	  .prev('.panel-heading')
	  .find(".more-less")
	  .toggleClass('fa-angle-up fa-angle-down');
}

function set_search_cate(id){
	var txt = $('#search_cate_'+id).html();
	$('.open-cate').html(txt+' <i class="fa fa-caret-down"></i>');
	$('#filter_cate_id').val(id);
	$('.cate-in-search').removeClass('active');
	var w = parseInt($('.open-cate').width())+40;
	$('#Keyword').css('padding-left',w);
	$('#Keyword').focus();
}

function SetDelive(id, name){
	$.post('?mod=help&site=set_place', {'id':id, 'name':name, 'action':'set_place'}).done(function (e) {
		$('#hplace a.ship-location').html('<span class="img-location-ship"></span>Giao tới<br>'+name);
	});
}

function SendPhoneContact() {
	var data = {};
	data.name = $("#FormSendContact #ProductName").text();
	data.image = $("#FormSendContact #ShowImg").attr("src");
	data.taxonomy_id = $("#FormSendContact #TaxId").val();
	data.location_id = $("#FormSendContact select[name=location_id]").val();
	data.description = $("#FormSendContact textarea[name=description]").val();
	data.phone = $("#FormSendContact input[name=phone]").val();
	data.ajax_action = 'send_phone_contact';
	loading();
	if (data.location_id == 0) {
		noticeMsg('Message System', 'Vui lòng chọn khu vực', 'error');
		$("#FormSendContact select[name=location_id]").focus();
		endloading();
		return false;
	} else if (data.description == '') {
		noticeMsg('Message System', 'Nhập vào nội dung yêu cầu', 'error');
		$("#FormSendContact textarea[name=description]").focus();
		endloading();
		return false;
	} else if (data.phone == '') {
		noticeMsg('Message System', 'Bạn chưa nhập vào số điện thoại','error');
		$("#FormSendContact input[name=phone]").focus();
		endloading();
		return false;
	}
	$.post('?mod=home&site=index', data).done(function(e) {
		var rt = JSON.parse(e);
		noticeMsg('Message System', 'Gửi thông tin thành công.','success');
		setTimeout(function() {
			location.reload();
		}, 1000);
	});
}

function filter_helpcenter(){
	var key = $('#filter_key').val();
	location.href = arg.url_helpcenter+'search.html?key='+encodeURI(key);
}