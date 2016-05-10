<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';
 
if (isset($_GET['action'])){
		
		$action = $_GET['action'];
				
		if (!empty($_POST)){
                    $data = $_POST; 
	}
		
				
		switch ($action) {
				case 'buscarfactura':
                                        $factura = new facturacion();
				        $result = $factura->BuscarFactura($data['txtDocumento']);
					$result = json_encode($result );
			 	        break;
                                    
				case 'insertcliente':
                                        $factura = new facturacion();
				        $result = $factura->InsertCliente(
                                                                          $data['txtDocumento'],
                                                                          $data['txtNombres'],  
                                                                          $data['txtDetalles'],
                                                                          $data['idcliente']
                                                                         );   
                                        
					$result = json_encode($result );
			 	        break;
				    break;
                                
				case 'deletecliente':
                                        $factura = new facturacion();
				        $result = $factura->EliminarCliente($data['idcliente']);
					$result = json_encode($result );
			 	        break;
                                    
				case 'buscarcliente':
                                        $factura = new facturacion();
				        $result = $factura->BuscarCliente($data['txtDocumento']);
					$result = json_encode($result );
			 	        break;
                                    
				case 'buscarproducto':
                                        $factura = new facturacion();
				        $result = $factura->BuscarProductos($data['txtProducto']);
					$result = json_encode($result );
			 	        break;
                                    
				case 'insertproducto':
                                        $factura = new facturacion();
				        $result = $factura->InsertProducto(
                                                                          $data['txtProducto'],
                                                                          $data['txtDescripcion'],  
                                                                          $data['txtPrecio'],
                                                                          $data['idproducto']
                                                                         );   
                                        
					$result = json_encode($result );
			 	        break;
				    break;
                                
				case 'deleteproducto':
                                        $factura = new facturacion();
				        $result = $factura->EliminarProducto($data['idproducto']);
					$result = json_encode($result );
			 	        break;
                                    
				case 'buscarsede':
                                        $factura = new facturacion();
				        $result = $factura->BuscarSede($data['txtSede']);
					$result = json_encode($result );
			 	        break;
                                    
				case 'insertsede':
                                        $factura = new facturacion();
				        $result = $factura->InsertSede(
                                                                          $data['txtSede'],
                                                                          $data['txtDireccion'],  
                                                                          $data['idsede']
                                                                         );   
                                        
					$result = json_encode($result );
			 	        break;
				    break;
                                
				case 'deletesede':
                                         $factura = new facturacion();
				        $result = $factura->EliminarSede($data['idsede']);
						$result = json_encode($result );
			 	        break;                                    
				case 'listarproductos':
                                       $factura = new facturacion();
					$producto = $_GET['term'];
				        $result = $factura->ListarProductos($producto);
					$result = json_encode($result );
			 	        break;                                    
				case 'listarsedes':
                                       $factura = new facturacion();
				        $result = $factura->ListarSedes();
					$result = json_encode($result );
			 	        break;                                    
				case 'insertfactura':
                                       $factura = new facturacion();
				         $result = $factura->InsertFactura($data);
					$result = json_encode($result );
			 	        break;                                    
                                    
		}

echo $result;    

}

class facturacion{
 /*function InsertCliente(){
	 
 }
 
 function InsertProductos(){
	 
 }
 
 function InsertSedes(){
	 
 }*/
 
 function BuscarFactura($documento = 0){
	$success = false; 
	
	$cliente =  $this->BuscarCliente($documento);
	if ($cliente['success']){
                InsertLog('s', "Modulo: Factura - ". $cliente['documento']." - ". $cliente['nombres']);
		$idcliente = $cliente['id'];
                $documento = $cliente['documento'];
		$nombres = $cliente['nombres'];
		//$total = $this->BuscarTotal($idcliente);
                $total = 0;
		
		$cabecera = "		     
		  	 <tr style = 'height: 50px'>
				<th>Documento</th>
				<td>$documento</td>
				<th>Nombres</th>
				<td>$nombres</td>
			 </tr>
			 
			 <tr>
				<th>Id</th>
				<th>Producto</th>
				<th>Sede</th>
				<th>Precio</th>
			 </tr>			 
			 ";
                $detalle = "";			 
		$pie = "";			 
		$query  = "SELECT a.id, a.id_cliente, a.id_producto, c.descripcion, COALESCE(a.id_sede,0) as id_sede, COALESCE(b.sede,'Sin Sede') as sede,
						   COALESCE(a.precio  , (SELECT p.precio FROM productos AS p WHERE p.id = a.id_producto)) AS precio 
					FROM compras a 
					LEFT JOIN sedes AS b
					   ON a.id_sede = b.id
					 JOIN productos AS c 
					   ON c.id = a.id_producto                                              
					WHERE a.id_cliente = $idcliente AND a.id_producto IS NOT NULL";	 
					
		$result = phpmkr_query($query);
		if ($result){
			while ($row  = $result->fetch_assoc()){
				$success = true;
				$id = $row['id'];
				$descripcion = $row['descripcion'];
				$sede = $row['sede'];
                                $precio = $row['precio'];
                                $total = $total + $precio;
				$detalle .= " <tr>
                                                <td>$id</td>
						<td>$descripcion</td>
						<td>$sede</td>
						<td>$precio</td>
                                              </tr>";
			}			
		}
		
		$pie = " <tr style = 'height: 50px'>
                            <td></td>
                            <td></td>
                            <th>Total Precio:</th>
                            <td>$total</td>
			 </tr>";

		$row['success'] = $success; 
		$row['factura'] = $cabecera.$detalle.$pie;
		
		return $row;
	} 
			
 }
 
 function BuscarCliente($documento = 0){
    $cliente = "";
    $success = false; 
    $query  = "select * from clientes where documento = $documento";
    $result = phpmkr_query($query);
    if ($result){
        while ($row  = $result->fetch_assoc()){
		$success = true;
                $cliente = $row;
                InsertLog('s', $row['documento']." - ". $row['nombres']);
		}			
	}
        $row = $cliente; 
	$row['success'] = $success; 
        
	return $row;
			
 }

  function BuscarTotal($idcliente = 0){
	$query  = "SELECT FORMAT(COALESCE( SUM(precio), 0),2) as total FROM compras WHERE id_cliente = $idcliente";
    $result = phpmkr_query($query);
    $row = $result->fetch_assoc();
	
	return $row['total'];
 }
 
 function InsertCliente($documento, $nombres, $detalles, $id = 0){
    $success = false; 
    $query  = "select count(*) as count from clientes where id = $id";
    $result = phpmkr_query($query);
    if ($result){
        $row  = $result->fetch_assoc();
        $count = $row['count'];
        if ($count == 0)
            $query = "INSERT INTO clientes (documento, nombres, detalles ) VALUES ( $documento, '$nombres', '$detalles')";
        else
            $query = "UPDATE clientes SET documento = $documento, nombres = '$nombres', detalles = '$detalles' WHERE id = $id";     
        
            $result = phpmkr_query($query);
            if ($result){
                $success = true;; 
            }
        }
        $row['success'] = $success; 
	return $row;
			
 } 
 
 
 function EliminarCliente($idcliente = 0){
    $query  = "delete from clientes WHERE id = $idcliente";
    $result = phpmkr_query($query);
    if ($result){
        $success = true;
        InsertLog('d', "Modulo: Clientes - "."idcliente - $idcliente" );
    }
    else 
        $success = false;
        $row['success'] = $success;
	return $row;
 }
 
 
 
function InsertProducto($producto, $descripcion, $precio, $id = 0){
    $success = false; 
    $query  = "select count(*) as count from productos where id = $id";
    $result = phpmkr_query($query);
    if ($result){
        $row  = $result->fetch_assoc();
        $count = $row['count'];
        if ($count == 0)
            $query = "INSERT INTO productos (producto, descripcion, precio ) VALUES ( '$producto', '$descripcion', $precio)";
        else
            $query = "UPDATE productos SET producto = '$producto', descripcion = '$descripcion', precio = $precio WHERE id = $id";     
        
            $result = phpmkr_query($query);
            if ($result){
                $success = true;; 
            }
        }
        $row['success'] = $success; 
	return $row;
 }  
 
 
 function EliminarProducto($id = 0){
    $query  = "delete from productos WHERE id = $id";
    $result = phpmkr_query($query);
    if ($result){ 
        $success = true;
        InsertLog('d', "Modulo: Productos - "."idproducto - $id" );
    }
    else 
        $success = false;
        $row['success'] = $success;
	return $row;
 }
 
 
 function BuscarProductos($codproducto){
    $producto = "";
    $success = false; 
    $query  = "select * from productos where producto = '$codproducto' ";
    $result = phpmkr_query($query);
    if ($result){
        while ($row  = $result->fetch_assoc()){
		$success = true;
                $producto = $row;
                InsertLog('s', "Modulo: Productos ".$row['producto']." - ". $row['descripcion']);
		}			
	}
        $row = $producto; 
	$row['success'] = $success; 
        
	return $row;
			
 }
 
 
 function BuscarSede($codsede){
    $sede = "";
    $success = false; 
    $query  = "select * from sedes where sede = '$codsede' ";
    $result = phpmkr_query($query);
    if ($result){
        while ($row  = $result->fetch_assoc()){
		$success = true;
                $sede = $row;
                InsertLog('s', "Modulo: Sedes ".$row['sede']." - ". $row['direccion']);
		}			
	}
        $row = $sede; 
	$row['success'] = $success; 
        
	return $row;
			
 }
 
 
 function EliminarSede($id = 0){
    $query  = "delete from sedes WHERE id = $id";
    $result = phpmkr_query($query);
    if ($result){
        $success = true;
        InsertLog('d', "Modulo: Sedes - "."idsede - $id" );
    }
    else 
        $success = false;
        $row['success'] = $success;
	return $row;
 }
 
function InsertSede($sede, $direccion, $id = 0){
    $success = false; 
    $query  = "select count(*) as count from sedes where id = $id";
    $result = phpmkr_query($query);
    if ($result){
        $row  = $result->fetch_assoc();
        $count = $row['count'];
        if ($count == 0)
            $query = "INSERT INTO sedes (sede, direccion) VALUES ( '$sede', '$direccion' )";
        else
            $query = "UPDATE sedes SET sede = '$sede', direccion = '$direccion' WHERE id = $id";     
        
            $result = phpmkr_query($query);
            if ($result){
                $success = true;; 
            }
        }
        $row['success'] = $success; 
	return $row;
 }  
 
function ListarProductos($producto){
	$row = "";
	$query = "SELECT id, concat(producto,' - ' ,  descripcion) as descripcioncompleta, descripcion, producto, precio from productos where producto like '$producto%' or descripcion like '%$producto%' ";
	$result = phpmkr_query($query);
	if ($result){
		while ($row_rs = $result->fetch_array()){
                    $row[] = array("Label" => $row_rs['id'], 
                                   "value" => $row_rs['descripcioncompleta'], 
                                      "id" => $row_rs['id'],
                                  "precio" => $row_rs['precio'], 
                             "descripcion" => $row_rs['descripcion']);
		}
	}		
			
	return $row;
}

function ListarSedes(){
	$row = "";
	$query = "SELECT * from sedes ";
	$result = phpmkr_query($query);
	if ($result){
		while ($row_rs = $result->fetch_array()){
                    $row[] = $row_rs;
		}
	}		
			
	return $row;
}
 
function InsertFactura($data){
    $success = false; 
    $descripcion = "";
    $id_cliente = $data['idcliente'];
    $cantidad = $data['numero'];
    
    for ( $i = 1; $i <= $cantidad; $i++){
        
        $id_sede = $data['sede'.$i];
        $precio = $data['precio'.$i];
        $id_producto = $data['producto'.$i];
        
        if ($id_sede == 0)
            $id_sede = "null";
        
        $query  = "INSERT INTO compras (id_cliente, id_producto, id_sede, precio, descripcion, fecha) ";
        $query .= "VALUES ($id_cliente, $id_producto, $id_sede, $precio, '$descripcion', CURRENT_TIMESTAMP )";
        
        $result = phpmkr_query($query);

        if ($result){
            $success = true;; 
        }
        
        

        
    }
        $row['success'] = $success; 
	return $row;
 }  
 

}//end class       