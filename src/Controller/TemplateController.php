<?php

namespace App\Controller;
use App\Controller\BaseController;
use App\Entity\TempTemplate;
use App\Kernel;
use App\Models\CandidateExperiencesModel;
use App\Models\EducationModel;
use App\Models\SkillModel;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use mikehaertl\wkhtmlto\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Models\TemplateModel;
use App\Models\CandidateModel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;
use Knp\Snappy\Image as ImageConfig;
use Knp\Snappy\Pdf as PdfConfig;
use Doctrine\DBAL\DriverManager;
use Dompdf\Dompdf;


class TemplateController extends BaseController
{

    private $Twig;
    private $pdfConfig;

    public function __construct(Environment $twig ,PdfConfig $pdfConfig, AuthenticationUtils $authenticationUtils , ManagerRegistry $registry , RequestStack $request){
        parent::__construct($authenticationUtils,$registry,$request);
        $this->Twig = $twig;
        $this->pdfConfig = $pdfConfig;
     }

     #[Route('/getTemplate',name: 'get_template')]
     public function  GetTemplate(Request $request):Response{
      try{
          $tempGuid = $request->get('tempGuid');
          $template = TemplateModel::GetTemplate($tempGuid);

          $templateRenderViewUrl = 'template/'.$template->Reference.'.html.twig';
          $candidate = CandidateModel::getCandidate(self::CAND_GUID);
          $url = $this->generateUrl('get_template',['tempGuid'=>$template->TemplateGuid]);
          if(!$this->Twig->getLoader()->exists($templateRenderViewUrl)){
              return new Response('Template Introuvable');
          }
          if($request->isXmlHttpRequest())
              return $this->json(['template'=>$template,'url'=>$url]);
          $html =  $this->render($templateRenderViewUrl,['candidate'=>$candidate]);

      }catch (\Exception $e){
          var_dump($e);
          exit(0);
          return $this->createNotFoundException('Template Introuvable');
      }

        return new Response($html);
     }

     // FMA-SOFT YESSOUFOU MOHAMED-Genère un CV
     #[Route('/generateTempl', name: 'genere_template')]
     public  function  generateCv(Request $request,ManagerRegistry $registry):Response
     {
         $data = $request->get('dataView');
         $jsonDecode = json_decode($data);
         $candidateModel = $jsonDecode->CandidateModel;
         $experienceList = $jsonDecode->experiences;
         $skillsList = $jsonDecode->skills;
         $educationList = $jsonDecode->educations;
         $colorChoose = $jsonDecode->Color;
         $templateChooseGuid = $jsonDecode->templateChoose;
         $em = $this->get('doctrine')->getManager();
         $allSavedSuccessFull = false;

         try {
             if (!empty($candidateModel) && count($experienceList) >= 1 && count($skillsList) >= 1 && count($educationList) >= 1 && !empty($templateChooseGuid)) {
                 $template = TemplateModel::GetTemplate($templateChooseGuid);
                 if (empty($template))
                     throw new \Exception('Template Inexistant');
                 $candidateReference = CandidateModel::GetNewCandidateReference();
                 $newCandidate = new CandidateModel(
                     $candidateReference,$candidateModel->citivity,$candidateModel->firstname,$candidateModel->lastname,$candidateModel->middlename,
                     date('Y-m-d',strtotime($candidateModel->dateOfBirth)),$candidateModel->nationality,$candidateModel->countryID,$candidateModel->town,
                     '','CELIBATAIRE',$candidateModel->location,'',$candidateModel->phoneNumber,
                     '','',TRUE,TRUE,'','',0,$candidateModel->emailAddress,
                     $candidateModel->fonction,addslashes($candidateModel->resume),TRUE,NULL
                 );
                 if(CandidateModel::saveCandidate($newCandidate)){

                     foreach ($experienceList as $experience) {

                         $newExperienceRef = CandidateExperiencesModel::GetNewExpereinceReference();
                         $newExperience = new CandidateExperiencesModel($newExperienceRef, addslashes($experience->poste), addslashes($experience->postDescritp)
                             , $experience->companie, $experience->startDate, $experience->endDate, 0, $experience->location);
                         CandidateExperiencesModel::saveExperience($newExperience, $candidateReference);
                     }
                     foreach ($skillsList as $skill) {
                         $newSkillRef = SkillModel::GetNewSkillReference();
                         $newSkill = new SkillModel($newSkillRef,addslashes($skill->title), addslashes($skill->description), 0, $skill->yearExperience, '...');
                         SkillModel::saveSkillModel($newSkill, $candidateReference);
                     }
                     foreach ($educationList as $educ) {
                         $newEducRef = EducationModel::GetNewEducationReference();
                         $newEducation = new EducationModel($newEducRef,addslashes($educ->title), addslashes($educ->description), $educ->startDate, $educ->endDate, $educ->institut, '', 0,0,'BJ','','','');
                         EducationModel::saveEducation($newEducation, $candidateReference);
                     }
                     $tempReference = TemplateModel::GetNewTmpTempReference();
                     $newGuid = TemplateModel::InsertUpdateTmpTemp($tempReference,$template->TemplateGuid,$candidateReference,$colorChoose,FALSE,NULL,'@_GUID');
                     $buildUrl = $this->generateUrl('preview_template', ['tempGuid' => $newGuid]);
                     return $this->json(['urlView' => $buildUrl,'Guid'=> $newGuid], 200);
                 }
             } else {
                 throw new \Exception('Données incomplète.');
             }
         } catch (\Exception $e) {
             throw $e;
         }
         return new Response('');
     }
    #[Route('/createTemplate', name: 'add_template')]
    public function CreateTemplate(Request $request):Response{
        return new Response();
    }

    #[Route('/updateTemplate', name: 'update_template')]
    public function UpdateTemplate(Request $request,string $tempGuid):Response{
        return new Response();
    }

    public function DeleteTemplate(Request $request,string $tempGuid):Response{
        return new Response();
    }

    #[Route('/loadPreviewTemplate/{tempGuid}', name: 'preview_template')]
    public function loadTemplateBuildView(Request $request,$tempGuid){
        $tempValue= $tempGuid;
        $findOne = TemplateModel::GetTemplateTemp($tempValue);
        if(empty($findOne))
            return new Response('Une erreur s\'est produite');

        $candidate = CandidateModel::getCandidate($findOne['candidate_guid']);
        $template = TemplateModel::GetTemplate($findOne['TemplateGuid']);
        if(empty($candidate))
            return new Response('Une erreur s\'est produite');

        $templateRenderViewUrl = 'template/'.$template->Reference.'.html.twig';
        if(!$this->Twig->getLoader()->exists($templateRenderViewUrl)){
            return new Response('Template Introuvable');
        }
        return $this->render($templateRenderViewUrl,
        [
            'candidate'=>$candidate,
            'colorChoose'=>$findOne['Color']
        ]);
    }

    /**
     * @Route("/getPDFCV/{tempGuid}", name="pdfCV")
     */
    public function generatePDF(Request $request,$tempGuid,KernelInterface $kernel):Response{

        $pdf = new Pdf(array(
            'binary' => 'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf',
            'ignoreWarnings' => true,
            'commandOptions' => array(
                'useExec' => true,      // Can help on Windows systems
                'procEnv' => array(
                    // Check the output of 'locale -a' on your system to find supported languages
                    'LANG' => 'en_US.utf-8',
                ),
            ),
        ));
        $findOne = TemplateModel::GetTemplateTemp($tempGuid);
        if(empty($findOne))
            return new Response('Une erreur s\'est produite');

        $candidate = CandidateModel::getCandidate($findOne['candidate_guid']);
        $template = TemplateModel::GetTemplate($findOne['TemplateGuid']);
        if(empty($candidate))
            return new Response('Une erreur s\'est produite');
        $templateRenderView = $this->render('template/'.$template->Reference.'.html.twig',[
            'candidate'=>$candidate
        ]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($templateRenderView);
        $dompdf->setPaper('A4', 'P');
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setDebugCss(true);
        $dompdf->setOptions($options);
        $dompdf->setBasePath($kernel->getProjectDir().'/'.'public');
        $dompdf->render();
        return new Response($dompdf->stream());
    }


    #[Route('/buildCV',name:'cv_build')]
    public function GenerateTemplate(Request $request):Response|PdfResponse{
        $ViewBagAction = 'Générer CV';
        $ViewBagInit['Action']= $ViewBagAction;
        $success = true;
        $errors = '';
        try{
            $tempGuid = $request->get('templateID');
            $candidate = CandidateModel::getCandidate(self::CAND_GUID);
            $template = TemplateModel::GetTemplate($tempGuid);
            if(empty($template)){
                $success = false;
                $errors='Une error s\'est produite.Template Introuvable';
                return new Response($errors);
            }
            if(empty($candidate)){
                $success = false;
                $errors='Une error s\'est produite.Candidat Introuvable';
                return new Response($errors);
            }
            $loader = $this->Twig->getLoader();
            $templateRenderViewUrl = 'template/'.$template->Reference.'.html.twig';
            if(!$loader->exists($templateRenderViewUrl)){
                 $success = false;
                 $errors='Une error s\'est produite.Template Inexistant';
                 return new Response($errors);
            }
            $html =  $this->render($templateRenderViewUrl,['candidate'=>$candidate]);
            $CVFileName = $candidate->FirstName.'_CV.pdf';
            return new PdfResponse(
                $this->pdfConfig->getOutputFromHtml($html),
                $CVFileName
            );
        }catch(\Exception $e){
            throw $e;
        }
    }


    #[Route('/choices',name:'choice_template')]
    public function ChoiceTemplate(Request $request){
        $ViewBagAction = 'choices';
        $ViewBagInit = array();
        $ViewBagInit['Action'] = $ViewBagAction;
        $ViewBagInit['controller_name'] = 'TemplateController';
        $ViewBagInit['IsConnected'] = $this->ConnectedUserData != null;
        $allTemplate = TemplateModel::GetAllTemplate();
        $ViewBagInit['templates'] = $allTemplate;
        return $this->render('template/TChoices.html.twig', [
                     'ViewBagInit' => $ViewBagInit
        ]);
    }
}
