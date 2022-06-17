<?php

namespace App\Repositories\FmaRepIdentity;
use App\Repositories\FmaRepIdentity\StoredFunctions;
use App\Domains\FmaDomUtils;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityRepository;

class DALContainer
{
    protected  $connectionManager;

    public function __construct(){
        $this->connectionManager = DriverManager::getConnection(getenv('DATABASE_URL'));

    }
}
