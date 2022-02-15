<?php 
$mysqli = new mysqli ("127.0.0.1", "root", "","tienda");

if ($mysqli->connect_error){  
echo "Error al conectar:".$mysqli->connect_errno." ".$mysqli->connect_error ;  
}  
else{  
    /* $sql = "INSERT INTO categorias (IdCategoria, NomCategoria, Descripcion)";
    $sql.= " VALUES (11,'NuevaCategoria','Descripcion de la nueva categoría')"; */



    $sql="SELECT IdCliente, Nombre, Contacto, Telefono FROM clientes";
    $res = $mysqli->query($sql);

    echo "<h3> Clientes:".$res->num_rows."</h3>";

    if ($res){
        $fila = $res->fetch_assoc();
        echo "<table border='1'>";
        ?> <tr>
            <td>IdCliente</td>
            <td>Nombre</td>
            <td>Contacto</td>
            <td>Telefono</td>
            </tr>
        <?php
        while($fila){
            echo "<tr>";
            echo "<td>".$fila['IdCliente']."</td>";
            echo "<td>".$fila['Nombre']."</td>";
            echo "<td>".$fila['Contacto']."</td>";
            echo "<td>".$fila['Telefono']."</td>";

            echo "</tr>";
            $fila=$res->fetch_assoc();

        }
        echo "</table>";

    } else {
        echo "<p> Error interno. </p>";
    }

    $mysqli->close();
}




?>