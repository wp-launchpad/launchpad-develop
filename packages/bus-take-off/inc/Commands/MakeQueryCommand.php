<?php

namespace LaunchpadBusTakeOff\Commands;

use Ahc\Cli\IO\Interactor;
use LaunchpadCLI\Commands\Command;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\Services\ClassGenerator;
use League\Flysystem\Filesystem;

class MakeQueryCommand extends Command
{
    /**
     * Class generator.
     *
     * @var ClassGenerator
     */
    protected $class_generator;

    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Configuration from the project.
     *
     * @var Configurations
     */
    protected $configurations;

    public function __construct(ClassGenerator $class_generator, Filesystem $filesystem, Configurations $configurations)
    {
        parent::__construct('bus:make:query', 'Make a query for the bus.');

        $this->class_generator = $class_generator;
        $this->filesystem = $filesystem;
        $this->configurations = $configurations;

        $this
            ->argument('[name]', 'Full name from the query')
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 bus:make:query</end> <comment>MyClass </end> ## Create the query<eol/>'
            );
    }

    /**
     * Interacts with the user to get missing values.
     *
     * @param Interactor $io Interface to interact with the user.
     * @return void
     */
    public function interact(Interactor $io)
    {
        // Collect missing opts/args
        if (!$this->name) {
            $this->set('name', $io->prompt('Enter name from the command'));
        }
    }


    public function execute($name)
    {
        $io = $this->app()->io();

        $pathclass = dirname($name);

        $basename = basename($name);

        $classes = [
            'queries/query.php.tpl' => "$name",
            'queries/query_handler.php.tpl' => "{$pathclass}/QueryHandlers/{$basename}Handler",
            'queries/query_result.php.tpl' => "{$pathclass}/QueryResults/{$basename}Result",
        ];

        foreach ($classes as $class => $classname) {
            $path = $this->class_generator->generate($class, $classname, [
                'root_namespace' => $this->configurations->getBaseNamespace(),
                'base_namespace' => str_replace('/', '\\', $pathclass),
                'name' => $basename,
            ]);

            if( ! $path ) {
                $io->write("The class $classname already exists", true);
                continue;
            }

            $io->write("The class $classname generated", true);
        }
    }
}