<?php
namespace App\Http\Requests;

use App\Core\Functions;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use App\Core\Slim;

class ImageRequest extends FormRequest
{
    public function guardarFoto( $campo, $ubicacion, $valor ){
        $slims = Slim::getImages($this, $campo);

        if ($slims !== false && count($slims) > 0) {
            $urlImages = [];
            foreach ($slims as $i => $slim) {

                if ($slims[$i]['input']) {

                    $extension = strrchr($slims[$i]['input']['name'], '.');
                    $path = $ubicacion;
                    $data = $slims[$i]['output']['data'];
                    $name = Functions::uniqidReal(32) . $extension;

                    if ($valor !== null && $valor !== '') {
                        if ($valor != '/storage/images/imagen_defecto.jpg' && substr($valor, 0, 13) != '/storage/images/default/') {
                            $valor = substr($valor, 0, 8);

                            if (file_exists(storage_path('app/public') . $valor)) {
                                unlink(storage_path('app/public') . $valor);
                            }
                        }
                    }

                    Slim::saveFile($data, $name, storage_path('app/public') . $path, false);

                    $image= '/storage' . $path . '/' . $name;
                    array_push($urlImages,$image);
                }
            }
        }

        if (!isset($urlImages) || $urlImages === [])
            return $valor;
        else
            return $urlImages;
    }

    public function rules() {
        return [];
    }
}
