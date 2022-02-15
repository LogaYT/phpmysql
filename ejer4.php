<?php 
$mysqli = new mysqli ("127.0.0.1", "root", "","tienda");

if ($mysqli->connect_error){  
echo "Error al conectar:".$mysqli->connect_errno." ".$mysqli->connect_error ;  
} else { 

    $categorias = "SELECT IdCategoria, NomCategoria FROM categorias";
    $rescategorias = $mysqli->query($categorias);
    $fila = $rescategorias->fetch_assoc(); 

    echo "<form method='post' action='#'>";
        echo "<select name='categoria'>";
        while ($fila){
            echo "<option value=".$fila['IdCategoria'].">".$fila['NomCategoria']."</option>";
            $fila= $rescategorias->fetch_assoc();

        
        }
        echo "</select>";
        echo "<input type='submit' name='enviar'>";
    echo "</form>";


        if (isset($_POST["enviar"])){
            $QResultado = "SELECT P.NomProducto, P.Precio, P.Existencias FROM Productos P, Categorias C WHERE P.Categoria = C.IdCategoria AND P.Categoria =".$_POST['categoria'].";";
            $RResultado = $mysqli -> query($QResultado);
            $fila = $RResultado-> fetch_assoc();
            echo "<table border='1'>";
            echo "<tr>";
                echo "<th>Nombre del producto</th>";
                echo "<th>Precio</th>";
                echo "<th>Existencias</th>";
            echo "</tr>";

            while ($fila){
                
                echo "<tr>";
                echo "<td>".$fila['NomProducto']."</td>";
                echo "<td>".$fila['Precio']."</td>";
                echo "<td>".$fila['Existencias']."</td>";

                
                echo "</tr>";
                $fila=$RResultado->fetch_assoc();

            }
            echo "</table>";
        }

    $mysqli->close();
}



?>