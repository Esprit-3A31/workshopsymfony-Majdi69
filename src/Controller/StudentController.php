<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use ContainerCx7yU8t\getForm_ChoiceListFactory_CachedService;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use App\Repository\ClubRepository;

class StudentController extends AbstractController
{
    #[Route('/student/{var}', name: 'app_student')]
    public function index($var)
    {
      return new Response("Pizza".$var);
    }

    #[Route('/list', name: 'app_student1')]
    public function list()
    {
        $v1="3A31";
        $v2="j13";
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony
4','Description'=>'pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
                'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));
        return $this->render("student/list.html.twig",
        array("v1"=>$v1,"v2"=>$v2,"listformation"=>$formations));
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function reservation()
    {
        return new Response("réservation!");
    }

    #[Route('/detail', name: 'app_detail')]
    public function detail()
    {
        return $this->render("student/detail.html.twig");
    }
    #[Route('/clubs', name: 'app_clubs')]
    public function listClub(ClubRepository $repository)
    {
        $clubs=$repository->findAll();
        return $this->render("student/clubs.html.twig",array('tabclubs'=>$clubs));
    }
    #[Route('/students', name: 'app_studentss')]
    public function listStudent(StudentRepository $repository)
    {
        $clubs=$repository->findAll();
        return $this->render("student/student.html.twig",array('tabstudent'=>$clubs));
    }

    #[Route('/students', name: 'app_AddStudents')]
    public function add(Student $student):Response{
        $task=new Task();
        $task->setTask('Write anything');

        $form= $this->createFormBuilder($task)
            ->add('task',TextType::class)
            ->add('DudDate',DateType::class)
            ->add('save',SubmitType::class,['lable' => 'Create Task'])
        ->getForm();
        return $this->renderForm("student/student.html.twig",['form' => $form]);

    }

}
