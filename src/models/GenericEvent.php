<?php
/**
 * Created by PhpStorm.
 * User: cronfy
 * Date: 19.10.17
 * Time: 9:38
 */

namespace cronfy\event\models;

use cronfy\experience\yii2\activeModel\ActiveModel;

class GenericEvent extends ActiveModel
{
    public function attributes()
    {
        return [
            'description',
        ];
    }

    public function getContents() {
        return $this->description;
    }

}