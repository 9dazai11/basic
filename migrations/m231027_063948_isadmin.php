<?php

use yii\db\Migration;

/**
 * Class m231027_063948_isadmin
 */
class m231027_063948_isadmin extends Migration
{
    /**
     * {@inheritdoc}
     */
   
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('user', 'position', $this->integer());
    }

    public function down()
    {
        //echo "m231027_063948_isadmin cannot be reverted.\n";
        $this->dropColumn('user', 'position');
        //return false;
    }
    
}
