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
    try{
        $base=new PDO("mysql:hostname=localhost; dbname=dbpeluches","root","");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
        $sql_total="SELECT nombre,precio,stock FROM producto";
        $resultado=$base->prepare($sql_total);
        $resultado->execute(array());
        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
            echo "Nombre cliente: " .$registro["nombre"]."Precio: ".$registro["precio"]."Cantidad: ".$registro["stock"];
        }
    }catch(Exception $e){

    }



    ?>
</body>
</html>