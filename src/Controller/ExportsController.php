<?php

namespace App\Controller;


use App\Entity\Export;
use App\Form\ExportFilterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        //getForm Object
        $form = $this->createForm(ExportFilterType::class);
        return $this->render('exports/index.html.twig', [
            'exports' => $data,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/exports", name="exports.post"), methods="POST")
     */
    public function indexPostAction(ManagerRegistry $doctrine, Request $request): Response{
        $form = $this->createForm(ExportFilterType::class);
        //this is a POST Query, recieving Data from form
        $form ->handleRequest($request);

        $entityManager = $doctrine->getManager();
        //we need Export repository to find export data according to form parametres
        $exports = $entityManager->getRepository(Export::class);


        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            //recieving data from database according to form parametres
            $out = $exports->findUsingFormFilterData($task);

        }

        return $this->render('exports/index.html.twig', [
            'form' =>$form->createView(),
            'exports'=>$out
        ]);
    }
}
