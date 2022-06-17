<?php

namespace App\Services\FmaServProcessing;
use App\Services\FmaServBusiness\Candidates\CandidateService;
use App\Services\FmaServBusiness\Candidates\ICandidateService;
use Doctrine\Persistence\ManagerRegistry;
use App\Services\FmaServSecurity\Identity\IIdentityService;
use Fma\Dom\Security\Identity\ConnectedUser;
use App\Services\FmaServSecurity\Identity\IdentityService;

class ServiceProcessManager implements IServiceProcessManager
{
    private $_instanceICandidateService;
    private $_instanceIDService;
    private $_registry;

    private $ConnectedUser;
    public $userName;

    public function __construct($user, ManagerRegistry $registry){
        $userName = '';
        $this->_registry = $registry;
        if($user instanceof  ConnectedUser && !empty($user->IdentifierEmail) && $user->IdentifierEmail != null)
            $this->userName = $user->IdentifierEmail;
    }

    public function IDService():IdentityService{
        if(is_null($this->_instanceIDService))
            $this->_instanceIDService =  IdentityService::getInstance($this->_registry);
        return $this->_instanceIDService;

    }

    public function ICandService():ICandidateService{
        if(is_null($this->_instanceICandidateService))
            $this->_instanceICandidateService = CandidateService::getInstance($this->_registry);
        return $this->_instanceICandidateService;
    }

}
