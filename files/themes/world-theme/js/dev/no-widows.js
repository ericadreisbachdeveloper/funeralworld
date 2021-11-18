

jQuery(function($){


  // Tab Accessible Accordions (Explore Resource by Topic)
  $('.sidebar-h3').keypress(function(event){

    var input = $(this).attr('for');
    var div = $(this).next('.sidebar-ul-div');

    var keycode = (event.keyCode ? event.keyCode : event.which);

    // if closed and keyboard ENTER...
    // - open
    // - make each topic link tab accessible
    if( keycode == '13' && $('#' + input).attr('aria-expanded') == 'false' ){

      $('#' + input).prop('checked', true).attr('aria-expanded', 'true');

      div.find('[href]').each(function(){
        $(this).attr('tabindex', 1);
      });
    }

    // if open and keyboard ENTER ...
    // - close
    // - make each topic link tab inaccessible
    else if( keycode == '13' && $('#' + input).attr('aria-expanded') == 'true' ){

      $('#' + input).prop('checked', false).attr('aria-expanded', 'false');

      div.find('[href]').each(function(){
        $(this).attr('tabindex', -1);
      });
    }

  }); // END Tab-Accessible Accordions



  // Mouse-Accessible Accordions
  $('.sidebar-h3').on('click', function(){

    var input = $(this).attr('for');
    var div = $(this).next('.sidebar-ul-div');

    if ( $('#' + input).attr('aria-expanded') == 'false' ){

      $('#' + input).attr('aria-expanded', 'true');

      div.find('[href]').each(function(){
        $(this).attr('tabindex', 1);
      });
    }

    else if ( $('#' + input).attr('aria-expanded') == 'true' ) {

      $('#' + input).attr('aria-expanded', 'false');

      div.find('[href]').each(function(){
        $(this).attr('tabindex', -1);
      });
    }

  });








  // No widows in titles
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



  });

});
