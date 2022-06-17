<?php
namespace App\Domains\FmaDomBusiness\Candidates;

class Career{

    public $CareerID;
    public $CandidateID;
    public $PositionSought;
    public $PositionID;
    public $Objective;
    public $NoticePeriod;
    public $EmploymentType;
    public $EmploymentStatus;
    public $Salary;
    public $SalaryPeriod;
    public $SalaryCurrency;
    public $Executive;
    public $Note;


      public function __construct($candidateID,$positionSought,$objective, $positionID, $noticePeriod, $employmentType, $employmentStatus,$salary,$salaryPeriod,$salaryCurrency,
        $executive,$note){

            $this->CareerID = 345;
            $this->CandidateID = $candidateID;
            $this->PositionSought = $positionSought;
            $this->Objective = $objective;
            $this->PositionID = $positionID;
            $this->NoticePeriod = $noticePeriod;
            $this->EmploymentType = $employmentType;
            $this->EmploymentStatus = $employmentStatus;
            $this->Salary = $salary;
            $this->SalaryPeriod = $salaryPeriod;
            $this->SalaryCurrency = $salaryCurrency;
            $this->Executive = $executive;
            $this->Note = $note;
        }
}