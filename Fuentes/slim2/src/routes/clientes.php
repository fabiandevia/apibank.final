<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener todos los clientes
$app->get('/api/clientes', function(Request $request, Response $response){
    $consulta = "SELECT * FROM clientes";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $clientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        //Exportar y mostrar en formato JSON
        echo json_encode($clientes);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Obtener un solo cliente
$app->get('/api/clientes/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $consulta = "SELECT * FROM clientes WHERE id='$id'";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $cliente = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        //Exportar y mostrar en formato JSON
        echo json_encode($cliente);
        
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Agregar Cliente
$app->post('/api/clientes/agregar', function(Request $request, Response $response){
    $nombres            = $request->getParam('nombres');
    $apellidos          = $request->getParam('apellidos');
    $tipo_documento     = $request->getParam('tipo_documento');
    $documento          = $request->getParam('documento');
    $telefono           = $request->getParam('telefono');
    $email              = $request->getParam('email');
    $direccion          = $request->getParam('direccion');
    $pais               = $request->getParam('pais');
    $departamento       = $request->getParam('departamento');
    $ciudad             = $request->getParam('ciudad');
    
    $consulta = "INSERT INTO clientes (nombres, apellidos, tipo_documento, documento, telefono, email, direccion, pais, departamento, ciudad) VALUES
                                      (:nombres, :apellidos, :tipo_documento, :documento, :telefono, :email, :direccion, :pais, :departamento, :ciudad)";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexión
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombres',           $nombres);
        $stmt->bindParam(':apellidos',         $apellidos);
        $stmt->bindParam(':tipo_documento',    $tipo_documento);
        $stmt->bindParam(':documento',         $documento);
        $stmt->bindParam(':telefono',          $telefono);
        $stmt->bindParam(':email',             $email);
        $stmt->bindParam(':direccion',         $direccion);
        $stmt->bindParam(':pais',              $pais);
        $stmt->bindParam(':departamento',      $departamento);
        $stmt->bindParam(':ciudad',            $ciudad);
        $stmt->execute();
        echo '{"notice": {"text": "Cliente agregado con exito"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar Cliente
$app->put('/api/clientes/actualizar/{id}', function(Request $request, Response $response){
    $id             = $request->getAttribute('id');
    $nombres        = $request->getParam('nombres');
    $apellidos      = $request->getParam('apellidos');
    $tipo_documento = $request->getParam('tipo_documento');
    $documento      = $request->getParam('documento');  
    $telefono       = $request->getParam('telefono');
    $email          = $request->getParam('email');
    $direccion      = $request->getParam('direccion');
    $pais           = $request->getParam('pais');
    $departamento   = $request->getParam('departamento');
    $ciudad         = $request->getParam('ciudad');


     $consulta = "UPDATE clientes SET
				nombres 	     = :nombres,
				apellidos 	     = :apellidos,
                tipo_documento   = :tipo_documento,
                documento        = :documento,
                telefono	     = :telefono,
                email		     = :email,
                direccion   	 = :direccion,
                pais             = :pais,
                departamento     = :departamento,
                ciudad 		     = :ciudad               
			WHERE id = $id";


    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexion
        $db = $db->conectar();
        $stmt = $db->prepare(               $consulta);
        $stmt->bindParam(':nombres',        $nombres);
        $stmt->bindParam(':apellidos',      $apellidos);
        $stmt->bindParam(':tipo_documento', $tipo_documento);
        $stmt->bindParam(':documento',      $documento);     
        $stmt->bindParam(':telefono',       $telefono);
        $stmt->bindParam(':email',          $email);
        $stmt->bindParam(':direccion',      $direccion);
        $stmt->bindParam(':pais',           $pais);
        $stmt->bindParam(':departamento',   $departamento);
        $stmt->bindParam(':ciudad',         $ciudad);
        $stmt->execute();
        echo '{"notice": {"text": "Cliente actualizado con exito"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar cliente
$app->delete('/api/clientes/borrar/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM clientes WHERE id = $id";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexion
        $db = $db->conectar();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Cliente borrado con exito"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});