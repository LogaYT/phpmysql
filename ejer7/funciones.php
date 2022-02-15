<?php 

function ValidarNombre($name){
    if ((!empty($_POST["NombreCategoria"]))){
        return true;
    }else return false;
}

function ValidarDescripcion($descr){
    if ((!empty($_POST["DescripcionCategoria"]))){
        return true;
    }else return false;
}

function ValidarUnidades($uds){
    if ((is_numeric($_POST["UnidadesVendidas"]))){
        return true; 
    }return false;
}
?>