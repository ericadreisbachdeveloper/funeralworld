// Load search results on Our Work
jQuery(function($){


  // VARIABLES
  var protocol = window.location.protocol;
  var host = window.location.hostname;
      if (host == 'localhost') { host = 'localhost/world'; }
  var homeurl = protocol + '//' + host + '/';
  var thisurl = window.location.href;


  // I. INITIAL LOAD

  // I.1. If this url is equal to the default url
  if (thisurl !== homeurl + 'our-work/') {
    console.log(thisurl)
  }

  // I.2. Construct pagination URLs for Ajax load
  // http://localhost/world/page/3/?s&amp;post_type=post#038;post_type=post
  // turns into
  // http://localhost/world/page/3/?s&post_type=post=post_type=post
  $('.page-numbers[href]').each(function(){
    var href = '';
    //href = $(this).replace('&amp;', '&');
    //href = $(this).replace('#038;', '&');
  });




  // II. SEARCH RESULTS

  // ... on SEARCH button click ...
  var searchbtn = $('#search-submit');

  searchbtn.on('click', function(){

    // 1. Query
    var query = $('#search-input').val();
        // replace spaces with +
        query = query.replace(/\s/g, '+');
        query = encodeURIComponent(query);
        // replace encoded character %2B with +
        query = query.replace(/%2B/g, '+');
        query = '?s=' + query;

    // 2. Audience
    var audience = $('[name="audience"]').val();
    if (!audience) { audience = '&audience='; }
    else           { audience = '&audience=' + audience; }

    // 3. Author
    var author = $('[name="author"]').val();
    if (!author) { author = '&author='; }
    else         { author = '&author=' + author; }

    // 4. Topic
    var topic = $('[name="topic"]').val();
    if (!topic) { topic = '&topic='; }
    else        { topic = '&topic=' + topic; }

    var resourcetype = $('[name="type"]').val();
    if (!resourcetype) { resourcetype = '&resource-type='; }
    else               { resourcetype = '&resource-type=' + resourcetype; }

    var searchresults_url = homeurl + query + audience + author + topic + resourcetype + '&post_type=post';


    // 2. Load results in #search-results
    $('#search-results').load(searchresults_url + ' #search-results', function(){

      // Remove #-inital
      $('#-initial').remove();

      // Run "No Widows" on titles
      $('.archive-h2').each(function(){

        var title = $(this).text();
        var lastword = title.split(" ").slice(-1);
        var allbutlastword = title.replace(lastword, '');

        var icon     = $(this).next('.picture-div');
        var iconhtml = icon.html();
        icon.remove();


        $(this).html(allbutlastword);
        $(this).after('<div class="nowrap"><h2 class="archive-h2">' + lastword + '</h2>' + iconhtml + '</div>');

      });

      // Construct pagination URLs for Ajax load
      // http://localhost/world/page/3/?s&amp;post_type=post#038;post_type=post
      // turns into
      // http://localhost/world/page/3/?s&post_type=post=post_type=post

      // PROBLEM
      $('.page-numbers[href]').each(function(){
        $(this).replace('&amp;', '&');
        $(this).replace('#038;', '&');
      });

    });

  });




  // III. TITLES

  // III.1. Run "No Widows" on default Advanced Search entry titles
  $('.archive-h2').each(function(){

    var title = $(this).text();
    var lastword = title.split(" ").slice(-1);
    var allbutlastword = title.replace(lastword, '');

    var icon     = $(this).next('.picture-div');
    var iconhtml = icon.html();
    icon.remove();


    $(this).html(allbutlastword);
    $(this).after('<div class="nowrap"><h2 class="archive-h2">' + lastword + '</h2>&nbsp;' + iconhtml + '</div>');

  });


  // III.2. Store default title
  const initialh1 = $('.search-results-h1.-initial').html();
  // create a hidden field with initialh1 text
  // that will append to body and persist YES
  $('body').append('<div id="-initial" style="display: none;">' + initialh1 + '</div>');




  // IV. PAGINATION LINKS LOAD RESULTS WITH AJAX
  $(document).on('click', '.page-numbers[href]', function(){

    // 1. Get URL
    var url = $(this).attr('href');

    // 1. Default pagination click
    //    i.e. if url contains string 'our-work'
    // OR      if $('#-initial') is intact
    if (url.indexOf('our-work/') >= 0 || $('#-initial').html() != '') {
      // construct URL for Ajax load
      // http://localhost/world/our-work/page/2/
      // turns into
      // http://localhost/page/2/?s
      page_url = url.replace('our-work/', '');
      page_url = page_url.concat('?s&post_type=post');

      $('#search-results').load(page_url + ' #search-results', function(){
        var initialh1_ajax = $('#-initial').html();
        $('.search-results-h1').html(initialh1_ajax);
      });
    }

    // 2. Advanced Search results pagination click
    else {
      $('#search-results').load(page_url + ' #search-results');
    }

    return false;

  }); // END on click .page-numbers[href]



  // V. ACCORDION
  // V.1. Toggle
  $('.sidebar-h3 [href]').on('click', function(){

    var parent = $(this).parent('.sidebar-h3');

    // V.2. Set max height
    /*
    var div = parent.next('.sidebar-ul-div');
    var ul  = div.children('.sidebar-ul');
    var ulh = ul.height();
    */

    // if accordion is closed, open
    if( parent.attr('aria-expanded') == 'false' ) {
      parent.attr('aria-expanded', 'true');
      //div.css('max-height', ulh);
    }

    // if accordion is open, close
    else {
      parent.attr('aria-expanded', 'false');
      //div.css('max-height', '0');
    }




  });



});
