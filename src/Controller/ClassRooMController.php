<?php

namespace App\Controller;

use App\Entity\ClassRooM;
use App\Form\ClassRooMType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ClassRooMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClassRooMController extends AbstractController
{
    #[Route('/class/roo/m', name: 'app_class_roo_m')]
    public function index(): Response
    {
        return $this->render('class_roo_m/index.html.twig', [
            'controller_name' => 'ClassRooMController',
        ]);
    }

    #[Route('/addClassroomForm', name: 'addClassroomForm')]
    public function addClassroomForm(Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= new  ClassRooM();
        $form= $this->createForm(ClassRooMType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->persist($classroom);
            $em->flush();
            return  $this->redirectToRoute("addClassroomForm");
        }
        return $this->renderForm("class_roo_m/add.html.twig",array("FormClassroom"=>$form));
    }
    #[Route('/update/{id}', name: 'update_classroom')]
    public function updateclassroom($id,ClassRooMRepository  $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= $repository->find($id);
        $form= $this->createForm(ClassRooMType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("addClassroomForm");
        }
        return $this->renderForm("class_roo_m/update.html.twig",array("FormClassroom"=>$form));
    }
    #[Route('/remove/{id}', name: 'remove_classroom')]
    public function removeclassroom(ManagerRegistry $doctrine,$id,ClassRooMRepository $repository)
    {
        $classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("addClassroomForm");
    }
    #[Route('/listClassroom', name: 'listclassroom')]
    public function listclassroom(ClassRooMRepository  $repository)
    {
        $classroom= $repository->findAll();
        return $this->render("class_roo_m/list.html.twig",array("tabClassroom"=>$classroom));
    }
}
