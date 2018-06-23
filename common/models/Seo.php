<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $seo_h1
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property int $created_at
 * @property int $updated_at
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seo_description', 'seo_keywords'], 'string'],
            [['table_name'], 'string'],
            [['item_id'], 'integer'],
            [['seo_h1', 'seo_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seo_h1' => 'Seo H1',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'seo_keywords' => 'Seo Keywords',
        ];
    }
}
