/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $(document).ready(function() {
       $("#user_edit_edit").click(function () {
       var action = $("#user_edit_edit").val();
       if(action == 'Update') {
           alert("FATIH");
       }else {
           
           
       var name = $("#user_edit_name").text();
       var email = $("#user_edit_email").text();
       var password = $("#user_edit_password").text();
       var phone = $("#user_edit_phone").text();
       
       $("#user_edit_name").toggle();
       $("#user_edit_email").toggle();
       $("#user_edit_password").toggle();
       $("#user_edit_phone").toggle();

       $("#user_edit_name2").toggle();
       $("#user_edit_email2").toggle();
       $("#user_edit_password2").toggle();
       $("#user_edit_phone2").toggle();
       $("#user_edit_reset").toggle();
       
       $("#user_edit_name2").val(name);
       $("#user_edit_email2").val(email);
       $("#user_edit_password2").val(password);
       $("#user_edit_phone2").val(phone);
       $("#user_edit_edit").val("Update"); 
              }

  });
  
  $("#user_edit_reset").click(function () {
       var name = $("#user_edit_name2").val();
       var email = $("#user_edit_email2").val();
       var password = $("#user_edit_password2").val();
       var phone = $("#user_edit_phone2").val();              
      
       $("#user_edit_name2").toggle();
       $("#user_edit_email2").toggle();
       $("#user_edit_password2").toggle();
       $("#user_edit_phone2").toggle();
       $("#user_edit_reset").toggle();                
     
       $("#user_edit_name").toggle();
       $("#user_edit_email").toggle();
       $("#user_edit_password").toggle();
       $("#user_edit_phone").toggle();
       
   //    $("#user_edit_name").css('display','block');
       
       $("#user_edit_name").text(name);
       $("#user_edit_email").text(email);
       $("#user_edit_password").text(password);
       $("#user_edit_phone").text(phone);
       $("#user_edit_edit").val("Edit");
  });
});
