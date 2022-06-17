<?php

namespace App\Services\FmaServProcessing;
use App\Services\FmaServBusiness\Catalogs\ICatalogService;
use App\Services\FmaServBusiness\Sellers\SellerService;
use App\Services\FmaServProcessing\IServiceProcessManager;
use App\Fma\Dom\Security\Identity\ConnectedUser;
use Doctrine\Persistence\ManagerRegistry;


class ProcessExecution
{
    private static  $_instance = null;
    private $userAccount;
    public $_serviceProcessManager;
    private $registry;


    protected function __construct($userAccount,ManagerRegistry $registry){
        $this->userAccount = $userAccount;
        $this->registry = $registry;
        $this->_serviceProcessManager = new ServiceProcessManager($userAccount,$registry);
    }
   /* protected function __clone(){}
    protected function __wakeup(){
        throw new \Exception('Impossible de désérialiser un singleton');
    }*/

    public static function getInstance($user,ManagerRegistry $registry):ProcessExecution{
        if(is_null(self::$_instance)){
            self::$_instance = new ProcessExecution($user,$registry);
        }
        return self::$_instance;
    }

    public function ServiceManager(){
        return $this->_serviceProcessManager;
    }
}
