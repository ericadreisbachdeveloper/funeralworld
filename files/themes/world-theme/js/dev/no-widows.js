

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



  // Show Advanced Search form drawer
  $('#advanced-search-trigger [href]').on('click', function(){
    var trigger = $('#advanced-search-trigger');

    if( trigger.hasClass('-show')) {
      trigger.removeClass('-show');
    }
    else {
      trigger.addClass('-show');
    }
  });


  // Filter buttons click
  $('.filter-buttons [href]').on('click', function(){

    // get filter/input name
    var input = $(this).attr('data-input');

    // get filter/input value
    if (input == 's') {
      var value = $(this).attr('data-value');
      value = value.replace(/ /g, '+');
    }
    else {
      var value = $(this).attr('data-value');
    }


    // clear the relevant form input
    $('[name=' + input + ']').val("");

    // remove filter button
    $(this).remove();


    // get current_url
    var url = window.location.href;

    // replace url value with nothing
    var load_url = url.replace(value, '');
    console.log(load_url)


    // load url with Ajax


    // update browser history


  });

});
