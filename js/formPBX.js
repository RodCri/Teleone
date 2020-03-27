(function(){
    $(".btn-cotiza").click(function() 
    {
        var nombre = $(".nombre").val();
        var  email = $(".email").val();
        var  telefono = $(".telefono").val();
        var adicionales = $(".adicionales").val();
        validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        
        if (nombre == "") {
            $(".nombre").focus();
            $('.nombre').attr('placeholder','* Campo obligatorio');
            return false;
        }else if(email == "" || !validacion_email.test(email)){
            $(".email").focus(); 
            $(".email").val('');
            $('.email').attr('placeholder','Email no valido');
            return false;
        }else if(telefono == "" || isNaN(telefono)){
            $(".telefono").focus();
            $(".telefono").val('');
            $(".telefono").attr('placeholder','* Campo obligatorio - Dato invalido');
            return false;
        }
         
            var datos = {
                'nombre': nombre , 
                'email' : email ,
                'telefono' : telefono,
                'adicionales' : adicionales,
                'response': grecaptcha.getResponse()
            }
            
            $.ajax({
                type: "POST",
                data: datos,
                url: "sendEmailPBX.php",
                beforeSend: function(){
                    $(".message").html('Procesando...');
                },
                success: function(data) {
                    console.log(data);
                  if(data==1){
                      console.log("Enviado");
                        $(".nombre").val('');
                        $(".email").val('');
                        $(".telefono").val('');
                        $(".adicionales").val('');
                        $(".message").html('Enviado...').delay(800);
                        $(".message").html('');
                        grecaptcha.reset();
                  }
                }
            });
    });
})();