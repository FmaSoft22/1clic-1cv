<?php

namespace App\Controller;
use App\Common\ClsCommonWeb;
use App\Entity\Account\Memberships;
use App\Controller\BaseController;
use App\Models\CandidateModel;
use Doctrine\DBAL\Driver\Exception;
use Knp\Snappy\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\FmaServProcessing\ProcessExecution;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Models\CandidateExperiencesModel;
use App\Models\TemplateModel;
use App\Entity\CvTemplate;
use App\Entity\Candidates;
use Twig\Environment;
use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Image as ImageConfig;
use Knp\Snappy\Pdf as PdfConfig;
use App\Models\ColorTemplateModel;
use mikehaertl\wkhtmlto\Pdf;


class GlobalController extends BaseController
{
     private PdfConfig $pdfConfig;
     private ImageConfig  $imageConfig;

     public function __construct(PdfConfig $pdfConfig, ImageConfig $imageCongif, AuthenticationUtils $authenticationUtils , ManagerRegistry $registry , RequestStack $request){
            parent::__construct($authenticationUtils,$registry,$request);
            $this->pdfConfig = $pdfConfig;
            $this->imageConfig = $imageCongif;
     }

    /**
     * @Route("/", name="app_global")
     */
    public function index(UserPasswordEncoderInterface $encoder , Request $request): Response|PdfResponse
    {
       $memberships = new Memberships();
       $experiences = CandidateExperiencesModel::getAllCandidateExperience('');
       $ViewData['experiences'] = $experiences;
       $candidate = CandidateModel::getCandidate(self::CAND_GUID);
       $html = $this->renderView('template/REF871636.html.twig',[
           'candidate'=>$candidate
       ]);
       $ViewData['Action'] = 'index';
       $ViewData['Controller']='GlobalController';
    $templates = TemplateModel::GetAllTemplate();
    $curTempGuid = $templates[0]->TemplateGuid;
    $ViewData['TemplateList'] = $templates;
       return new Response($this->renderView('global/index.html.twig',
       [
           'ViewData'=>$ViewData,
           'candidate'=>$candidate,
           'curTempGuid'=>''
       ]));
      // return new Response($html);
       /*$cvFileName= $candidate->FirstName.'_CV.pdf';
       return new PdfResponse(
             $this->pdfConfig->getOutputFromHtml($html),
           $cvFileName);*/
    }

    /**
     * @Route("/webContact", name="web_contact")
     */
    public function WebContact(Request $request):Response{
        $ViewData['Action'] = 'WebContact';
        $ViewData['Controller']='GlobalController';

        return new Response($this->renderView('global/web-contact.html.twig',
        [
            'ViewData'=>$ViewData,
            'curTempGuid'=>''
        ]));
    }



    /**
     * @Route("/generate", name="generate_cv")
     */
    public  function  generateCv():Response{
        $ViewData['Action'] = 'generateCv';
        $ViewData['Controller']='GlobalController';
        $Colors = ColorTemplateModel::getColorList();
        $templates = [];
        try{
            $templates = TemplateModel::GetAllTemplate();
            $curTempGuid = $templates[0]->TemplateGuid;
            $ViewData['ColorList'] = $Colors;
            $ViewData['TemplateList'] = $templates;
        }catch (\Exception $e){}
        return new Response($this->renderView('global/generate.html.twig',
        [
            'ViewData'=>$ViewData,
            'curTempGuid'=>$curTempGuid
        ]));
    }
}
