<?php

namespace App\Controller;

use App\Entity\Export;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportsController extends AbstractController
{
    /**
     * @Route("/exports", name="exports", methods="GET")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        //get Exports Repository
        $entityManager = $doctrine->getManager();
        $exports = $entityManager->getRepository(Export::class);
        //get All Data
        $data = $exports->findAll();

        return $this->render('exports/index.html.twig', [
            'exports' => $data,
        ]);
    }
}
