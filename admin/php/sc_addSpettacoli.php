<?php
header('Content-type: text/html; charset=UTF-8');
    require_once("../../inc/php/db_connection.php");

    $sala = $_POST['sala'];
    $orario = $_POST['orario'];
    $costo = $_POST['costo'];
    $codiceFilm = $_POST['film'];

    //Query per caricamento in Elenco Film
    $q = "INSERT INTO spettacoli VALUES (NULL, '$sala','$orario',$costo, $codiceFilm)";
    mysqli_query($conn, $q);
                
    mysqli_close($conn);
    
?>