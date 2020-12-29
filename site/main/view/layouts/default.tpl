<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta http-equiv="Content-Type" content="application/xhtml+xml">
<base href="{$arg.domain}">
<title>{$metadata.title|default:'Daisan.vn'}</title>
<meta name="keywords" content="{$metadata.keyword|default:'daisan'}" />
<meta name="description" content="{$metadata.description|default:'daisan'}" />
<meta name="robots" content="INDEX,FOLLOW"/>
<meta name="revisit-after" content="1 days" />
<meta property="og:image" content="{$metadata.image|default:''}" />
<link href="{$arg.img_gen}favicon.ico" rel="shortcut icon" type="image/x-icon">

<!-- Bootstrap -->
<link href="{$arg.stylesheet}css/bootstrap.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/jquery-ui.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/font-awesome.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/pnotify.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/animate.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/jquery.scrolling-tabs.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/custom.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/style.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/mobile.css" rel="stylesheet">

<link rel="stylesheet" href="{$arg.stylesheet}css/owl.carousel.min.css">
<link rel="stylesheet" href="{$arg.stylesheet}css/owl.theme.default.min.css">

<script src="{$arg.stylesheet}js/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
<script src="{$arg.stylesheet}js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="{$arg.stylesheet}js/popper.min.js" type="text/javascript"></script>
<script src="{$arg.stylesheet}js/bootstrap.min.js" type="text/javascript"></script>
<script src="{$arg.stylesheet}js/pnotify.min.js" type="text/javascript"></script>
<script src="{$arg.stylesheet}js/owl.carousel.min.js"></script>
<script src="{$arg.stylesheet}js/jquery.lazy.min.js"></script>
<script src="{$arg.stylesheet}js/jquery.scrolling-tabs.min.js"></script>

<script src="{$arg.stylesheet}js/jquery-ui.min.js" type="text/javascript"></script>
<script src="{$arg.stylesheet}js/jquery.countdown.min.js" type="text/javascript"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>var str_arg = '{$js_arg}';</script>
<script src="{$arg.stylesheet}js/custom.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54567873-6"></script>
{literal}
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MMRDVW');</script>
<!-- End Google Tag Manager -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-54567873-6');
</script>
<script>
window.fbAsyncInit = function() {
	FB.init({
		xfbml : true,
		version : 'v9.0'
	});
};
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id))
		return;
	js = d.createElement(s);
	js.id = id;
	js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
{/literal}
<script data-ad-client="ca-pub-3409058340751596" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body style="background: #333;">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MMRDVW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="fb-root"></div>
     <div class="overlay"></div>
     <div class="background"></div>
	{include file='../includes/header.tpl'}

	<div class="mains-1">
		{include file=$content}
		<div class="clearfix"></div>
	</div>

	{include file='../includes/footer.tpl'}
	{include file='../includes/hmenu.tpl'}
	
</body>
</html>