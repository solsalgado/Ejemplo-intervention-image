<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Imagen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<section>
<div class="container">
    <div class="row mt-4 pt-4">
        <h2 class="text-center">Subir y Editar Imagen</h2>
    </div>
<hr>
    <form action="accion/accionImage.php" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">

        <div class="col-md-6">
                <div class="form-group">
                    <label for="image">Subir Imagen</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
        </div>


    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert" id="sizeWarning" style="display: none;">
                La imagen es muy pesada. ¿Deseas reducir su tamaño?
                <br>
                <input type="checkbox" id="reducir" name="reducir" value="si">
                <label for="reducir">Sí, reducir tamaño</label>
            </div>
        </div>
    </div>

        <div class="col-md-6">
        <div class="form-group">
                <label for="format">Seleccionar Formato</label>
                <select class="form-control" id="format" name="format">
                    <option value="jpg">JPG</option>
                    <option value="png">PNG</option>
                    <option value="gif">GIF</option>
                </select>
            </div>
        </div>
        
    </div>
       
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="filters">Aplicar Filtros</label><br>
                <input type="checkbox" id="grayscale" name="filters[]" value="grayscale">
                <label for="grayscale">Escala de Grises</label><br>
                <input type="checkbox" id="blur" name="filters[]" value="blur">
                <label for="blur">Desenfoque</label><br>
                <input type="checkbox" id="brightness" name="filters[]" value="brightness">
                <label for="brightness">Brillo</label><br>
                <input type="checkbox" id="contrast" name="filters[]" value="contrast">
                <label for="contrast">Contraste</label><br>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="rotate">Rotar Imagen (grados)</label>
                <input type="number" class="form-control" id="rotate" name="rotate" placeholder="Grados (ej. 90)">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="text">Agregar Texto a la Imagen</label>
                <input type="text" class="form-control" id="text" name="text" placeholder="Texto en la Imagen">
            </div>
        </div>
    </div>
         
    <div class="row">
        <h4 class="mb-4">Recortar Imagen</h4>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="number" id="cropWidth" name="crop[width]" min="1" placeholder="Ancho">
        </div>
        <div class="col-md-6">
            <input type="number" id="cropHeight" name="crop[height]" min="1" placeholder="Altura">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <input type="number" id="cropX" name="crop[x]" min="0" placeholder="Posición X" require>
        </div>
        <div class="col-md-6">
            <input type="number" id="cropY" name="crop[y]" min="0" placeholder="Posición Y" require>
        </div>
    </div>
      
    <div class="row">
        <div class="col-md-12 mt-5">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>       
    </form>

    <script>
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        if (file.size > 1048576 ) { // Tamaño máximo 1MB
            document.getElementById('sizeWarning').style.display = 'block';
        } else {
            document.getElementById('sizeWarning').style.display = 'none';
        }
    });
</script>
</div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
