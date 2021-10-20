// Resource Single scripts


var permalink = window.location.href;


jQuery(document).ready(function(){

    // run copy() onclick of #copy-link
    $('.h2-share + p').append('<a id="copy-link" href="#" data-href="' + permalink + '"" class="minimal-share-button"><div class="icon"></div></a><p></p>');


    // disable default onlick of hash link
    document.querySelectorAll('[href="#"]').forEach(link => {
      link.addEventListener('click', function(e){
        e.preventDefault();
      });
    });


    // create a temporary input to store url
    var $temp = $("<input>");
    var $url  = $(location).attr('href');

    // onclick appeand input and copy stored input contents (= the url) to browser clipboard
    $('#copy-link').on('click', function() {

      $("body").append($temp);
      $temp.val($url).select();
      document.execCommand("copy");
      $temp.remove();

      // if this is a fresh click of #copy-link + p
      if ( !$('#copy-link + p').hasClass('appear') ) {
        $("#copy-link + p").text("Permalink copied to clipboard").addClass('appear');

        // remove .appear after 4.5 seconds
        setInterval(function(){
          if( $('#copy-link + p').hasClass('appear') ) {
            $('#copy-link + p').removeClass('appear');
          }
        }, 4500);
      }

      // otherwise if there's a lingering .appear on #copy-link + p
      // reset the sequence
      else {
        $("#copy-link + p").removeClass('appear').addClass('appear');
        // remove .appear after 4.5 seconds
        setInterval(function(){
          $('#copy-link + p').removeClass('appear');
        }, 4500);
      }



    });


});



//document.querySelector("#copy-link").addEventListener("click", copy);
