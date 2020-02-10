<?php

namespace khelaia\pixover;
class pixover
{
    protected $image = null;
    protected $height = ['512'];
    protected $type;
    protected $to;
    protected $name;
    protected $names = [];

    /**
     * pixover constructor.
     * @param $image
     * @param $name
     * @param string $to
     */
    public function __construct($image, $name, $to='./')
    {
        $this->_setImage($image);
        $this->name = $name;
        $this->to = $to;
    }

    /**
     * @param array $height
     */
    public function setHight(array $height){
        $this->height = $height;
    }

    /**
     * @return array|string
     */
    public function done(){
        try {
            foreach ($this->height as $height){
                $this->resizeImage($height);
            }
            return $this->names;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * @param int $height
     */
    protected function resizeImage(int $height){
        $dir = $this->to.'/x'.$height;
        $filename = $this->name.'.'.$this->image->getClientOriginalExtension();
        $fullpath = $dir.'/'.$filename;
        $this->names[] = $filename;
        $width = $height*$this->ratio();
        $size = getimagesize($this->image);
        $file = imagecreatefromstring(file_get_contents($this->image));
        $dst = imagecreatetruecolor($width,$height);
        imagecopyresampled($dst,$file,0,0,0,0,$width,$height,$size[0],$size[1]);
        imagedestroy($file);
        if (!file_exists($dir)){
            mkdir($dir);
        }
        if ($this->type == 'PNG'){
            imagepng($dst,$fullpath);
        }else{
            imagejpeg($dst,$fullpath);
        }
        imagedestroy($dst);
    }


    /**
     * @return float|int
     */
    protected function ratio(){
        $image = $this->image->getPathName();
        list($width, $height, $type, $attr) = getimagesize($image);
        return $width/$height;
    }

    /**
     * @param $image
     */
    protected function _setImage($image)
    {
        try {
            $info = getimagesize($image->getPathName());
            $image_type = $info["mime"];
            if($image_type == "image/jpeg")
            {
                $this->image = $image;
                $this->type =  "JPEG";
            }elseif($image_type == "image/png"){
                $this->image = $image;
                $this->type = "PNG";
            }else{
                throw new \InvalidArgumentException(
                    '$image should be PNG or JPEG'
                );
            }

        }catch (\Exception $exception){
            throw new \InvalidArgumentException (
                $exception->getMessage()
            );
        }
    }
}
