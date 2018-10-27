<?php

App::uses('AppController', 'Controller');
class BatchgoalsController extends AppController {
	
	// var $uses = array();
	
	function beforeFilter(){
		$this->layout = "batchgoals";
	}
	
	function index(){
		$this->loadModel('BatchGoalStatusData');
		
		$conditions = array();
		
		if(isset($_POST['days']) && $_POST['days'] == 7){
			// $conditions = array('BatchGoalStatusData.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 7 DAY) ' );
		}
		
		$batchGoalResultData = $this->BatchGoalStatusData->find('all', array("conditions" => $conditions) );

		$this->set('batchGoalResultData',  $batchGoalResultData);
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($batchGoalResultData, 'BatchGoalSchedule');
		}
	}

	function batchgoalschedule(){
		$this->loadModel('BatchGoalSchedule');
		
		$conditions = array();
		
		if(isset($_POST['days']) && $_POST['days'] == 7){
			// $conditions = array('BatchGoalSchedule.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 7 DAY) ' );
		}
		
		$batchGoalResultData = $this->BatchGoalSchedule->find('all', array("conditions" => $conditions) );

		$this->set('batchGoalResultData',  $batchGoalResultData);
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($batchGoalResultData, 'BatchGoalSchedule');
		}
	}
	
	
  
}

?>