var end = new Date('12/01/2019 00:00 AM');
var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;
var timer;

function cuenta_atras(){
	var now = new Date();
    var distance = end - now;
    if (distance < 0) {

        clearInterval(timer);
        document.getElementById('contadorAtras').innerHTML = 'EXPIRED!';
        return;
    }

    var days = Math.floor(distance / _day);
    var hours = Math.floor((distance % _day) / _hour);
    var minutes = Math.floor((distance % _hour) / _minute);
    var seconds = Math.floor((distance % _minute) / _second);

    document.getElementById('contadorAtras').innerHTML = days + ' Days, ';
    document.getElementById('contadorAtras').innerHTML += hours + ' Hours, ';
    document.getElementById('contadorAtras').innerHTML += minutes + ' Min, ';
    document.getElementById('contadorAtras').innerHTML += seconds + ' Sec';
}

$(function(){
	if($("#contadorAtras").length){
        timer = setInterval(cuenta_atras, 1000);    
    }
    
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });


    $("#regCorreo").change(function(){
        var correo = $(this).val();
        var datos = new FormData();
        datos.append('verCorreoRegistro', correo);
        $("#spanHelblok").html('');
        $("#controlCorreo").removeClass( "has-warning has-success has-error");
        $.ajax({
            url   : 'ajax/usuarios.ajax.php',
            method: 'post',
            data  : datos,
            cache : false,
            contentType : false,
            processData : false,
            dataType    : 'json',
            success     : function(respuesta){
                if(respuesta.code == '1'){
                    $("#regCorreo").focus();
                    $("#spanHelblok").html('Registered mail');
                    $("#controlCorreo").removeClass( "has-warning has-success" ).addClass("has-error");
                }
            }

        })
    });

    $("#txtTotalCoins").change(function(){
        //console.log("esta es ::> "+$(this).val());
        $("#amount").val($(this).val());
        //$("#taxReturnBase").val($(this).val());
        var x = $(this).val();
        $.ajax({
            url   : 'ajax/usuarios.ajax.php',
            method: 'post',
            data  : { getSignature : x, reference : $("#referenceCode").val() },
            success : function(respuesta){
               $("#signature").val(respuesta);                 
            }
        })
    });

    //action=
    $("#pagoPayu").on('ifChecked', function () { 
        $("#envioPagos").attr('action', "https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/"); 
    });

    $("#pagoPayu").on('ifUnchecked', function () { 
        $("#envioPagos").attr('action', ""); 
    });


});

