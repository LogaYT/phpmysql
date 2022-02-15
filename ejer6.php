<?php error_reporting(0);
$mysqli = new mysqli ("127.0.0.1", "root", "","tienda");

if ($mysqli->connect_error){  
echo "Error al conectar:".$mysqli->connect_errno." ".$mysqli->connect_error ;  
} else { 
    if (isset($_POST["send"])){
        $TextoError = "";
        $cons1="SELECT MAX(IdCategoria) FROM categorias";
        $resultCons1 = $mysqli->query($cons1);
        $LastID = $resultCons1->fetch_assoc();
        $NewID = $LastID["MAX(IdCategoria)"]++;

            if ((!empty($_POST["Nombre"])) && (strlen($_POST["Nombre"]) >= 3 )){
                $nombre = $_POST["Nombre"];
            } else {
                $TextoError.= "<p>El nombre de la categoría debe tener 3 o más carácteres.</p>";
                $MostrarForm = true;
            }
            
            if ((!empty($_POST["Descr"])) && (strlen($_POST["Descr"]) >= 10 )){
                $descripcion = $_POST["Descr"];
            }else {
                $TextoError.= "<p>La descripcion de la categoría debe tener 10 o más carácteres.</p>";
                $MostrarForm = true;
            }
            
    }else {$MostrarForm = true;}
    
    if ($MostrarForm==true){
        echo "<form method='post' action='#'>";
        
            echo "<p>Nombre de la categoría: <input type='text' name='Nombre'></p>";
            echo "<p>Descripcion de la categoría: <input type='text' name='Descr'></p>";
            echo "<input type='submit' name='send'>";    
        
        
        echo "</form>";

    } else {
        $ins1 = "INSERT INTO Categorias (IdCategoria, NomCategoria, Descripcion) VALUES (".$NewID.",'".$nombre."','".$descripcion."')";
        $mysqli->query($ins1);
        echo "Se han insertado las líneas con éxito.";
        
    
    
    }



    if (strlen($TextoError)>0){
        echo "<hr>";
        echo $TextoError;
    } 
    
    

    $mysqli->close();
}


?>