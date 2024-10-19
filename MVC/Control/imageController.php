<?php

require 'C:\xampp\htdocs\pruebaInterventionImage\vendor\autoload.php';  // Carga de autoload del Composer

use Intervention\Image\ImageManagerStatic as Image;

class ImageController {

    // Método principal que procesa la imagen
    public function procesarImagen($datos) {
        // Obtener la imagen cargada
        $imagen = $datos['image'];
        $rutaTemporal = $imagen['tmp_name'];
        $tamañoMaximo = 1048576; // Tamaño máximo permitido: 1MB

        // Verificar si el tamaño de la imagen excede el límite
        if ($imagen['size'] > $tamañoMaximo) {
            if (isset($datos['reducir'])) {
                $img = $this->reducirTamaño($rutaTemporal);
            } else {
                return 'Imagen demasiado grande. Por favor, reduzca el tamaño o seleccione otra imagen.';
            }
        } else {
            // Cargar la imagen usando Intervention Image si el tamaño es adecuado
            $img = Image::make($rutaTemporal);
        }

        // Procesar según las opciones seleccionadas en el formulario
        if (isset($datos['format'])) {
            $nuevoFormato = $datos['format']; // Almacenar el formato seleccionado
            $img = $this->cambiarFormato($img, $nuevoFormato);
        } else {
            // Mantener la extensión original si no se selecciona ningún formato
            $nuevoFormato = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        }

        if (isset($datos['filters'])) {
            $img = $this->aplicarFiltros($img, $datos['filters']);
        }

        if (isset($datos['crop'])) {
            $img = $this->recortarImagen($img, $datos['crop']);
        }

        if (isset($datos['rotate']) && is_numeric($datos['rotate'])) {
            $img = $this->rotarImagen($img, (int)$datos['rotate']);
        }
        
        if (isset($datos['text']) && trim($datos['text']) != "null") {
            $texto = $datos['text'];
            $img = $this->agregarTexto($img, $texto);
        }
        
        // Guardar la imagen procesada con el formato deseado
        $nombreUnico = 'imagen_' . uniqid() . '.' . $nuevoFormato;
        $rutaDestino = 'C:\xampp\htdocs\pruebaInterventionImage\Modificaciones/' . $nombreUnico;
        $img->save($rutaDestino);

        return $nombreUnico;
    }


// Función para reducir el tamaño de la imagen según un tamaño máximo permitido
private function reducirTamaño($rutaTemporal, $maxAncho = 1000, $maxAlto = 1000) {
    $img = Image::make($rutaTemporal);

    // Verificar si la imagen es más grande que el tamaño máximo permitido
    if ($img->width() > $maxAncho || $img->height() > $maxAlto) {
        // Ajustar el tamaño para que se reduzca al máximo permitido, manteniendo la relación de aspecto
        $img->resize($maxAncho, $maxAlto, function ($constraint) {
            $constraint->aspectRatio();  // Mantener la relación de aspecto
            $constraint->upsize();       // Evitar aumentar la imagen si es más pequeña que el máximo
        });
    }

    return $img;
}


    // Función para cambiar el formato de la imagen
    private function cambiarFormato($img, $formato) {
        switch ($formato) {
            case 'jpg':
                $img->encode('jpg');
                break;
            case 'png':
                $img->encode('png');
                break;
            case 'gif':
                $img->encode('gif');
                break;
            default:
                break;
        }
        return $img;
    }

    // Función para aplicar filtros a la imagen
    private function aplicarFiltros($img, $filtros) {
        foreach ($filtros as $filtro) {
            switch ($filtro) {
                case 'grayscale':
                    $img->greyscale();
                    break;
                case 'blur':
                    $img->blur(15); 
                    break;
                case 'brightness':
                    $img->brightness(20); // Aumentar brillo en 20, puede variar
                    break;
                case 'contrast':
                    $img->contrast(10);
                    break;
            }
        }
        return $img;
    }

    // Función para recortar la imagen
    private function recortarImagen($img, $opcionesRecorte) {
        $ancho = $opcionesRecorte['width'] ?? null;
        $alto = $opcionesRecorte['height'] ?? null;
        $posX = $opcionesRecorte['x'] ?? 0;
        $posY = $opcionesRecorte['y'] ?? 0;

        if ($ancho && $alto) {
            $img->crop($ancho, $alto, $posX, $posY);
        }
        return $img;
    }

    // Función para rotar la imagen
    private function rotarImagen($img, $grados) {
        $img->rotate($grados);  // Rotar imagen según los grados proporcionados
        return $img;
    }

    // Función para agregar texto a la imagen
    private function agregarTexto($img, $texto) {
        $img->text($texto, 100, 100, function($font) {
            $font->file('C:\\Windows\\Fonts\\Arial.ttf'); // Ruta de la fuente
            $font->size(30); // Tamaño del texto
            //$font->color('#ffffff'); // Color del texto
            $font->color('#000000');
            $font->align('center'); // Alineación del texto
            $font->valign('middle'); // Alineación vertical
        });
        return $img;
    }
}
