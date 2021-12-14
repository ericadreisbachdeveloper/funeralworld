// Powers the accordion on About


// Find a href="#open"


const open = document.querySelectorAll("[href='#open']").forEach(trigger => {

  // Get id of parent h2
  var h2 = trigger.parentElement;
  var h2_id = h2.id;

  // Add class -hide to all elements with class = [id of parent h2]
  document.querySelectorAll("." + h2_id).forEach(section=> {
    section.classList.add("-hide");
  });


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



// On click of a href="#open"
// Remove class -hide to all elements with class = [id of parent h2]
