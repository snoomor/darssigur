<?php

namespace App\Actions;

use Illuminate\Support\Facades\File;

class PhotoCompressionAction
{
    public function handle($worker_id, $data)
    {
        $compression_error = false;
        if (isset($data['image'])) {
            //dump('Исходный размер ' . filesize($data['image']));
            $img = imagecreatefromjpeg($data['image']);
            $img_name = session('guest_loc_id') . $worker_id . '.jpg';
            $img = imagejpeg($img, 'storage/uploads/' . $img_name, 60);
            $data['image'] = 'storage/uploads/' . $img_name;
            //dump('Обязательная обработка ' . filesize($data['image']));
            if (filesize($data['image']) > 357000) {
                $quality = 50;
                while (filesize($data['image']) > 357000) {
                    //dump($quality);
                    $old_size = filesize($data['image']);
                    $img = imagecreatefromjpeg($data['image']);
                    File::delete('storage/uploads/' . $img_name);
                    $img = imagejpeg($img, 'storage/uploads/' . $img_name, $quality);
                    //dump('Цикл ' . filesize($data['image']));
                    if (filesize($data['image']) == $old_size) {
                        $quality = $quality - 10;
                        if ($quality < 0 or filesize($data['image']) > $old_size) {
                            $compression_error = true;
                            break;
                        }
                    }
                }
            }
        }
        //dump($compression_error);
        //dd('Финальный размер ' . filesize($data['image']));
        if ($compression_error) {
            File::delete('storage/uploads/' . $img_name);
            $data['compression_error'] = true;
            return ($data);
        }
        return ($data);
    }
}
