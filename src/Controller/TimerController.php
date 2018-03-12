<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimerController extends Controller
{
    /**
     * @Route("/timer", name="timer")
     */
    public function index()
    {
        return $this->render('timer/index.html.twig', [
            'controller_name' => 'TimerController',
        ]);
    }
}
