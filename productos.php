<?php 
 require_once('includes/header.php');
?>
<div class = "container" >
                <form  role="form"  class = "formulario" method="post" name="frmData" id="frmData" accept-charset="utf-8" style="text-align:left;" >
                    
				<div class="formsubscriber">
                                    <h2>Mantenimiento de Productos</h2>
				</div>
                    

				<div class="formsubscriber">
                                    <div class = "labelform">Producto*</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtProducto" id="txtProducto" class="inputform" maxlength="11" onblur="buscarProductos()" placeholder="Ingrese el producto y presione la tecla enter">
                                            <span id = "ajaxiconbusqueda" ></span>
				         <div class = "messagesform"><span id = "spanProducto" ></span></div>
				    </div>
				</div>
                  
				<div class="formsubscriber">
					<div class = "labelform">Descripcion*</div>
					<div class = "controlform" >
                                            <input type = "text" name="txtDescripcion" id="txtDescripcion" class="inputform" maxlength="80">
                                            <div class = "messagesform"><span id = "spanDescripcion" ></span></div>
					</div>
				</div>
                    
				<div class="formsubscriber">
					<div class = "labelform">Precio* </div>
					<div class = "controlform" >
                                            <input type = "text" name="txtPrecio" id="txtPrecio" class="inputform">
                                            <div class = "messagesform"><span id = "spanPrecio" ></span></div>
					</div>
				</div>
                    
                                <div class="formsubscriber">
                                    <div id= "ajaxiconproducto" class="ajaxicon" >

                                    </div>
                                </div>
                    
			<input type = "hidden" id = "modo" name ="modo" >
                        <input type = "hidden" id = "idproducto" name ="idproducto" value ="0" >
                        
                        <div class="formsubscriber" style="text-align: center" >
			   <button type="button" id ="cmdLimpiar" class="btn btn-primary" onclick = "limpiarProducto()" >Limpiar</button>
                           <button type="button" id ="cmdEliminar" class="btn btn-primary" onclick = "eliminarProducto()" >Eliminar</button>
                           <button type="button" id ="cmdGuardar" class="btn btn-primary" onclick = "insertProducto()" >Guardar</button>
                           <button type="button" id ="cmdSalir" class="btn btn-primary" onclick = "window.location = 'index.php'" >Salir</button>
			</div>
			
		 </form>  
        
</div>    

<script>
    
$( document ).ready(function() {
    onlyNumbers('txtPrecio');
    removeErrorMessage('txtProducto','spanProducto');
    removeErrorMessage('txtDescripcion','spanDescripcion');
    removeErrorMessage('txtPrecio','spanPrecio');
    
}); 
    $("#txtProducto").keydown(function (event) {
        if (event.keyCode == 13) {
             $('#txtDescripcion').focus();
            return true;
        }
    });



</script>
    