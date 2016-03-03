$(document).ready(function () {

  /*Navigation Menu action, if menu is not visible make it visible
  otherwise make it hidden */
  $('#menu-btn').click(function () {
    var nav = $('nav');
    if (nav.css('display') === 'block') {
      nav.slideUp(1000);
      nav.css('display', 'none');
    } else {
      nav.slideDown();
      nav.css('display', 'block');
    }
  });

  /*Make nav menu visible on expanding window */
  $(window).resize(function() {
    if($(window).width() > 460) {
      $('nav').css('display', 'block');
    } else {
      $('nav').css('display', 'none');
    }
  });
});
