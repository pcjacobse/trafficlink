<?php // src/App/Command/GreetCommand.php

namespace App\Command;

use App\Domain\Traject\Traject;
use App\Domain\TrajectGeometryPoint\TrajectGeometryPoint;
use App\Domain\TrajectStatus\TrajectStatus;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Monolog\Logger;

class UpdateCommand extends Command
{
    /** @var Logger */
    protected $logger;
    /** @var EntityManager */
    protected $entityManager;

    /**
     * Constructor
     */
    public function __construct(Logger $logger, EntityManager $entityManager)
    {
        $this->logger = $logger;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    /**
     * Configures the command
     */
    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Import trafficlink data');
    }

    /**
     * Logs errors
     * 
     * @param OutputInterface $output
     * @param string $reason
     */
    protected function failed(OutputInterface $output, $reason = 'Unknown')
    {
        $output->writeln('FAILED - Reason: ' . $reason);

        $this->logger->info('Update failed', ['reason' => $reason]);
    }

    /**
     * Executes the current command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Downloading new data...');

        // Download the json
        $client = new Client();
        $response = $client->get('http://www.trafficlink-online.nl/trafficlinkdata/wegdata/TrajectSensorsNH.GeoJSON');
        if($response->getStatusCode() != 200) {
            return $this->failed($output, 'Download status ' . $response->getStatusCode());
        }
        $result = json_decode($response->getBody(), true);

        // basic sanity check
        if(!isset($result['features'])) {
            return $this->failed($output, 'Wrong data');
        }

        // parse each given Traject (feature)
        foreach($result['features'] as $feature) {
            $this->updateTraject($feature);
        }

        $this->logger->info('Update successfull');
    }

    /**
     * Parses feature into a traject
     * 
     * @param array $feature
     */
    protected function updateTraject($feature)
    {
        $id = $feature['Id'];
        $traject = $this->entityManager->find('App\Domain\Traject\Traject', $id);
        
        // If we haven't seen this traject before, lets create it.
        if(!$traject) {
            $traject = new Traject();
            $traject->setId($id);
            $traject->setLength($feature['properties']['Length']);
            $traject->setName($feature['properties']['Name']);

            $this->entityManager->persist($traject);
            $this->entityManager->flush($traject);
            
            // Save the route with geo-coordinates so we can display it on the map
            $position = 0;
            foreach($feature['geometry']['coordinates'] as $coordinate) {
                $geometry = new TrajectGeometryPoint();
                $geometry->setTraject($traject);
                $geometry->setPosition($position++);
                $geometry->setFromCoordinate($coordinate);

                $this->entityManager->persist($geometry);
                $this->entityManager->flush($geometry);
            }
        }
        
        // Lets create a new status for this traject
        $status = new TrajectStatus();
        $status->setTraject($traject);

        // normally we would do the following, however since the project is no longer correctly working, lets just add (semi)random data
        // I did notice that the ones that actually have values don't really add up mathematically.
        // The length devided by the speed is not equal to the traveltime, so maybe its not a real avarage ?

        /*
        $status->setMeasuredAt(\DateTime::createFromFormat('d-m-Y H:i:s', $feature['properties']['Timestamp']));
        $status->setVelocity($feature['properties']['Velocity']);
        $status->setTraveltime($feature['properties']['Traveltime']);
        */

        $status->setMeasuredAt(new \DateTime());
        // lets pick a random speed between 5 kmph and 50 kmph
        $velocity = rand(5, 50);
        // for sanity's sake, lets calculate the 'real' traveltime
        $traveltime = round($traject->getLength() / ($velocity / 3.6));

        $status->setVelocity($velocity);
        $status->setTraveltime($traveltime);

        $this->entityManager->persist($status);
        $this->entityManager->flush($status);
    }
}
