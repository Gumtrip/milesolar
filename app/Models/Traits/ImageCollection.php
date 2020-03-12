<?php


namespace App\Models\Traits;


trait ImageCollection
{
    public function getBigImgAttribute(){
        return asset(getThumbName($this->image,'big'));
    }

    public function getMidImgAttribute(){
        return asset(getThumbName($this->image,'mid'));
    }
    public function getSmImgAttribute(){
        return asset(getThumbName($this->image,'sm'));
    }
}
