<?php

namespace App\Controller;

use App\Service\CheckHealthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckHealthController extends AbstractController
{
    /**
     * @return JsonResponse
     * @Route("/api/health", name="check_health", methods={"GET"})
     */
    public function getHealthStatus(CheckHealthService $healthService)
    {
        $data = ['APP_ENV' => $healthService->env()];

        return new JsonResponse($data, 200);
    }
}
