jQuery(document).ready(function() {
	var messageDelay = 3000;
	jQuery("#boatdealer_sendMessage").click(function(evt) {
		evt.preventDefault();
		var boatdealer_contactForm = jQuery(this);
        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    	var uemail = jQuery('#boatdealer_senderEmail').val();
		if (!jQuery('#boatdealer_senderName').val() || !jQuery('#boatdealer_senderEmail').val() || !jQuery('#boatdealer_sendermessage').val()) {
            jQuery('#boatdealer_incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
            boatdealer_contactForm.fadeOut().delay(messageDelay).fadeIn();
			// jQuery('#boatdealer_senderName').css('border', '1px solid red');
            return false;
    	} 
        else if(!re.test(uemail))
        {
              jQuery('#boatdealer_email_error').fadeIn().delay(messageDelay).fadeOut();
              return false;
        }
  		var uname = jQuery('#boatdealer_senderName').val();
        var umessage = jQuery('#boatdealer_sendermessage').val();
        if(!onlyalpha (uname))
        {
           jQuery('#boatdealer_name_error').fadeIn().delay(messageDelay).fadeOut();
           return false;     
		}
		
		/*
        if( ! alphanumericext1(umessage) )
        {
           jQuery('#boatdealer_message_error').fadeIn().delay(messageDelay).fadeOut();
           return false; 
		}
		*/
		
		umessage = sanitarize(umessage);

        //else {
			jQuery('#boatdealer_sendingMessage').fadeIn();
			boatdealer_contactForm.fadeOut();
            var nonce = jQuery('#_wpnonce').val();
            form_content = jQuery('#boatdealer_contactForm').serialize();
              jQuery.ajax({
                type: "POST",
				url: ajax_object.ajax_url,
				data: form_content + '&action=boatdealer_process_form' + '&security=' + _wpnonce,
				    timeout: 20000,
                    error: function(jqXHR, textStatus, errorThrown) {
                      // alert('errorThrown');
                  		jQuery('#boatdealer_sendingMessage').hide();
                        boatdealer_contactForm.fadeIn();
                        alert('Fail to Connect with Data Base (9).\nPlease, try again later.');
                    }, 
                success: submitFinished
			});          
		// }
		return false;
	});
	jQuery(init_boatdealer_form);
	function init_boatdealer_form() {
		jQuery('#boatdealer_contactForm').hide(); //.submit( submitForm ).addClass( 'boatdealer_positioned' );
		jQuery('#boatdealer_sendingMessage').hide();
		jQuery('#boatdealer_successMessage').hide();
		jQuery('#boatdealer_failureMessage').hide();
		jQuery('#boatdealer_incompleteMessage').hide();
		jQuery("#boatdealer_cform").click(function() {
			jQuery('#boatdealer_cform').hide();
			jQuery('#boatdealer_contactForm').addClass('boatdealer_positioned');
			jQuery('#boatdealer_contactForm').css('opacity', '1');
			jQuery('#boatdealer_contactForm').fadeIn('slow', function() {
				jQuery('#boatdealer_senderName').focus();
			})
			return false;
		});
		// When the "Cancel" button is clicked, close the form
		jQuery('#boatdealer_cancel').click(function() {
			jQuery('#boatdealer_contactForm').fadeOut();
			jQuery('#content2').fadeTo('slow', 1);
            jQuery("#boatdealer_cform").fadeIn()
		});
		// When the "Escape" key is pressed, close the form
		jQuery('#boatdealer_contactForm').keydown(function(event) {
			if (event.which == 27) {
				jQuery('#boatdealer_contactForm').fadeOut();
				jQuery('#content2').fadeTo('slow', 1);
                jQuery("#boatdealer_cform").fadeIn()
			}
		});
	}
	function submitFinished(response) {
		response = jQuery.trim(response);
		jQuery('#boatdealer_sendingMessage').fadeOut();
		if (response == "success") {
			jQuery('#boatdealer_successMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#boatdealer_senderName').val("");
			jQuery('#boatdealer_senderEmail').val("");
			jQuery('#boatdealer_sendermessage').val("");
			jQuery('#content2').delay(messageDelay + 1000).fadeTo('slow', 1);
			jQuery('#boatdealer_contactForm').fadeOut();
            jQuery("#boatdealer_cform").fadeIn()
		} else {
			jQuery('#boatdealer_failureMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#boatdealer_contactForm').delay(messageDelay + 1000).fadeIn();
		}
	}
    function alphanumeric(inputtext)
    {
         if( /[^a-zA-Z0-9]/.test( inputtext ) ) {
           return false;
         }
        return true;
    }
    function alphanumericext1(inputtxt)
	{
		var iChars = "&()[]/{}|<>";
		for (var i = 0; i < inputtxt.length; i++) {
			if (iChars.indexOf(inputtxt.charAt(i)) != -1) {
			  return false;
			}
		}
		if (inputtxt.match(/script/gi))
		{
			return false;
		}
		  return true;
	} 
    function onlyalpha(inputtext)
    {
     if( /[^a-zA-Z ]/.test( inputtext ) ) {
       return false;
     }
      return true;
	}
	
	function sanitarize(str) {
		var map = {
			"&": "&amp;",
			"<": "&lt;",
			">": "&gt;",
			"\"": "&quot;",
			"\[": "&#91;",
			"\]": "&#93;",
			"\{": "&#123;",
			"\}": "&#125;",
			"'": "&#39;"}; // ' -> &apos; for XML only
			 return str.replace(/[&<>"\[\]\{\}']/g, function(m) { return map[m]; });
	}


}); // end jQuery ready
