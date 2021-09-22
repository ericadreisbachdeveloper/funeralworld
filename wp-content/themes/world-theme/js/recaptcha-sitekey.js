// reCAPTCHA v3
// get sitekey at https://www.google.com/recaptcha/admin
// src https://developers.google.com/recaptcha/docs/v3

// with form id
function onSubmit(token) {
	document.getElementById("loginform").submit();
}

// with button id
jQuery(document).ready(function(){
	jQuery('#wp-submit').addClass('g-recaptcha').attr('data-sitekey', '6LcQuUIcAAAAABs6AgPjMQfHsIk2z-8sho7AFhno').attr('data-callback', 'onSubmit').attr('data-action', 'submit');
});
