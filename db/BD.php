<?php

$pdo=null;
$host="ip-10-0-104-71";
$user="b1d58d81884da3";
$password="2ac2672b";
$bd="heroku_c8381f705ba64e3";

    function conectar(){
        try{
            $GLOBALS['pdo']=new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['bd']."", $GLOBALS['user'], $GLOBALS['password']);
            $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            print "Error!: No se pudo conectar a la bd ".$bd."<br/>";
            print "\nError!: ".$e."<br/>";
            die();
        }
    }

    function desconectar() {
        $GLOBALS['pdo']=null;
    }

    function consultaGet($consulta) {
        conectar();
        $resultado=  $GLOBALS['pdo']->prepare($consulta);
        $resultado->setFetchMode(PDO::FETCH_ASSOC);
        $resultado->execute();
        desconectar();
        return $resultado;
    }

    function consultaPost($consulta,$input=NULL,$error=NULL){
        if( !empty($consulta)){
            conectar();
            try{                
                $stmt = $GLOBALS['pdo']->prepare($consulta);
                bindAllValues($stmt, $input);
                $stmt->execute();
                echo json_encode($input);
                $stmt->closeCursor();
                desconectar();
                return;
            }
            catch(Exception $e){
                die($error);
            }
        }else{
            return 0;
        }
    }

    function consultaPut($consulta,$input=NULL,$error=NULL){
        if( !empty($consulta)){
            conectar();
            try{                
                $stmt = $GLOBALS['pdo']->prepare($consulta);
                $stmt->execute();
                $stmt->closeCursor();
                desconectar();
                return;
            }
            catch(Exception $e){
                die($error);
            }
        }else{
            return 0;
        }
    }

    function consultaDelete($consulta,$error=NULL){
        if( !empty($consulta)){
            conectar();
            try{                
                $stmt = $GLOBALS['pdo']->prepare($consulta);
                $stmt->execute();
                $stmt->closeCursor();
                desconectar();
                return;
            }
            catch(Exception $e){
                die($error);
            }
        }else{
            return 0;
        }
    }


 //Obtener parametros para updates
    function getParams($input)
    {
    $filterParams = [];
    foreach($input as $param => $value)
    {
        $filterParams[] = "$param=:$param";
    }
    //print_r($filterParams);
    return implode(", ", $filterParams);
    }

    //Asociar todos los parametros a un sql
	function bindAllValues($statement, $params)
    {
    //echo var_dump($params);
		foreach($params as $param => $value){
        $statement->bindValue(':'.$param, $value);
        //echo $value."\n";
    }
		return $statement;
   }


   /*function cadenaUpdate($array, $metodo){
    $cadena ='';
    $coma=",";
        for($i=0; $i<count($array); $i++){
            if($coma==(count($array)-1))$coma="";
           $cadena.=$array[$i]."=".$metodo.'["'.$array[$i].'"],'; 
        }
        return $cadena;
   }*/

  

 ?>
