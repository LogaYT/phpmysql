<?php 
$mysqli = new mysqli ("127.0.0.1", "root", "","tienda");

if ($mysqli->connect_error){  
echo "Error al conectar:".$mysqli->connect_errno." ".$mysqli->connect_error ;  
} else { 

    $categorias = "SELECT * FROM categorias";
    $rescategorias = $mysqli->query($categorias);
    $fila = $rescategorias->fetch_assoc(); 

    echo "<table border='1'>";
        echo "<tr>";
            echo "<th>Id Categoria</th>";
            echo "<th>Nombre Categoria</th>";
            echo "<th>Descripción de la categoría</th>";
            echo "<th>Unidades Vendidas</th>";
        echo "</tr>";

            while ($fila){
                echo "<tr>";
                        echo "<td>".$fila['IdCategoria']."</td>";
                        echo "<td>".$fila['NomCategoria']."</td>";
                        echo "<td>".$fila['Descripcion']."</td>";
                        echo "<td>".$fila['UnidadesVendidas']."</td>";
                        echo "<td><a href='formulario.php?Id=".$fila['IdCategoria']."'>Modificar</a></td>";
                echo "</tr>";
                $fila= $rescategorias->fetch_assoc();

            
            }

} 
$mysqli->close();
?>
