// Load search results on Our Work
jQuery(function($){

  // I. NO WIDOWS
  $('.archive-h2').each(function(){

    var title = $(this).text();
    var lastword = title.split(" ").slice(-1);
    var allbutlastword = title.replace(lastword, '');

    var icon     = $(this).next('.picture-div');
    if (icon !== '[object Object]') {
      var iconhtml = icon.html();
      icon.remove();
    }

    $(this).html(allbutlastword);
    $(this).after('<div class="nowrap"><h2 class="archive-h2">' + lastword + '</h2>&nbsp;' + iconhtml + '</div>');

  });



  // II. AUDIENCE/TOPIC ACCORDION
  $('input[id*="-toggle"]').css('opacity', '1');
  $('label[for*="-toggle"]').css('opacity', '1');






});
