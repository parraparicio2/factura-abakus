<?php 
 require_once('includes/header.php');
?>
<div class = "container" >
                <form  role="form"  class = "formulario" method="post" name="frmData" id="frmData" accept-charset="utf-8" style="text-align:left;" >
                    
				<div class="formsubscriber">
                                    <h2>Mantenimiento de Sedes</h2>
				</div>
                    

				<div class="formsubscriber">
                                    <div class = "labelform">Sede*</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtSede" id="txtSede" class="inputform" maxlength="11" onblur="buscarSedes()" placeholder="Ingrese la sede y presione la tecla enter">
                                            <span id = "ajaxiconbusqueda" ></span>
				         <div class = "messagesform"><span id = "spanSede" ></span></div>
				    </div>
				</div>
                  
				<div class="formsubscriber">
					<div class = "labelform">Direccion*</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtDireccion" id="txtDireccion" class="inputform" maxlength="80">
                                            <div class = "messagesform"><span id = "spanDireccion" ></span></div>
					</div>
				</div>
                    
                                <div class="formsubscriber">
                                    <div id= "ajaxiconsede" class="ajaxicon" >

                                    </div>
                                </div>
                    
			<input type = "hidden" id = "modo" name ="modo" >
                        <input type = "hidden" id = "idsede" name ="idsede" value ="0" >
                        
                        <div class="formsubscriber" style="text-align: center" >
			   <button type="button" id ="cmdLimpiar" class="btn btn-primary" onclick = "limpiarSede()" >Limpiar</button>
                           <button type="button" id ="cmdEliminar" class="btn btn-primary" onclick = "eliminarSede()" >Eliminar</button>
                           <button type="button" id ="cmdGuardar" class="btn btn-primary" onclick = "insertSede()" >Guardar</button>
                           <button type="button" id ="cmdSalir" class="btn btn-primary" onclick = "window.location = 'index.php'" >Salir</button>
			</div>
			
		 </form>  
        
</div>    

<script>
    
$( document ).ready(function() {
    removeErrorMessage('txtSede','spanSede');
    removeErrorMessage('txtDireccion','spanDireccion');
    
}); 

    $("#txtSede").keydown(function (event) {
        if (event.keyCode == 13) {
             $('#txtDireccion').focus();
            return true;
        }
    });

</script>
    