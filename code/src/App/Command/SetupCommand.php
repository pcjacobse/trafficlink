<?php // src/App/Command/GreetCommand.php

namespace App\Command;

use App\Entity\GeometryPoint;
use App\Entity\Traject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Monolog\Logger;
use taywils\Patomic\Patomic;
use taywils\Patomic\PatomicTransaction;

class SetupCommand extends Command
{
    private $logger;
    private $patomic;

    /**
     * Constructor
     */
    public function __construct(Logger $logger, Patomic $patomic)
    {
        $this->logger = $logger;
        $this->patomic = $patomic;

        parent::__construct();
    }

    /**
     * Configures the command
     */
    protected function configure()
    {
        $this
            ->setName('setup')
            ->setDescription('Setup datomic database');
    }

    /**
     * Executes the current command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Setting up entity schema...');

//        ob_start();
        $this->patomic->commitTransaction(Traject::setup());
        $this->patomic->commitTransaction(GeometryPoint::setup());
//        ob_end_clean();


        $pt = new PatomicTransaction();
        $pt->addMany(null,
            array("traject" => "name", "Sam"),
            array("traject" => "velocity", 10)
        );
        $this->patomic->commitTransaction($pt);

        var_dump(Traject::loadEntity(1, $this->patomic));

        $this->logger->info('Setup triggered');
    }
}
