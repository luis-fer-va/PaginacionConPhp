<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



    <?php
    DEFINE("USER","root");
    DEFINE("PASS","");
    try{
        $base=new PDO("mysql:host=localhost;dbname=dbpeluches",USER,PASS);
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
        $datosMostrados=3;
        if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("Location:index.php");
        }else{
            $pagina=$_GET["pagina"];

        }
    }else{
        $pagina=1;
    }

        $empezar_desde=($pagina-1)*$datosMostrados;
        $sql_total="SELECT nombre,precio,stock FROM producto";
        $resultado=$base->prepare($sql_total);
        $resultado->execute(array());
        $num_filas=$resultado->rowCount();
        $total_paginas=ceil($num_filas/$datosMostrados);
        echo "Numero de registros de la consulta: ".$num_filas."<br>";
        echo "Mostramos ".$datosMostrados." registros por pagina <br>";
        echo "Mostrando la pagina".$pagina. " de ".$total_paginas."<br>";
    
        $resultado->closeCursor();
        $sql_limite="SELECT nombre,precio,stock FROM producto LIMIT $empezar_desde,$datosMostrados";
        $resultado=$base->prepare($sql_limite);
        $resultado->execute(array());
        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
            echo "Nombre cliente: " .$registro["nombre"]."Precio: ".$registro["precio"]."Cantidad: ".$registro["stock"]."<br>";
    }}
    catch(Exception $e){


        echo "Error: ".$e->getMessage();
    }

    for($i=1;$i<=$total_paginas;$i++){
        echo "<a href='?pagina=". $i . "'>".$i. "</a>  ";
    }
    var_dump($pagina);
    ?>
</body>
</html>