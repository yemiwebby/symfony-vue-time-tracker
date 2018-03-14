<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimerController extends Controller
{
    /**
     * @Route("/projects/{id}/timers", name="timer")
     */
    public function createTimerAction(Request $request, int $id)
    {
        return $this->render('timer/index.html.twig', [
            'controller_name' => 'TimerController',
        ]);
    }

    /**
     * @Route("/project/timers/active", name="active_timer")
     */
    public function runningTimer()
    {
        return new Response('Sample', 200);
    }

    /**
     * @Route("/projects/{id}/timers/stop", name="stop_running")
     */
    public function stopRunningTimer()
    {
        return new Response('Another sample', 200);
    }
}
