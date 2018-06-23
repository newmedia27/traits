<?php

namespace backend\Traits;

use yii\behaviors\TimestampBehavior;

trait Seo
{
    public $seo_description;
    public $seo_keywords;
    public $seo_h1;
    public $seo_title;
    public $table_name;
    public $item_id;

    public function rulesSeo()
    {
        return \common\models\Seo::rules();
    }

    public function attributeLabelsSeo(){

        return \common\models\Seo::attributeLabels();
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getSeo()
    {
        return \common\models\Seo::find()->where(['item_id' => $this->id, 'table_name' => $this->tableName()])->all();
    }

    public function afterSaveSeo()
    {
        $seo = new \common\models\Seo();
        $seo->table_name = $this->tableName();
        $seo->item_id = $this->id;
        $seo->seo_description = $this->seo_description;
        $seo->seo_keywords = $this->seo_keywords;
        $seo->seo_h1 = $this->seo_h1;
        $seo->seo_title = $this->seo_title;
        $seo->save(false);
    }

    public function beforeDeleteSeo()
    {
        \common\models\Seo::deleteAll(['item_id' => $this->id, 'table_name' => $this->tableName()]);

    }

    public function afterFindSeo()
    {
        if ($this->seo) {
            foreach ($this->seo as $seo) {
                $this->seo_description = $seo->seo_description;
                $this->seo_keywords = $seo->seo_keywords;
                $this->seo_h1 = $seo->seo_h1;
                $this->seo_title = $seo->seo_title;
            }
        }
    }


}