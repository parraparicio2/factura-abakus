<?php 
 require_once('includes/header.php');
?>
<div class = "container" >
                <form  role="form"  class = "formulario" method="post" name="frmData" id="frmData" accept-charset="utf-8" style="text-align:left;" >
                    
				<div class="formsubscriber">
                                    <h2>Mantenimiento de Clientes </h2>
				</div>
                    

				<div class="formsubscriber">
                                    <div class = "labelform">Documento*</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtDocumento" id="txtDocumento" class="inputform" maxlength="11" onblur="buscarClientes()" placeholder="Ingrese el documento del cliente y presione la tecla enter">
                                            <span id = "ajaxiconbusqueda" ></span>
				         <div class = "messagesform"><span id = "spanDocumento" ></span></div>
				    </div>
				</div>
                  
				<div class="formsubscriber">
					<div class = "labelform">Nombres*</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtNombres" id="txtNombres" class="inputform" maxlength="80">
                                            <div class = "messagesform"><span id = "spanNombres" ></span></div>
					</div>
				</div>
                    
				<div class="formsubscriber">
					<div class = "labelform">Detalles</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtDetalles" id="txtDetalles" class="inputform">
                                            <div class = "messagesform"><span id = "spanDetalles" ></span></div>
					</div>
				</div>
                    
                                <div class="formsubscriber">
                                    <div id= "ajaxiconcliente" class="ajaxicon" >

                                    </div>
                                </div>
                    
			<input type = "hidden" id = "modo" name ="modo" >
                        <input type = "hidden" id = "idcliente" name ="idcliente" value ="0" >
                        
                        <div class="formsubscriber" style="text-align: center" >
			   <button type="button" id ="cmdLimpiar" class="btn btn-primary" onclick = "limpiarCliente()" >Limpiar</button>
                           <button type="button" id ="cmdEliminar" class="btn btn-primary" onclick = "eliminarCliente()" >Eliminar</button>
                           <button type="button" id ="cmdGuardar" class="btn btn-primary" onclick = "insertCliente()" >Guardar</button>
                           <button type="button" id ="cmdSalir" class="btn btn-primary" onclick = "window.location = 'index.php'" >Salir</button>
			</div>
			
		 </form>  
        
</div>    

<script>
    
$( document ).ready(function() {
    onlyNumbers('txtDocumento');
    removeErrorMessage('txtDocumento','spanDocumento');
    removeErrorMessage('txtNombres','spanNombres');
    
}); 

    $("#txtDocumento").keydown(function (event) {
        if (event.keyCode == 13) {
             $('#txtDocumento').focus();
            return true;
        }
    });


</script>
    