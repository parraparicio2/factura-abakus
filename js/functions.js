var cabeceraFactura; 
/** 
 * Trim a text
 * @param string text to trim
 * @return string
 */
function trim(s){
    var l=0; var r=s.length -1;
    while(l < s.length && s[l] == ' ')
    {   l++; }
    while(r > l && s[r] == ' ')
    {   r-=1;   }
    return s.substring(l, r+1);
}
/** 
 * Trim the left side of text
 * @param string text to trim
 * @return string */
function ltrim(s){
    var l=0;
    while(l < s.length && s[l] == ' ')
    {   l++; }
    return s.substring(l, s.length);
}

/** 
 * Trim the right side of text
 * @param string text to trim
 * @return string
 */
function rtrim(s){
    var r=s.length -1;
    while(r > 0 && s[r] == ' ')
    {   r-=1;   }
    return s.substring(0, r+1);
}     

/** 
 * get the value of a parameter from url
 * @param string name of the parameter
 * @param string url
 * @return string
 */
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

/** 
 * allows only number in a input 
 * @param string id of input
 */
function onlyNumbers(selector) {
    $('#'+selector).bind('keypress', function(e) {
    return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
    })
}
/** 
 * blocks key input
 * @param string id of input
 */
function disableKeys(selector) {
    $('#'+selector).bind('keypress', function(e) {
    return false ;
    })
}

/** 
 * Count the characters that remains when a user type in a input
 * @param string id of input
 * @return integer
 */
 function countChar(val, car, element, info) {
    var len =  val.value.length;
    
    if (len > car) {
        val.value = val.value.substring(0, car);
        val.append(info);
    } else {
        $(element).text(car - len);
        $(element).append(info);
                
    }
}
/** 
 * get base url
 * @return string
 */  
function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href);
}

/**
 * check if a date is valid in mm/dd/yyyy format.
 * @param string txtDate in mm/dd/yyyy format.'
 * @return boolean 
 */
function isDate(txtDate){
  var currVal = txtDate;
  if(currVal == '')
    return false;
   
  //Declare Regex 
  var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
  var dtArray = currVal.match(rxDatePattern);

  if (dtArray == null)
     return false;
  //Checks for mm/dd/yyyy format.
  
  dtDay= dtArray[3];
  dtMonth = dtArray[1];
  dtYear = dtArray[5];
  if (dtMonth < 1 || dtMonth > 12)
      return false;
  else if (dtDay < 1 || dtDay> 31)
      return false;
  else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
      return false;
  else if (dtMonth == 2)
  {
     var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
     if (dtDay> 29 || (dtDay ==29 && !isleap))
          return false;
  }
  return true;
}




/**
 * check if emai hava a valid format
 * @param string email
 * @return boolean
 */
function validEmail(email) {
    var pattern=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    if(email.search(pattern)==0)
        return true;
    else
        return false;
}

/**
 * check is url website is valid
 * @param string url
 * @return boolean
 */
function validUrl(url){
    var pattern = /^[a-z0-9\.-]+\.[a-z]{2,4}/gi;

    
    if(url.match(pattern))
        valid =  true;
    else
        valid = false;
    
    return valid;
}
/**
 * remove error messages when users click on input or select 
 * @param string id of span to remove error
 * @return boolean
 */

function removeErrorMessageOnClick(selectorSpan){
    selectorSpan = '#'+selectorSpan;
    $(selectorSpan).attr("class", "");
    $(selectorSpan).html('');
}


/**
 * Function validate phone number
 * @param string  
 * return boolean    
 */

function validatephone(number){
  /*Validate Phone Number*/
  var patron = ' ';
  number = number.replace(patron, '');
  var phone =/(^([0-9]{10,12})|^)$/;
    return phone.test(number);
}

/**
 * Function validate field check if a field is blank
 * @param selector id
 * return boolean    
 */

function checkIfBlank(selector){
    var blank = false;
    selector = selector.replace('#', ''); 
    selector = '#'+selector;
    value = $(selector).val().trim();
    if (value === '' )
        blank = true;
    
    return blank;
    
}
/** 
 * check if browser is internet explorer version 6,7,8
 * @return boolean
 */
function CheckInternetExplorer(){
    var rv = -1;  //to prevent fails the pointer should be null
      if (navigator.appName == 'Microsoft Internet Explorer'){
         var ua = navigator.userAgent;
         var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
         if (re.exec(ua) != null)
                  rv = parseFloat( RegExp.$1 );
         if(rv > -1){
             switch(rv){
                 case 8.0:
                   return true
                    break;
                 case 7.0: 
                    return true;
                     break;
                 case 6.0: 
                    return true;
                     break;
                 default:
                     return false
                     //"Default";
                      break;                  
             }
         }
    }
    
}


/**
* remove error message of a span when input activate keypress event
* @param strind id of input selector
* @param strind id of span selector to remove message
*/    
function removeErrorMessage(selector, spanSelector){
    selector = selector.replace('#', ''); 
    spanSelector = spanSelector.replace('#', ''); 
    selector = '#'+selector;
    spanSelector = '#'+spanSelector;
    $(selector).on('keypress', function() {
       if ($(selector).val().length >= 0 ){
               $(spanSelector).attr("class", "");
               $(spanSelector).html('');
       }
    });
}


/**
 * Show messages of error o delete message of error
 * @param string id of span that show message
 * @param string message to show
 * @boolean identifies if messages if show or delete
 */
function errorMessage(idSpan, message, show){
    idSpan = idSpan.replace('#', '');
    idSpan = '#'+idSpan;
    if (show){
        $(idSpan).show();
        $(idSpan).html(message);
        $(idSpan).addClass('error-messages ng-active');
    }else {
        $(idSpan).html('');
        $(idSpan).removeClass();
        $(idSpan).attr("class", "");
        $(idSpan).hide();
    }
}

 function showPopupMessage(msg){
    $("#pmessages").html(msg);
    $('#mgInformacion').modal('show');
 }
 
 
 function limpiarCliente(){
    $('#frmData').trigger('reset');
    $('#idcliente').val (0);
}

function limpiarProducto(){
    $('#frmData').trigger('reset');
    $('#idproducto').val (0);
}
 function limpiarSede(){
    $('#frmData').trigger('reset');
    $('#idsede').val (0);
}

 
 
 function buscarFactura(){
    $('#divcuerpofactura').hide();
   if (checkIfBlank('txtDocumento'))      
       return false;
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconfactura").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=buscarfactura',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
		     console.log(data.factura)
                    $("#ajaxiconfactura").html('');
                    if (data.success){
                        $('#divcuerpofactura').show();
                        $("#tablafactura").html(data.factura);
                        $("#txtDocumento").val('');
                        
                    } 
                    else{
                        
                        //errorMessage
                    }
                },
                    error: function(data) {
                       $('#divcuerpofactura').show();
                       $("#divcuerpofactura").html('<div class = "noresult">No se encontraron registros</div>');
                       $("#ajaxiconfactura").html('');
                        console.log(data)
                }                
            });
}


 function insertCliente(){
   errorMessage('spanDocumento', '', false);
   errorMessage('spanNombres', '', false);
   
   if (checkIfBlank('txtDocumento')){
        errorMessage('spanDocumento', 'Debe Ingresar el documento', true);
        return false;
   }    
   
   if (checkIfBlank('txtNombres')){
        errorMessage('spanNombres', 'Debe Ingresar el nombre', true);
        return false;
   }       
       
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconcliente").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=insertcliente',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconcliente").html('');
                    if (data.success){
                        limpiarCliente();
                        showPopupMessage('Registro guardado satisfactoriamente');
                    } 
                },
                    error: function(data) {
                       alert('ha ocurrido un error al insertar al cliente') 
                       $("#ajaxiconcliente").html('');
                        console.log(data)
                }                
            });
}


function eliminarCliente(){
   
   if ($('#idcliente').val() == 0){
        showPopupMessage('Cliente Invalido!')
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconfactura").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=deletecliente',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconfactura").html('');
                    if (data.success){
                        limpiarCliente();
                        showPopupMessage('Registro Eliminado');
                        
                    } 
                },
                    error: function(data) {
                        alert('Ocurrio un error');
                        
                }                
            });
}


function buscarClientes(){
   var idcliente = $('#txtDocumento').val().trim();
   if (idcliente.length == 0){
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconfactura").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=buscarcliente',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconfactura").html('');
                    if (data.success){
                        $('#txtDocumento').val(data.documento);
                        $('#txtNombres').val(data.nombres);
                        $('#txtDetalles').val(data.detalles);
                        $('#idcliente').val(data.id);
                    } 
                    else{
                        $('#txtDocumento').val('');
                        $('#txtNombres').val();
                        $('#txtDetalles').val();
                        $('#idcliente').val(0);

                    }
                    
                },
                    error: function(data) {
                        $("#ajaxiconfactura").html('');
                        alert('Ocurrio un error');
                        
                }                
            });
}



function insertProducto(){
   errorMessage('spanProducto', '', false);
   errorMessage('spanDescripcion', '', false);
   errorMessage('spanPrecio', '', false);
   
   if (checkIfBlank('txtProducto')){
        errorMessage('spanProducto', 'Debe Ingresar el producto', true);
        return false;
   }    
   
   if (checkIfBlank('txtDescripcion')){
        errorMessage('spanDescripcion', 'Debe Ingresar la descripcion', true);
        return false;
   }       
       
   if (checkIfBlank('txtPrecio')){
        errorMessage('spanPrecio', 'Debe Ingresar el precio', true);
        return false;
   }       
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconproducto").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=insertproducto',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconproducto").html('');
                    if (data.success){
                        showPopupMessage('Registro guardado satisfactoriamente');
                        limpiarProducto();
                    } 
                },
                    error: function(data) {
                       alert('ha ocurrido un error al insertar al cliente') 
                       $("#ajaxiconproducto").html('');
                        console.log(data)
                }                
            });
}


function eliminarProducto(){
   
   if ($('#idproducto').val() == 0){
        showPopupMessage('Producto Invalido!')
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconproducto").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=deleteproducto',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconproducto").html('');
                    if (data.success){
                        limpiarProducto();
                        showPopupMessage('Registro Eliminado');
                        
                    } 
                },
                    error: function(data) {
                        $("#ajaxiconproducto").html('');
                        alert('Ocurrio un error');
                        
                }                
            });
}


function buscarProductos(){
   var id = $('#txtProducto').val().trim();
   if (id.length == 0){
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconproducto").html('<img src="'+path +'"/>');
             $.ajax({
                url: 'ajaxcall.php?action=buscarproducto',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconproducto").html('');
                    if (data.success){
                        $('#txtProducto').val(data.producto);
                        $('#txtDescripcion').val(data.descripcion);
                        $('#txtPrecio').val(data.precio);
                        $('#idproducto').val(data.id);
                    }else{
                        $('#txtDescripcion').val('');
                        $('#txtPrecio').val('');
                        $('#idproducto').val(0);

                    }
                },
                    error: function(data) {
                        $("#ajaxiconproducto").html('');
                        alert('Ocurrio un error');
                        
                }                
            });
}


function insertSede(){
   errorMessage('spanSede', '', false);
   errorMessage('spanDireccion', '', false);
   
   
   if (checkIfBlank('txtSede')){
        errorMessage('spanSede', 'Debe Ingresar la sede', true);
        return false;
   }    
   
   if (checkIfBlank('txtDireccion')){
        errorMessage('spanDireccion', 'Debe Ingresar la direccion', true);
        return false;
   }       
       
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconsede").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=insertsede',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconsede").html('');
                    if (data.success){
                        showPopupMessage('Registro guardado satisfactoriamente');
                        limpiarProducto();
                    } 
                },
                    error: function(data) {
                       alert('ha ocurrido un error al insertar la sede') 
                       $("#ajaxiconsede").html('');
                        console.log(data)
                }                
            });
}

function eliminarSede(){
   
   if ($('#idsede').val() == 0){
        showPopupMessage('Sede Invalida!')
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconsede").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=deletesede',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconsede").html('');
                    if (data.success){
                        showPopupMessage('Registro Eliminado');
                        limpiarSede();
                    } 
                },
                    error: function(data) {
                        $("#ajaxiconsede").html('');
                        alert('Ocurrio un error');
                        
                }                
            });
}

function buscarSedes(){
   var id = $('#txtSede').val().trim();
   if (id.length == 0){
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconsede").html('<img src="'+path +'"/>');
             $.ajax({
                url: 'ajaxcall.php?action=buscarsede',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconsede").html('');
                    if (data.success){
                        $('#txtSede').val(data.sede);
                        $('#txtDireccion').val(data.direccion);
                        $('#idsede').val(data.id);
                    }
                    else{
                        $('#txtSede').val('');
                        $('#txtDireccion').val();
                        $('#idsede').val(0);

                    }

                },
                    error: function(data) {
                        $("#ajaxiconsede").html('');
                        
                }                
            });
}

function clienteFactura(){
   var idcliente = $('#txtDocumento').val().trim();
   if (idcliente.length == 0){
       return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconfactura").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=buscarcliente',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconfactura").html('');
                    if (data.success){
			$('#txtDocumento').val('');
                        $('#spanDocumento').html(data.documento);
                        $('#spanNombres').html(data.nombres);
			$('#idcliente').val(data.id);
			$('#divcuerpofactura').show();
			$('#txtProducto').focus();
                        $('#numero').val(0);
                        
                    } 
                    else{
                        showPopupMessage('Cliente no encontrado');
                    }
                    
                },
                    error: function(data) {
                        $("#ajaxiconfactura").html('');
                        alert('Ocurrio un error');
                        
                }                
            });
}


function eliminarItem(id){

   precio = parseFloat($("#precio"+id).val());

   total = parseFloat($("#txtTotal").val());
   $("#txtTotal").val(total - precio);
   $("#spanTotal").html($("#txtTotal").val());
   
   $("#fila"+id).remove();
     
}

function insertFactura(){

   if ( $('#txtTotal').val() == 0){
	   showPopupMessage('Debe Ingresar por lo menos un producto');
	   return false;
   }
   
     var path = getBaseUrl()+'img/ajax-loader.gif';
     $("#ajaxiconfacturacion").html('<img src="'+path +'"/>');
    
             $.ajax({
                url: 'ajaxcall.php?action=insertfactura',
                type: "POST",
                data:$('#frmData').serialize(),
                dataType: 'json',
                success:function(data){
                    $("#ajaxiconfacturacion").html('');
                    if (data.success){
                        limpiarFactura();
                        showPopupMessage('Registro guardado satisfactoriamente');
                    } 
                },
                    error: function(data) {
                       alert('ha ocurrido un error al insertar la factura') 
                       $("#ajaxiconfacturacion").html('');
                        console.log(data)
                }                
            });
}


function limpiarFactura(){
     $('#divcuerpofactura').hide();
     $('#tablafactura').html(cabeceraFactura);
     $('#idproducto').val('');
     $('#idsede').val(0);
     $('#idcliente').val(0);
     $('#txtTotal').val(0);
     $('#spanTotal').html('0');
     $('#numero').val(0);
}