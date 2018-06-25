<?php
/**
 * Created by PhpStorm.
 * User: jart
 * Date: 25.06.2018
 * Time: 13:22
 */

namespace common\module\Seo\behavior;


use common\module\Seo\models\Seo;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class SeoBehavior extends Behavior
{
    public $seo_description;
    public $seo_keywords;
    public $seo_h1;
    public $seo_title;
    public $table_name;
    public $item_id;

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            BaseActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function beforeValidate()
    {
        $model = $this->owner;
        $seo = new Seo();
        $seo->seo_description = $model->seo_description;
        $seo->seo_keywords = $model->seo_keywords;
        $seo->seo_h1 = $model->seo_h1;
        $seo->seo_title = $model->seo_title;
        $seo->table_name = $model->table_name;
        $seo->item_id = $model->TableName();
        return $seo->validate();
    }

    public function afterSave()
    {
        $seo = new Seo();
        $model = $this->owner;
        $seo->table_name = $model->tableName();
        $seo->item_id = $model->id;
        $seo->seo_description = $model->seo_description;
        $seo->seo_keywords = $model->seo_keywords;
        $seo->seo_h1 = $model->seo_h1;
        $seo->seo_title = $model->seo_title;
        $seo->save();
    }

    public function afterFind()
    {
        $model = $this->owner;
//        echo'<pre>';print_r($model);die;

        if ($model->seo) {
//            echo 'TRUE';die;
            foreach ($model->seo as $seo) {
                $model->seo_description = $seo->seo_description;
                $model->seo_keywords = $seo->seo_keywords;
                $model->seo_h1 = $seo->seo_h1;
                $model->seo_title = $seo->seo_title;
            }
        }
    }

    public function afterDelete()
    {
        $model = $this->owner;
        Seo::deleteAll(['item_id' => $model->id, 'table_name' => $model->tableName()]);
    }

    public function getSeo()
    {
        $model = $this->owner;
        return Seo::find()->where(['item_id' => $model->id, 'table_name' => $model->tableName()])->all();
    }
}
