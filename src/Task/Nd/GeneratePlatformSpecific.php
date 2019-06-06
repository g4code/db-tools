<?php


class Task_Nd_GeneratePlatformSpecific extends Task_Db_Generate
{
    /**
     * @var string
     */
    private $platform;

    public function execute($args)
    {
        $this->platform = $this->choosePlatform($args);
        parent::execute($args);
    }


    private function choosePlatform($args)
    {
        $platforms = explode(',', $args['platforms']);

        print "\n\nChoose a platform where to execute this migration:\n";
        foreach ($platforms as $key => $plaform) {
            print $key . ') ' . $plaform . PHP_EOL;
        }
        $index = readline('Enter number: ');
        if (!isset($platforms[$index])) {
            print 'Error: Unknown platform!'. PHP_EOL;
            exit(-1);
        }

        return $index != 0 ? "'" . $platforms[$index] . "'" : null;
    }

    protected function get_template($className)
    {
        $template = <<<TPL
<?php

class $className extends Ruckusing_Migration_Base
{
    public function up()
    {
        if (!\$this->shouldExecuteMigration($this->platform)) {
            print "Migration $className for platform=$this->platform skipped" . PHP_EOL;
            return;
        }

        // TODO: add migration up code
    }//up()

    public function down()
    {
        // TODO: add migration down code
    }//down()
    
    private function shouldExecuteMigration(\$targetPlatform = 'ALL')
    {
        if (\$targetPlatform === 'ALL') {
            return true;
        }
        \$platformEnv = getenv('PLATFORM_ENV') ?: 'EUD';
        return \$platformEnv === \$targetPlatform;
    }
}

TPL;
        return $template;
    }
}