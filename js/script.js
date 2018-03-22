// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top-150
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

/*----------------close after click menu mobile-----------------------------*/

$(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
        $(this).collapse('hide');
    }
});
/*-------------------animation in scroll --------------------------*/

wow = new WOW(
  {
    animateClass: 'animated',
    offset: 100
  }
);
wow.init();


/*--------------------- Scroll to Top---------------------------------*/
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});


/*----------------------------- send e-mail -----------------------------*/

$(document).ready(function() {
    
    $( "#signupForm" ).validate({
        rules: {
            'inputname': "required",
            'inputemail': "required email",
            'inputmessage': "required",
            'send': "required"
        },
        messages: {
            inputname: "Por favor, ingresá tu Nombre y Apellido",
            inputemail: "Por favor, ingresá tu E-mail",
            inputmessage: "Por favor, ingresá tu consulta"
        },

       
        submitHandler: function (form) {

            var data = {
                nombre: $("#inputname").val(),
                telefono: $("#inputphone").val(),
                email:$("#inputemail").val(),
                consulta:$("#inputmessage").val()
            };

            $.ajax({
                type: "POST",
                cache: false,
                url:"mailer/send.php",
                data: data,
                success: function(resp) {
console.log(resp);
                    resp  = $.parseJSON(resp);
console.log(resp);
                    if(resp[0]) {
                      swal("Mensaje Enviado!", "En breve, te responderemos. Gracias!", "success");
                      $('#signupForm').get(0).reset();
                          
                    } else {
                        swal({
                            title: "Mensaje no enviado",
                            text: "Ups, hubo un error al intentar enviar el mail, intentá de nuevo más tarde.",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                        });
                        

                    }

                }



            });
        }
    });
});