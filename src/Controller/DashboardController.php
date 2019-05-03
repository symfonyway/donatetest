<?php

namespace App\Controller;

use App\Service\StatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboard()
    {
        return $this->render('dashboard.html.twig', ['title' => 'Dashboard']);
    }

    /**
     * @Route("/dashboard-data", name="dashboard_data")
     * @param StatisticService $statisticService
     * @return JsonResponse
     */
    public function getStats(StatisticService $statisticService)
    {
        $data = $statisticService->getDashboardStats();

        return new JsonResponse($data);
    }
}
