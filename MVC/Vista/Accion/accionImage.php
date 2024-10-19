<?php

// Incluir la función darDatosSubmitted()
require_once '../../../Util/funciones.php';

// Incluir el controlador que manejará las opciones seleccionadas
require_once '../../Control/imageController.php';

// Obtener los datos enviados del formulario
$datos = data_submitted();

$imageController = new ImageController();

// Procesar la imagen con las opciones enviadas
$nombreImagen = $imageController->procesarImagen($datos);

//test
print_r($datos);

//Ruta para guardar las imagenes
$rutaImagen = '../../../Modificaciones/' . $nombreImagen;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Imagen Procesada</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Resultado de la Imagen Procesada</h1>
    
    <div class="text-center mt-4">
        <h3>Imagen Procesada:</h3>
        <img src="<?php echo $rutaImagen; ?>" alt="Imagen Procesada" class="img-fluid img-thumbnail">
    </div>

    <div class="text-center mt-4">
        <a href="../../Vista/imageView.php" class="btn btn-primary">Volver al Formulario</a>
    </div>
</div>

</body>
</html>
