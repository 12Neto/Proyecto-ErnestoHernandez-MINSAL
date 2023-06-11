<?php
$databaseHost='localhost';
$databaseUsername='root';
$databaseName='devgobdb';
$databasePassword='admin';
$mysqli=mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
$resultado=mysqli_query($mysqli,"SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Gobierno de El Salvador</h1>
    <p><strong>Nombre de Institución:</strong> MINSAL</p>
    <p><strong>Proyecto creado por:</strong> 
        José Ernesto Hernández Vásquez</p>
    <p><strong>Listado de Proyectos:</strong></p>
    <table class="table-auto w-full">
                <tr bgcolor='#DDDDDD'>
                    <td><strong>Nombre Proyecto</strong></td>
                    <td><strong>Fuente de Fondos</strong></td>
                    <td><strong>Monto Planificado</strong></td>
                    <td><strong>Monto Patrocinado</strong></td>
                    <td><strong>Monto Fondos Propios</strong></td>
                    
                </tr>
                <tr>
                    <?php
                    while($res=mysqli_fetch_assoc($resultado))
                    {
                        echo "<tr>";
                        echo"<td align=center>".$res['nombreProyecto']."</td>";
                        echo"<td align=center>".$res['fuenteFondos']."</td>";
                        echo"<td align=center>".$res['montoPlanificado']."</td>";
                        echo"<td align=center>".$res['montoPatrocinado']."</td>";
                        echo"<td align=center>".$res['montoFondosPropios']."</td>";
                    }
                    ?>
            </table>
    
</body>
</html>