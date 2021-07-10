$(document).ready(function() {

  $('.checking_email2').keyup(function(e){

//alert ("hello am working");
var email = $('.checking_email2').val();
   //alert (email);

   $.ajax ({
          type: "POST",
          url:  "code.php",
          data:{
               "check_submit_btn2":1,
               "email_id": email,
           },
          
          success: function (response){
         
        //alert (response);
        $('.error_email2').text(response);

          }
      });

});
});




