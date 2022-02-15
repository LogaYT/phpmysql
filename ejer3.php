<?php 
$mysqli = new mysqli ("127.0.0.1", "root", "","tienda");

if ($mysqli->connect_error){  
echo "Error al conectar:".$mysqli->connect_errno." ".$mysqli->connect_error ;  
}  
else{  




    $sql="SELECT DISTINCT C.Nombre, SUM(LP.Precio * LP.Cantidad) AS Dinero
    FROM clientes C, pedidos P, lineaspedido LP
    WHERE C.IdCliente = P.Cliente AND P.NumPedido = LP.NumPedido AND year(P.Fecha) = 2021 GROUP BY C.Nombre;";
    $res = $mysqli->query($sql);

    $total = "SELECT SUM(LP.Precio * LP.Cantidad) as Total FROM lineaspedido LP";
    $totalres = $mysqli -> query($total);
    echo "<h3> Resultasdos:".$res->num_rows."</h3>";

    if ($res){
        $fila = $res->fetch_assoc();
        $filatotal = $totalres->fetch_assoc();
        echo "<table border='1'>";
        ?> <tr>
            <td>Nombre</td>
            <td>Dinero</td>

        </tr>
        <?php
            while($fila){
                echo "<tr>";
                
                echo "<td>".$fila['Nombre']."</td>";
                echo "<td>".$fila['Dinero']."</td>";
                
                echo "</tr>";
                $fila=$res->fetch_assoc();

            }
            echo "<tr> ";
            echo "<td> Precio Total </td>";
            echo "<td>".$filatotal['Total']."</td>";
            echo "</tr>";



        echo "</table>";

    } else {
        echo "<p> Error interno. </p>";
    }

    $mysqli->close();
}




?>