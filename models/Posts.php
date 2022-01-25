<?php

namespace app\models;

use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title','description'], 'required'],
            ['title','string','min'=>3,'max'=>255],
            ['description','string','min'=>5,'max'=>25500],
        ];
    }


    public function getShortDescription($description)
    {
        if (strlen($description) > 35) {
            return substr($description, 0, 35) . '...';
        } else {
            return $description;
        }
    }
}
