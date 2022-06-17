<?php
namespace App\Models;
use App\Controller\BaseController;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Entity\CvTemplate;
use App\Repositories\FmaRepBusiness\StoredFunctions;
use Doctrine\DBAL\DriverManager;

class TemplateModel{

        public int $ID;
        public string $TemplateGuid;
        public string $TemplateName;
        public string $Description;
        public string $HtmlContent;
        public ?\DateTime $CreationDate;
        public ?\DateTime $ModificationDate;
        public ?bool  $Active;
        public string $Posted;
        public string $Reference;

    public  static function GetNewTmpTempReference(){
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        $reference = $connection->executeQuery('CALL PS_GETTMPTMPREFERENCE(@TMPTMP);');
        $reference = $connection->fetchOne('SELECT @TMPTMP;');
        return $reference;
    }

        public static function GetTemplate($templateGuid){
              if(empty($templateGuid))
                    return null;
              $registry = BaseController::getInstance()->doctrineRegistry;
              $em = $registry->getManager()->getRepository('App\Entity\CvTemplate');
              $template = $em->findOneBy([
              'TemplateGuid'=>$templateGuid]);

              if(empty($template))
                return null;
              $mTemplate = new TemplateModel();

              try{
                   $mTemplate->ID = $template->getID();
                   $mTemplate->TemplateGuid = $templateGuid;
                   $mTemplate->Posted = $template->getPosted();
                   $mTemplate->Reference = $template->getReference();
                   $mTemplate->TemplateName = $template->getTemplateName();
                   $mTemplate->Description = $template->getDescription();
                   $mTemplate->HtmlContent = $template->getHtmlContent();
                   $mTemplate->CreationDate = $template->getCreationDate();
                   $mTemplate->ModificationDate = $template->getModificationDate();
                   $mTemplate->Active = $template->getActive();
              }catch(\Exception $e){
                throw $e;
              }

              return $mTemplate;
        }

    public  static function InsertUpdateTmpTemp($Reference , $templateGuid,$candidateReference,$color,$isSaved,$accountGuid, $guid){
        $argsParams = func_get_args();
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_INSERTUPDATE_INSERTUPDATE_TMPTEMP,func_num_args(),func_get_args());
            $result = $connection->exec($functionParamsLabel);
            return $connection->fetchOne('SELECT @_GUID');

        }catch (\Exception $e) {
            throw $e;
        }
    }

    public  static function  GetTemplateTemp(string $guid){
        $argsParams = func_get_args();
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_GET_TEMPTEMPLATE,func_num_args(),func_get_args());
            $result = $connection->executeQuery($functionParamsLabel);
            return $result->fetchAssociative();
        }catch (\Exception $e) {
            throw $e;
        }
    }

        public static function GetAllTemplate(){
         $allTemplate = array();
         $registry = BaseController::getInstance()->doctrineRegistry;
         $em = $registry->getManager()->getRepository('App\Entity\CvTemplate');
         $queryResult = $em->findAll();
            //$queryResult = $em->createQueryBuilder('t')->andWhere('t.Active = :active')->setParameter('active', true)->getQuery()->getResult();
        if(empty($queryResult))
            return $allTemplate;
        try{
            foreach($queryResult as $template){
                $mTemplate = new TemplateModel();
                $mTemplate->ID = $template->getID();
                $mTemplate->Posted = $template->getPosted();
                $mTemplate->TemplateGuid = $template->getTemplateGuid();
                $mTemplate->TemplateName = $template->getTemplateName();
                $mTemplate->Reference = $template->getReference();
                $mTemplate->Description = $template->getDescription();
                $mTemplate->HtmlContent = $template->getHtmlContent();
                $mTemplate->CreationDate = $template->getCreationDate();
                $mTemplate->ModificationDate = $template->getModificationDate();
                $mTemplate->Active = $template->getActive();
                $allTemplate[] = $mTemplate;
            }
        }catch(\Exception $e){
            throw $e;
            }
            return  $allTemplate;
        }

}