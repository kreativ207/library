<?php

use yii\db\Migration;

/**
 * Handles the creation of table `authors`.
 */
class m181025_082027_create_authors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'author' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('authors');
    }
}
