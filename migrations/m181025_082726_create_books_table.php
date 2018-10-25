<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books`.
 * Has foreign keys to the tables:
 *
 * - `authors`
 */
class m181025_082726_create_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
            'text' => $this->text(),
            'count' => $this->integer(11),
            'author_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-books-author_id',
            'books',
            'author_id'
        );

        // add foreign key for table `authors`
        $this->addForeignKey(
            'fk-books-author_id',
            'books',
            'author_id',
            'authors',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `authors`
        $this->dropForeignKey(
            'fk-books-author_id',
            'books'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-books-author_id',
            'books'
        );

        $this->dropTable('books');
    }
}
