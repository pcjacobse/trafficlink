<?php // src/App/Command/GreetCommand.php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Monolog\Logger;

class SetupCommand extends Command
{
    private $logger;

    /**
     * Constructor
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;

        parent::__construct();
    }

    /**
     * Configures the command
     */
    protected function configure()
    {
        $this
            ->setName('setup')
            ->setDescription('Setup database');
    }

    /**
     * Executes the current command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Setting up entity schema...');

        $this->logger->info('Setup triggered');
    }
}
