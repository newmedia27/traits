<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo`.
 */
class m180622_142630_create_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('seo', [
            'id' => $this->primaryKey(),
            'seo_h1'=>$this->string(),
            'seo_title'=>$this->string(),
            'seo_description'=>$this->text(),
            'seo_keywords'=>$this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('seo');
    }
}
