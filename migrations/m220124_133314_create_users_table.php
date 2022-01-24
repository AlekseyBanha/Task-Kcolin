<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220124_133314_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(User::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'email' => $this->string(255)->unique(),
            'password' => $this->string(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
