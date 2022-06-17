<?php

namespace App\Controller;

use App\Entity\Candidates;
use App\Entity\CandidateExperiences;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form;
use Doctrine\ORM\EntityRepository;
use App\Services\FmaServProcessing;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Models\CandidateModel as CandModel;

class CandidateController extends BaseController
{

    public function __construct(AuthenticationUtils $authenticationUtils , ManagerRegistry $registry , RequestStack $request){
                parent::__construct($authenticationUtils,$registry,$request);
    }

    #[Route('/candidate', name: 'app_candidate')]
    public function index(): Response
    {
        return $this->render('candidate/index.html.twig', [
            'controller_name' => 'CandidateController',
        ]);

    }

    #[Route('/downloadCV',name:'candidate_cv')]
    public function downloadCv(Request $request):Response{
          $ViewBagInit = array();
          $ViewBagInit['downloadCV'] = 'downloadCV';
          $candGuid = self::CAND_GUID;
          $candidate = CandModel::getCandidate($candGuid);
          if(!empty($candidate) && $candidate->CandidateImage != null){
                $candImage = $candidate->CandidateImage;
                $BuildUrl = dirname(__FILE__, 2) .'\Content\\CV\\'.$candImage;
                if(file_exists($BuildUrl)){
                $response = new Response();
                $fileContent = file_get_contents($BuildUrl);
                $response->setContent($fileContent);
                $response->headers->set('Content-Type','application/pdf');
                return $response;
            }
          }
          return $this->redirect('/');
    }

    public function GenerateCV(Request $request):Response{
        return  new Response();
    }

    /**
     * @Route("/proexperiences", name="cand_experiences")
     *
     */
    public function GetProExperiences(){
        $experiences = CandidateExperiences::GetCandidateProExperiencesList(748);
        $candidate = new Candidate();
        $candidate->FullName = 'Mr YESSOUFOU MOHAMED';
        return $this->render('Candidate/experiences.html.twig',
        [
            'candidate'=>$candidate,
            'experiences'=>$experiences
        ]);
    }


    /**
     * @Route("/creerExperienceGET", name="experience_GET")
     * @Method("GET")
     */
    public function InsertionExperiences_GET(Request $request):Response{
       /*  $ViewBagInit = array();
        $ViewBagInit['ActionName'] = 'InsertionExperiences';
        $ViewBagInit['FormActionName'] = '/creerExperiencePOST';
        $ViewBagInit['FormName'] = 'ProExperiencesForm';
        $ViewBagInit['Method'] = 'GET';
        $model = new CandidateExperiences();
        $ViewBagForm = $this->createFormBuilder($model,array(
            'attr' =>array('action'=>'/creerExperiencePOST'
            ,'name'=>'ProExperiencesForm','novalidate'=>'novalidate')
            )
        )->add('PassWord',RepeatedType::class,array(
            'type'=>PasswordType::class,
            'attr'=>array('max_length'=>10,'class'=>'mp'),
            'first_options'=>array('label'=>'Mot de passe',),
            'second_options'=>array('label'=>'Confirmer Mot de passe')
        ))->add('Title',TextType::class)->add('Description',TextareaType::class)
           ->add('soumettre',SubmitType::class)->getForm()->createView();

        $ViewBagInit['ViewForm'] = $ViewBagForm;

        return $this->render('Candidate/createExperiences.html.twig',[
            'ViewBag'=>$ViewBagInit
        ]); */
        return new Response('Bonjour');
    }

    /**
     * @Route("/creerExperiencePOST", name="experience_POST")
     * @Method("POST")
     */
    public function InsertionExperiences_POST(Request $request):Response{

       /*  if($request->isMethod('GET'))
            return $this->redirect('/creerExperienceGET',301);
        $model = new CandidateExperiences();
        $form = $this->createFormBuilder($model,array(
                'attr' =>array('action'=>'/creerExperiencePOST'
                ,'name'=>'ProExperiencesForm','novalidate'=>'novalidate')
            )
        )->add('PassWord',RepeatedType::class,array(
            'type'=>PasswordType::class,
            'attr'=>array('max_length'=>10,'class'=>'mp'),
            'first_options'=>array('label'=>'Mot de passe'),
            'second_options'=>array('label'=>'Confirmer Mot de passe')
        ))->add('Title',TextType::class)->add('Description',TextareaType::class)
            ->add('soumettre',SubmitType::class)->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()){
           $donnees = $form->getData();
           dd($donnees);
        }
        return new Response('Bonjour'); */
    }

    /**
     * @param Response $request
     * @param int $candidateID
     * @return Response
     * Retourne la liste des Expériences professionnelles du candidat X
     */

    public function RoomsExperiences(Response $request, int $candidateID){
        $ViewBagInit = array();
        $ViewBagInit['ActionName'] = 'RoomsExperiences';
        return $this->render('Candidate/RoomsExperiences.html.twig',[
            'ViewBag'=>$ViewBagInit
        ]);
    }

    /**
     * @param Request $request
     * @param int $candidateID
     * @return Response
     * Retourne la liste des Compétences du candidat X
     */
    public function RoomsSkills(Request $request, int $candidateID){
        $ViewBagInit = array();
        $ViewBagInit['ActionName'] = 'RoomsExperiences';
        return $this->render('Candidate/RoomsExperiences.html.twig',[
            'ViewBag'=>$ViewBagInit
        ]);
    }
}
