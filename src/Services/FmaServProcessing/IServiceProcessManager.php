<?php

namespace App\Services\FmaServProcessing;
use App\Services\FmaServBusiness\Candidates\ICandidateService;
use App\Services\FmaServSecurity\Identity\IdentityService;

interface IServiceProcessManager
{
    public function ICandService():ICandidateService;
    public function IDService():IdentityService;
}
