// Powers the accordion on About


// Find each: a[href="#open"]
var triggers = document.querySelectorAll("[href='#open']");


// for each ...
triggers.forEach(function(trigger, i) {

  // ... get id of parent h2
  var h2 = trigger.parentElement;
  var h2_id = h2.id;


  // ... add class -hide to all elements with class = [id of parent h2]
  var section = document.querySelectorAll("." + h2_id);
  section.forEach(function(s, i) {
    s.classList.add("-hide");
  });


  trigger.addEventListener("click", event=> {

    if(trigger.classList.contains("-showing")) {
      section.forEach(function(s, i){
        s.classList.add("-hide");
        trigger.classList.remove("-showing");
      });
    }

    else {
      section.forEach(function(s, i){
        s.classList.remove("-hide");
        trigger.classList.add("-showing");
      });
    }

  });



  /*
  trigger.addEventListener("click", event => {

    if(trigger.classList.contains("-showing")) {
      document.querySelectorAll("." + h2_id).forEach(section=> {
        section.classList.add("-hide");
        trigger.classList.remove("-showing");
      });
    }

    else {
      document.querySelectorAll("." + h2_id).forEach(section=> {
        section.classList.remove("-hide");
        trigger.classList.add("-showing");
      });
    }

  });
  */


});
