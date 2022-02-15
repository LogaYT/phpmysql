<?php 
$mysqli = new mysqli ("127.0.0.1", "root", "","tienda");

if ($mysqli->connect_error){  
echo "Error al conectar:".$mysqli->connect_errno." ".$mysqli->connect_error ;  
} else { 
    $cons="SELECT * FROM Categorias WHERE IdCategoria = ".$_GET['Id'].";";
    $res = $mysqli->query($cons);
    $fila = $res->fetch_assoc();


    echo "<h1>Estás modificando la categoría ".$fila['NomCategoria']." con la ID ".$_GET['Id']."</h1>";
    echo "<form method='post' action=''>";

        echo "<p>Id de la Categoría: <input type='text' name='IdCategoria' placeholder='".$_GET['Id']."' readonly></input></p>";
        echo "<p>Nombre de la categoría: <input type='text' name='NombreCategoria' placeholder='".$fila['NomCategoria']."'></input></p>";
        echo "<p>Descripción de la categoría: <input type='text' name='DescripcionCategoria' placeholder='".$fila['Descripcion']."'></input></p>";
        echo "<p>Unidades Vendidas: <input type='text' name='UnidadesVendidas' placeholder='".$fila['UnidadesVendidas']."'></input></p>";
        echo "<input type='submit' name='send' value='Modificar'>";
        echo "<button><a href='tabla.php'>Volver a la tabla.</a></button>";    
    
    echo "</form>";

    if (isset($_POST["send"])){
        echo "<hr>";
        $TextoError = "";
        include_once "funciones.php";

        if (ValidarNombre($_POST["NombreCategoria"])){
            $NombreCategoria = $_POST["NombreCategoria"];
        }else $TextoError .= "<p>Error en el nombre de la categoría.</p>";

        if (ValidarDescripcion($_POST["DescripcionCategoria"])){
            $DescripcionCategoria = $_POST["DescripcionCategoria"];
        }else $TextoError .="<p>Error en la descripción de la categoría. </p>";

        if (ValidarUnidades($_POST["UnidadesVendidas"])){
            $UnidadesVendidas = $_POST["UnidadesVendidas"];
        }else $TextoError .="<p>Las unidades vendidas deben ser un número.</p>";
        
        

        if (strlen($TextoError)>0){
            echo $TextoError;
            echo "<button><a href='tabla.php'>Volver a la tabla.</a></button>";
        }else {
            $ins1 = "UPDATE Categorias SET NomCategoria = '".$NombreCategoria."', ";
            $ins1 .= "Descripcion = '".$DescripcionCategoria."', ";
            $ins1 .= "UnidadesVendidas = ".$UnidadesVendidas." "; 
            $ins1 .= "WHERE IdCategoria = ".$_GET['Id']."";
            $mysqli->query($ins1);
            echo "<p>La fila con ID ".$_GET['Id']." se ha modificado con éxito.</p>";
            echo "<button><a href='tabla.php'>Volver a la tabla.</a></button>";
        }
    }    
    
    
} 
$mysqli->close();
?>