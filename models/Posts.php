<?php

namespace app\models;

use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public function getShortDescription($description){
        return substr($description, '0', '30') . '...';
    }
}
