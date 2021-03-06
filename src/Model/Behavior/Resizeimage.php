<?php
namespace App\Model\Behavior;
use Cake\ORM\Behavior;

class ResizeimageBehavior extends Behavior {
    
    public function createthumbnail($image_name,$new_width,$new_height,$uploadDir,$moveToDir) {
        $path = $uploadDir . '/' . $image_name;
        $mime = getimagesize($path);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($path);
        }
        if ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($path);
        }
        if ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($path);
        }
        if ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($path);
        }
        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);
        if ($old_x > $old_y) {
            $thumb_w = $new_width;
            $thumb_h = $old_y * ($new_height / $old_x);
        }
        if ($old_x < $old_y) {
            $thumb_w = $old_x * ($new_width / $old_y);
            $thumb_h = $new_height;
        }
        if ($old_x == $old_y) {
            $thumb_w = $new_width;
            $thumb_h = $new_height;
        }
        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
        $new_thumb_loc = $moveToDir .$new_height."-". $image_name;
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($dst_img, $new_thumb_loc, 8);
        }
        if ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        if ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        if ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        imagedestroy($dst_img);
        imagedestroy($src_img);
        return $result;
    }
}