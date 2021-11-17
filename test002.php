<?php
// На диске лежит файл image.png, размер 20000 на 20000. Вывести картинку как баннер размером 200 на 100 пикселей.
// Обратите внимание на размер и пропорции, и подумайте о времени загрузки.
// Пришлите ссылку на репозиторий с решением
// Важно: решение требует использования PHP, сжатие картинки средствами HTML/CSS является некорректным решением.

// Изменить размер картинки
// Пример
// $img = resize_image("image.jpg", 200, 200);
// imagejpeg($img,"resize.jpg",95);

function resize_image($file, $w, $h, $crop=FALSE,$is_show_msg = false) {
    try {
        $src = imagecreatefrompng($file);
    } catch (Exception $e) {
        $src = false;
    }
    
    if($src==false) {
        try {
            $src = imagecreatefromjpeg($file);   //try JPEG
        } catch (Exception $e) {
            $src = false;
        }
    }
    if(!$src) {
        try {
            $src = imagecreatefromgif($file);   //try gif
        } catch (Exception $e) {
            $src = false;
        }
    }
    if(!$src) {
        if ($is_show_msg) {        
            echo "Error read image $file <br>\r\n";
        }
        return false;
    }
    $width = imagesx($src);
    $height = imagesy($src);
    if ($is_show_msg) {
        echo "W: $width H: $height" . PHP_EOL;
    }
    
    $r = $width / $height;
    if ($crop) {
        $width_orig = $width;
        $height_orig = $height;
        if ($width > $height) {
            $width = $height;
        } else {
            $height = $width;
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = intval($h*$r);
            $newheight = $h;
        } else {
            $newheight = intval($w/$r);
            $newwidth = $w;
        }
    }
    if ($is_show_msg) {
        echo "W: $width H: $height NW:$newwidth NH: $newheight" . PHP_EOL;
    }
    
    $dst = imagecreatetruecolor($newwidth, $newheight);
    if ($crop) {
      if ($is_show_msg) {
        echo "Original: ($width_orig x $height_orig) Thumb: ($width x $height) \r\n";
      }
      $src_x = intval($width_orig / 2 - $width / 2);
      $src_y = intval($height_orig / 2 - $height / 2);
      //echo "$src_x $src_y \r\n";
      imagecopyresampled($dst, $src, 0, 0, $src_x, $src_y, $newwidth, $newheight, $width, $height);
    } else {
      imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    }
    return $dst;
}

$cache_file = "resize.png"; // Кэшированый файл
if (!file_exists($cache_file)) { // Если нет кэшированого файла
    $img = resize_image("image.png", 200, 100); // Изменить размер картинки как баннер размером 200 на 100 пикселей.
    if ($img!=false) {
        imagepng($img,$cache_file,9); // Сохранить файл в кэш
    }
}

if (file_exists($cache_file)) { // Если есть кэшированый файл
    header('Content-Type: image/png');
    header('Content-Length: ' . filesize($cache_file));
    readfile($cache_file);
    exit;        
}
