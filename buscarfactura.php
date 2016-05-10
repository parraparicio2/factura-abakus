<?php 
 require_once('includes/header.php');
?>
<div class = "container" >
	<div class = "documentocliente">
	    <form  role="form"  method="post" name="frmData" id="frmData" accept-charset="utf-8" style="text-align:left;" >
                <label for="txtdocumento" >Documento:</label>
                        <input type = "text" id = "txtDocumento" name = "txtDocumento" > 
                        
                            <button type="button" id ="cmdConsultar" class="btn btn-primary" onclick = "buscarFactura()">Consultar</button> <span id = "ajaxiconfactura"> </span>
                        
		</form>
		
	</div>
	
	<div class = "cuerpofactura" id = "divcuerpofactura">
		<div class="table-responsive">
		  <table class="table" id = "tablafactura">
		     <tr>
				<th>Documento</th>
				<td>1234569</td>
				<th>Nombres</th>
				<td>1234569</td>
			 </tr>
			 
		     <tr>
				<th>Id</th>
				<th>Producto</th>
				<th>Sede</th>
				<th>Precio</th>
			 </tr>
			 
		     <tr>
				<td>######</td>
				<td>######</td>
				<td>######</td>
				<td>######</td>
			 </tr>
			 
		     <tr>
				<td>######</td>
				<td>######</td>
				<td>######</td>
				<td>######</td>
			 </tr>
			 
		     <tr>
				<td></td>
				<td></td>
				<td>Total Precio:</td>
				<td>######</td>
			 </tr>
			 
		  </table>
		</div>
	</div>
</div>	


<script>
$( document ).ready(function() {
	$("#txtDocumento").focus();
    $('#divcuerpofactura').hide();
    onlyNumbers('txtDocumento');
    
    $('#txtDocumento').on('keypress', function() {
        $('#divcuerpofactura').hide();
    });
    
});    


    $("#txtDocumento").keydown(function (event) {
        if (event.keyCode == 13) {
             $("#cmdConsultar").get(0).click();
            return true;
        }
    });

</script>
	
	

