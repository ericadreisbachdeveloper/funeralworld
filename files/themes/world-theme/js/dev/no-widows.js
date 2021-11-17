

jQuery(function($){

  // No widows in title
  $('.archive-h2').each(function(){

    var title = $(this).text();
    var lastword = title.split(" ").slice(-1);
    var allbutlastword = title.replace(lastword, '');

    var icon     = $(this).next('.picture-div');
    if (icon != '[object Object]') {
      var iconhtml = icon.html();
      icon.remove();
    }
    else { var iconhtml = ''; }


    $(this).html(allbutlastword);
    $(this).after('<div class="nowrap"><h2 class="archive-h2">' + lastword + '</h2>&nbsp;' + iconhtml + '</div>');

  });



  // Advanced Search form
  $('#advanced-search-trigger [href]').on('click', function(){
    var trigger = $('#advanced-search-trigger');

    if( trigger.hasClass('-show')) {
      trigger.removeClass('-show');
    }
    else {
      trigger.addClass('-show');
    }
  });


});
