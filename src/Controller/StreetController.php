<?php

namespace App\Controller;


use App\Entity\Street;
use App\Form\ClassRooMType;
use App\Form\StreetType;
use App\Repository\ClassRooMRepository;
use App\Repository\StreetRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StreetController extends AbstractController
{
    #[Route('/street', name: 'app_street')]
    public function index(): Response
    {
        return $this->render('street/index.html.twig', [
            'controller_name' => 'StreetController',
        ]);
    }

    #[Route('/addStreetForm', name: 'addStreetForm')]
    public function addStreetForm(Request  $request,ManagerRegistry $doctrine)
    {
        $street= new  Street();
        $form= $this->createForm(StreetType::class,$street);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->persist($street);
            $em->flush();
            return  $this->redirectToRoute("addStreetForm");
        }
        return $this->renderForm("street/add.html.twig",array("FormStreet"=>$form));
    }

    #[Route('/updatestreet/{id}', name: 'update_street')]
    public function updatestreet($id,StreetRepository  $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $street= $repository->find($id);
        $form= $this->createForm(StreetType::class,$street);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("addStreetForm");
        }
        return $this->renderForm("street/updatestreet.html.twig",array("FormStreet"=>$form));
    }

    #[Route('/removestreet/{id}', name: 'remove_street')]
    public function removestreet(ManagerRegistry $doctrine,$id,StreetRepository $repository)
    {
        $street= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($street);
        $em->flush();
        return $this->redirectToRoute("addStreetForm");
    }
    #[Route('/listStreet', name: 'liststreet')]
    public function listclassroom(StreetRepository  $repository)
    {
        $street= $repository->findAll();
        return $this->render("street/liststreet.html.twig",array("tabStreet"=>$street));
    }
}
