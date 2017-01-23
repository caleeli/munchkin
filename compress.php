<?php

function compress($source, $destination, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}
foreach (glob("img/Door/*.jpeg") as $source_img) {
    $d = compress($source_img, $source_img, 11);
}
foreach (glob("img/Treasures/*.jpeg") as $source_img) {
    $d = compress($source_img, $source_img, 11);
}
