<?php

use yii\db\Migration;

class m181025_084550_add_user_in_table extends Migration
{
    private $usersTable = '{{%user}}';

    public function safeUp()
    {
        $this->insert($this->usersTable, [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123'),
            'email' => 'admin@admin.com',
            'created_at' => time(),
            'updated_at' => time(),
            'role' => 10,
        ]);
    }
    public function safeDown()
    {
        $this->truncateTable($this->usersTable);
    }
}
