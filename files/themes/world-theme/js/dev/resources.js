// Resource Single scripts
jQuery(function($){


  const permalink = window.location.href;


  $(document).ready(function(){

    // run copy() onclick of #copy-link
    $('.h2-share + p').append('<a id="copy-link" href="#" data-href="' + permalink + '" class="minimal-share-button"><div class="icon"></div></a><p></p>');


    // disable default onlick of hash link
    document.querySelectorAll('[href="#"]').forEach(link => {
      link.addEventListener('click', function(e){
        e.preventDefault();
      });
    });




    // get browser animation transition endname
    function getTransitionEndEventName() {

      var transitions = {
        "transition"      : "transitionend",
        "OTransition"     : "oTransitionEnd",
        "MozTransition"   : "transitionend",
        "WebkitTransition": "webkitTransitionEnd"
      }

      let bodyStyle = document.body.style;

      for(let transition in transitions) {
        if(bodyStyle[transition] != undefined) {
          return transitions[transition];
        }
        else {
          return '';
        }
      }
    }

    const transitionEndEventName = getTransitionEndEventName();


    // create a temporary input to store url
    var $temp = $("<input>");
    var $url  = permalink;




    // onclick append input and copy stored input contents (= the url) to browser clipboard
    $('#copy-link').on('click', function() {

      // I. Display message
      getTransitionEndEventName();

      $("body").append($temp);
      $temp.val($url).select();
      document.execCommand("copy");
      $temp.remove();

      var copylinkmsg = $('#copy-link + p');

      copylinkmsg.text("Permalink copied to clipboard").addClass('appear').on('animationend', function(e) {
        copylinkmsg.removeClass('appear');
      });



      // II. Copy permalink to clipboard
      //var dummy = document.createElement("textarea");
      //document.body.appendChild(dummy);
      //dummy.value = permalink;
      //console.log(dummy.value)
      //document.execCommand("copy");
      navigator.clipboard.writeText(permalink)
      //document.body.removeChild(dummy);

    });


  }); // document.ready()


});
