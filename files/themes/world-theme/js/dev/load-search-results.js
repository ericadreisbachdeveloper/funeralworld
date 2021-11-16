// Load search results on Our Work
jQuery(function($){


  // DEFAULT PAGINATION LOADS SEARCH URL
  $('.page-numbers[href]').each(function(){

    // http://localhost/world/page/2/?s&post_type=post
    var href = $(this).attr('href');
    href = href.replace('our-work/', '');
    href = href.concat('?s&post_type=post');
    $(this).attr('href', href);


  });

});
