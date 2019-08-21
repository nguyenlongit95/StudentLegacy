<?php

namespace App\Helpers;
class sizeFomat{
    /**
     * Phương thức chuyển đổi dung lượng file
     * Tham số đầu vào là dung lượng của file tính theo byte
     * Trả lại kết qủa tương ứng với dung lượng của file đã được chuyển đổi
     * */
    public function sizeFormat($size)
    {
        if($size<1024)
        {
            return $size." bytes";
        }
        else if($size<(1024*1024))
        {
            $size=round($size/1024,1);
            return $size." KB";
        }
        else if($size<(1024*1024*1024))
        {
            $size=round($size/(1024*1024),1);
            return $size." MB";
        }
        else
        {
            $size=round($size/(1024*1024*1024),1);
            return $size." GB";
        }
    }

    public function convertByteToMB($size){
        if($size==null)
        {
            return 0;
        }
        else
        {
            $size=round($size/(1024*1024),1);
            return $size;
        }
    }
    public function convertMbToByte($size){
        if($size==null)
        {
            return 0;
        }
        else
        {
            $size=round($size * (1024*1024));
            return $size;
        }
    }

    public function convertMbToGb($size){
        if($size==null)
        {
            return 0;
        }
        else
        {
            $size=round($size / (1024));
            return $size;
        }
    }

    public function convertGbToByte($size){
        if($size==null)
        {
            return 0;
        }
        else
        {
            $size=round($size * (1024*1024*1024));
            return $size;
        }
    }

    public function convertByteToGB($size)
    {
        if($size==null)
        {
            return 0;
        }
        else
        {
            $size=round($size/(1024*1024*1024),1);
            return $size;
        }
    }
}
?>
