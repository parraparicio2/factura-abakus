<?php 
 require_once('includes/header.php');
?>
<div class = "container" >
<form  role="form"  method="post" name="frmData" id="frmData" accept-charset="utf-8" style="text-align:left;" >    
	<div class = "renglon">
	
	    
			<div class = "etiquetas">
                        <label for="txtdocumento" >Documento:</label>
			</div>	
			<div class = "campos">
				<input type = "text" id = "txtDocumento" name = "txtDocumento" > 
                <button type="button" id ="cmdConsultar" class="btn btn-primary" onclick = "clienteFactura()">Consultar</button> <span id = "ajaxiconfactura"> </span>
            </div>				
	</div>
	
	<div class = "renglon">
	    
            <div class = "etiquetas">
                <label for="txtProducto" >Producto:</label>
            </div>			
			
	    <div class = "campos">
                <input type = "text" id = "txtProducto" name = "txtProducto" onkeypress = "listarProductos()" style = "width: 70%" placeholder = "Ingrese el código del producto o la descripción y seleccione un item de la lista" > 
	    </div>			
	    
	</div>
    
	<div id ="divitem"  class = "renglon" style = "margin-top: 2%;">
	    
            <div class = "itemfactura">
                <label style ="float:left ">item:</label>
                <span id = "spanDescripcion" class = "spanitem"></span>
            </div>			
            <div class = "itemfactura">
                <label for = "cboSede" >Sede:</label>
                <select name="cboSede" id="cboSede" >
                </select>
            </div>
            
            <div class = "itemfactura">
                <label for = "txtPrecio" >Precio:</label>
                <input type ="text"  id = "txtPrecio" name ="txtPrecio" value ="0" >
                <button type="button" id ="cmdAgregar" class="btn btn-primary" onclick = "agregarProducto()">Agregar</button>
                
            </div>            
            
	    
	</div>
    
    
    	<div class = "cuerpofactura" id = "divcuerpofactura">
			<div class="table-responsive">
			  <table class="table" id = "tablafactura">
				 <tr id = "cabecerafactura">
					<th>Documento</th>
					<td><span id = "spanDocumento"></span></td>
					<th>Nombres</th>
					<td><span id = "spanNombres"></span></td>
					<td></td>
				 </tr>
				 
				 <tr>
					<th>Id</th>
					<th>Producto</th>
					<th>Sede</th>
					<th>Precio</th>
					<th></th>
				 </tr>
				</table>	
                <div class = "piefactura">Total: <span id= "spanTotal">0</span></div>  
				<div class = "piefactura">
					<button type="button" id ="cmdComprar" class="btn btn-primary" onclick = "insertFactura()">Comprar</button> <span id = "ajaxiconcompra"> </span>
				</div>  
                                <div class="formsubscriber">
                                    <div id= "ajaxiconfacturacion" class="ajaxicon" >

                                    </div>
                                </div>				
				
				
			</div>
	</div>
<input type = "hidden" id = "idproducto" >
<input type = "hidden" id = "idsede">
<input type = "hidden" id = "idcliente" name = "idcliente" >
<input type = "hidden" id = "numero" name = "numero" value = "0">
<input type = "hidden" id = "txtTotal" value = "0">
    
	 <div id = "divdetalle">
	 </div>
    
    </form>    
</div>	



<script>
$( document ).ready(function() {
    llenarComboSedes();
    cabeceraFactura = $("#tablafactura").html();
	$("#txtDocumento").focus();
	
	
    onlyNumbers('txtDocumento');
	onlyNumbers('txtPrecio');
    $('#divitem').hide();
});    

    $("#txtDocumento").keydown(function (event) {
        if (event.keyCode == 13) {
             $("#cmdConsultar").get(0).click();
            return true;
        }
    });
	
function listarProductos(){     
    var producto = $("#txtProducto").val();
    $('#divitem').hide();
    $('#spanDescripcion').html('');
    $('#txtPrecio').val(0);
    $('#cboSede').val(0);
    
    $("#txtProducto").autocomplete({
      source: "ajaxcall.php?action=listarproductos",
      minLength: 1,
      select: function( event, ui ) {
            event.preventDefault();
            
            var id = ui.item.Label;
            var precio = ui.item.precio;
            var descripcion = ui.item.descripcion;
			$('#txtProducto').val('');
            $('#spanDescripcion').html(descripcion);
            $('#txtPrecio').val(precio);
            $('#cboSede').val(0);
			$('#idproducto').val(id);
			$('#cmdAgregar').focus();
			
            $('#divitem').show();
            
        }//end onSelect
    }); //end function autocomplete
 
}	


function llenarComboSedes(){
            $.ajax({
                url: "ajaxcall.php?action=listarsedes",
                type: 'POST',
                global: false,
                data: {action: 'sedes'},
                dataType: 'json',
                error: function (data) {
                    alert('Error en las sedes');
                },
                success: function (data) {
                     option = "<option value='0'>Sin Sede</option>";
                    for (var i in data) {
                        id = data[i].id;
                        sede = data[i].sede + ' - ' + data[i].direccion;
                        option = option + "<option value='" + id + "'>" + sede + "</option>";
                    }
                    $("#cboSede").html(option);
                }
            });
    }            
    
function agregarProducto(){
	if ($('#idcliente').val() == 0 ){
		showPopupMessage('Debe ingresar el documento del cliente')
		return false;
		
	}
    var numero = parseInt($('#numero').val()) + 1;
    $('#numero').val(numero);
    
    var descripcion = $('#spanDescripcion').html();
    var sede = $("#cboSede option:selected").html();
	var precio = parseFloat($("#txtPrecio").val());
	
    var fila = '<tr id="fila'+numero+'"><td>'+numero+'</td><td>'+descripcion+'</td><td>'+sede+'</td><td>'+precio+'</td><td><a href="#" onclick= "eliminarItem('+numero+')" >Eliminar</a></td></tr>';
	
    $('#tablafactura').append(fila);
	var total = parseFloat($("#txtTotal").val()) + precio;  
	$("#txtTotal").val(total);
	$("#spanTotal").html(total);
	
	var input_productos = '<input type = "hidden" name = "producto'+numero+'" value = "'+ $("#idproducto").val() + '" id = "idproducto'+numero+'" >';
	var input_precio = '<input type = "hidden" name = "precio'+numero+'" value = "'+ precio + '" id = "precio'+numero+'" >';
	var input_sede = '<input type = "hidden" name = "sede'+numero+'" value = "'+ $("#cboSede").val() + '" id = "sede'+numero+'" >';
	
	$("#divdetalle").append(input_productos);
	$("#divdetalle").append(input_precio);
	$("#divdetalle").append(input_sede);
	$('#divitem').hide();
	
}    

$( document ).ready(function() {
    $('#divcuerpofactura').hide();
    
    $('#txtDocumento').on('keypress', function() {
        $('#divcuerpofactura').hide();
		$('#tablafactura').html(cabeceraFactura);
		$('#idproducto').val('');
		$('#idsede').val(0);
		$('#idcliente').val(0);
		$('#txtTotal').val(0);
                $('#numero').val(0);
		$('#spanTotal').html('0');
		
    });
    
});  

</script>
	
	

