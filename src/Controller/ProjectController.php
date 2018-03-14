<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;

class ProjectController extends Controller
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $projectRepository;

    /**
     * ProjectController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->projectRepository = $entityManager->getRepository('App:Project');
    }

    /**
     * @Route("/projects", name="project")
     */
    public function index()
    {
        $projects = $this->projectRepository->findBy(["user" => $this->getUser()]);

        return $this->json($projects, 200);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/projects/create", name="create_project")
     */
    public function store(Request $request)
    {
        if ($request->request->has('name')) {

            $name = $request->request->get('name');

            $project = new Project();

            $project->setUser($this->getUser());
            $project->setName($name);
            $project->setCreatedAt(new DateTime());
            $project->setUpdatedAt(new DateTime());

            $this->updateDatabase($project);

            return new Response($project, Response::HTTP_OK);

        }

        return new Response('Error', Response::HTTP_NOT_FOUND);

    }

    function updateDatabase($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }
}
