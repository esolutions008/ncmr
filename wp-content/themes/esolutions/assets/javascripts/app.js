$(document).ready(function(){
  $('#right-menu').sidr({
    name: 'sidr-right',
    side: 'right'
  });
  $(".owl-carousel-mv-index").owlCarousel({
    center:true,
    loop:true,
    items: 1,
    autoplay: true,
    dots: false
  });
  $(".card-news dt").on("click", function() {
    $(this).next().slideToggle('fast');
  });
});

