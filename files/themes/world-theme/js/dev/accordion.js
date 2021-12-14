// Powers the accordion on About


// Find each: a[href="#open"]
var open = document.querySelectorAll("[href='#open']");


// for each ...
open.forEach(function(trigger, i) {

  // ... get id of parent h2
  var h2 = trigger.parentElement;
  var h2_id = h2.id;

  // ... add class -hide to all elements with class = [id of parent h2]
  document.querySelectorAll("." + h2_id).forEach(section=> {
    section.classList.add("-hide");
  });




  // ... on click of a href="#open"
  //     add or remove class -hide to all elements with class = [id of parent h2]
  //     add or remove class -showing to "trigger" = a[href="#open"]
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


});
