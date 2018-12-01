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

	function editbatchgoalexceptions($jobEntry = ''){
		$this->layout = false;
		$statusUpdated = false;
		$this->loadModel('BatchGoalStatusData');
		$conditions = array('BatchGoalStatusData.Job_Entry' => $_REQUEST['jobEntry']);
		$jobResultData = $this->BatchGoalStatusData->find('first', array("conditions" => $conditions, "order" => "Latest_Check_Time desc" ) );
		$this->loadModel('BatchGoalExceptions');
		$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.Job_Entry' => $_REQUEST['jobEntry'])) );
		debug($this->data);
		if(!empty($this->data)){
			
			$this->BatchGoalExceptions->Job_Entry = $jobResultData['BatchGoalStatusData']['Job_Entry'];
			
			$batchJobStatusDetails['Job_Latest_Status'] = "'".ucfirst($this->data['Ops']['action'])."'";
			
			#$batchJobStatusDetails['Job_Status_Comments'] = "'". $jobResultData['BatchGoalStatusData']['Job_Status_Comments'];
			/* $batchJobStatusDetails['Job_Status_Comments'] = "'";
			if($this->data['Ops']['who_requested']){
				$batchJobStatusDetails['Job_Status_Comments'] .= ", \n Who Requested: " . $this->data['Ops']['who_requested'];
			}
			if($this->data['Ops']['ignore_time']){
				$batchJobStatusDetails['Job_Status_Comments'] .= ", \n Ignore Duration: " . $this->data['Ops']['ignore_time'];
			}
			if($this->data['Ops']['why']){
				$batchJobStatusDetails['Job_Status_Comments'] .= ", \n Why: " . $this->data['Ops']['why'];
			}
			$batchJobStatusDetails['Job_Status_Comments'] .= "'";
			$batchJobStatusDetails['Job_Actual_End_Time'] = " NOW() ";
			*/
			if($this->data['Ops']['action'] != 'ignore'){

				$this->loadModel('BatchGoalStatusData');
				$this->BatchGoalExceptions->id = NULL;
				$reworkDetails['Job_Entry'] = $jobResultData['BatchGoalStatusData']['Job_Entry'];
				$reworkDetails['Engineer_Name'] = $this->data['updated_by'];
				$reworkDetails['Rework_Type'] = $this->data['Ops']['action'];
				$this->BatchGoalExceptions->save($reworkDetails);

				// Write the script to invoke
				// exec(" <COMMAND> " .$requestId . " " .$appName . " ".$action );
			}
		}
		$this->set("statusUpdated", $statusUpdated);
		$this->set('jobEntry',  $_REQUEST['jobEntry']);
		$this->set('jobResultData',  $jobResultData);
	}
	
	
  
}

?>