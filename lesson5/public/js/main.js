/*
 * Работа с видимостью поля регистрации
 */
$('.js-account').click(function(){
  $('.js-aut').stop().slideToggle(400);
  $('.js-account--open').toggle();
  $('.js-account--close').toggle();
  
})
/*
 * скрытие и открытие панели
*/
$('.js-sidebar-toggle').click(function(){
  var elem = $('.js-sidebar-toggle');
  if (elem.hasClass('closed')) {
    elem.removeClass('closed');
    var position = 0;
    var margin_main = 250;
  } else {
    elem.addClass('closed');
    var position = -250;
    var margin_main = 0;
  }
  $('.sidebar').animate( {
    "left": position
  });
  $('.main').animate({"margin-left":margin_main});
});

/*
 * переключение фильтра
*/
$('.js-filter a').click(function(e){
  var elem = $(e.target);
  if (elem.hasClass('active')) {
    e.preventDefault();
  } else {
    $('.js-filter a').each(function(){
      $(this).removeClass('active');
    })
    elem.addClass('active');
  }
});

