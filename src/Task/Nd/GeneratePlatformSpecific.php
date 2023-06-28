<?php


class Task_Nd_GeneratePlatformSpecific extends Task_Db_Generate
{
    public function execute($args)
    {
        parent::execute($args);
    }

    protected function get_template($className)
    {
        $template = <<<TPL
<?php

class $className extends Ruckusing_Migration_Base
{
    public function up()
    {
        // TODO: add migration up code
    }//up()

    public function down()
    {
        // TODO: add migration down code
    }//down()
}

TPL;
        return $template;
    }
}