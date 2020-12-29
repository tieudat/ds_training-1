$(document).ready(function () {
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
$('.owl-category').owlCarousel({
  loop: true,
  thumbs: true,
  thumbsPrerendered: true,
  items: 1,
  nav: true,
  responsiveClass: true,
  autoplay:true,
  autoplayTimeout:5000,
  navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]
});
});
