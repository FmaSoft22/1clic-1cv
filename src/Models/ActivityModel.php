<?php
 namespace App\Models;

class ActivityModel{
    public $ID;
    public $ExperienceID;
    public $History;

    public static function convertToActivityModel($activity){
        $resultSet = null;
        if(empty($activity))
            return null;
        if(is_array($activity)){
            $resultSet = array();
            foreach($activity as $act){
                $activityModel = new ActivityModel();
                $activityModel->ID = $act->getID();
                $activityModel->ExperienceID = $act->getExperienceID();
                $activityModel->History = $act->getHistory();
                $resultSet[] = $activityModel;
            }
    }else{
        $activityModel = new ActivityModel();
        $activityModel->ID = $act->getID();
        $activityModel->ExperienceID = $act->getExperienceID();
        $activityModel->History = $act->getHistory();
        $resultSet = $activityModel;
    }
    return $resultSet;
}

}