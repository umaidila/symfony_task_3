<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestDeployController extends AbstractController
{
    /**
     * @return JsonResponse
     * @Route("/api/deploy", name="check_deploy", methods={"GET"})
     */
    public function getDeploy()
    {
        $data = ['deploy' => 'dev'];

        return new JsonResponse($data, 200);
    }
}
