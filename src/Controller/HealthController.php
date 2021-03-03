<?php


namespace test\HealthCheckBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use test\HealthCheckBundle\Service\HealthInterface;

class HealthController extends AbstractController
{
    /** @var HealthInterface[] */
    private $healthServices = [];

    public function addHealthService(HealthInterface $healthService)
    {
        $this->healthServices[] = $healthService;
    }

    /**
     * @Route("/health")
     * @return JsonResponse
     */
    public function getHealth(): JsonResponse
    {
        return $this->json(array_map(function (HealthInterface $healthService) {
            $info = $healthService->getHealthInfo();
            return [
                'name' => $healthService->getName(),
                'info' => [
                    'status' => $info->getStatus(),
                    'additional_info' => $info->getAdditionalInfo()
                ]
            ];
        }, $this->healthServices));
    }

}