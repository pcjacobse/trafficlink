<?php

namespace App\Action;

use App\Domain\Traject\Traject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class RestAction
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        /** @var Traject[] $trajects */
        $trajects = $this->entityManager->getRepository('App\Domain\Traject\Traject')->findAllWithStatusFromLastHour();

        $data = [];
        foreach ($trajects as $traject) {
            $geometry = [];
            foreach ($traject->getGeometryPoints() as $geometryPoint) {
                $geometry[] = [
                    'latitude'  => $geometryPoint->getLatitude(),
                    'longitude' => $geometryPoint->getLongitude(),
                ];
            }

            $statuses = [];
            foreach ($traject->getStatuses() as $status) {
                $statuses[] = [
                    'measuredAt' => $status->getMeasuredAt()->format('Y-m-d\TH:i:s'),
                    'velocity'   => $status->getVelocity(),
                    'traveltime' => $status->getTraveltime(),
                ];
            }

            $data[] = [
                'name'     => $traject->getName(),
                'geometry' => $geometry,
                'statuses' => $statuses,
            ];
        }

        return new JsonResponse($data);
    }
}
