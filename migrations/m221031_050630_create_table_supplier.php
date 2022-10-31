<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m221031_050630_create_table_supplier
 */
class m221031_050630_create_table_supplier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('supplier', [
            'id' => 'int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT \'\'',
            'code' => 'char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL',
            't_status' => "enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok'",
        ], "ENGINE=InnoDB COMMENT='供应商表'");
        $this->createIndex('uk_code', 'supplier', ['code'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221031_050630_create_table_supplier cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221031_050630_create_table_supplier cannot be reverted.\n";

        return false;
    }
    */
}
