<?php

namespace common\models;

use common\module\Seo\behavior\SeoBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $preview
 * @property string $content
 * @property string $image
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
//    use \backend\Traits\Seo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SeoBehavior::className()
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['preview', 'content'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['seo_description', 'seo_keywords'], 'string'],
            [['table_name'], 'string'],
            [['item_id'], 'integer'],
            [['seo_h1', 'seo_title'], 'string', 'max' => 255]
        ];

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {

        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'preview' => 'Preview',
            'content' => 'Content',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


}
