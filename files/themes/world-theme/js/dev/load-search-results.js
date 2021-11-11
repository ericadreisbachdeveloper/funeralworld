// Load search results on Our Work
jQuery(function($){

  var protocol = window.location.protocol;
  var host = window.location.hostname;
  if (host == 'localhost') { host = 'localhost/world'; }
  var homeurl = protocol + '//' + host + '/';

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


    // Load results in #search-results
    $('#search-results').load(searchresults_url + ' #search-results', function(){
      //console.log('loaded')

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

    });




  });

});
