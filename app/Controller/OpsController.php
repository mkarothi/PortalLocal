<?php

App::uses('AppController', 'Controller');
class OpsController extends AppController {
	
	// var $uses = array();
	
	function beforeFilter(){
		$this->layout = "ops";
	}
	
	function index(){
		$this->loadModel('BatchJobsStatusData');
		
		$conditions = array('BatchJobsStatusData.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 24 HOUR) ' );
		
		if(isset($_POST['days']) && $_POST['days'] == 7){
			$conditions = array('BatchJobsStatusData.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 7 DAY) ' );
		}
		
		$jobResultData = $this->BatchJobsStatusData->find('all', array("conditions" => $conditions, 
																	   "order" => "Latest_Check_Time desc" ) );
		$this->set('jobResultData',  $jobResultData);
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'BatchJobsStatusData');
		}
	}
	
	function jobschedules(){
		$this->loadModel('BatchJobsSchedules');
		
		$jobResultData = $this->BatchJobsSchedules->find('all', array("order" => "Created_On desc" ) );
		$this->set('jobResultData',  $jobResultData);
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'BatchJobsSchedules');
		}
	}
	
	function jobreport(){
		$this->loadModel('BatchJobsStatusData');
		
		$conditions = array('BatchJobsStatusData.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 24 HOUR) ' );
		
		if(isset($_POST['days']) && $_POST['days'] == 7){
			$conditions = array('BatchJobsStatusData.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 7 DAY) ' );
		}
		
		$conditions['Job_latest_status != '] = 'Success';
		
		$jobResultData = $this->BatchJobsStatusData->find('all', array("conditions" => $conditions, 
																	   "order" => "Latest_Check_Time desc" ) );
		$this->set('jobResultData',  $jobResultData);
		
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'BatchJobsStatusData');
		}
	}
	
	function exportsheet($results, $tableName){
		$this->autoRender = FALSE;
		foreach($results[0][$tableName] as $fieldNames => $values){ 
            $header[] = $fieldNames ;
        }
        $rows[] = $header;
        foreach($results as $result) {
            $rowValues = array();
            foreach($result[$tableName] as $values) { 
                $rowValues[] = $values;
            }
            $rows[] = $rowValues;
        }
        $exportArray = $rows;
        $filename = $tableName."_".date("Y-m-d-H-i-s") .".xls";
        $this->exportresults($exportArray, $filename);
	}
	
	function editjobstatus($jobEntry = ''){
		$this->layout = false;
		$statusUpdated = false;
		$this->loadModel('BatchJobsStatusData');
		$conditions = array('BatchJobsStatusData.Job_Entry' => $_REQUEST['jobEntry']);
		$jobResultData = $this->BatchJobsStatusData->find('first', array("conditions" => $conditions, 
																	     "order" => "Latest_Check_Time desc" ) );
		if(!empty($this->data)){
			
			$this->BatchJobsStatusData->Job_Entry = $jobResultData['BatchJobsStatusData']['Job_Entry'];
			
			$batchJobStatusDetails['Job_Latest_Status'] = "'Ignore'";
			
			#$batchJobStatusDetails['Job_Status_Comments'] = "'". $jobResultData['BatchJobsStatusData']['Job_Status_Comments'];
			$batchJobStatusDetails['Job_Status_Comments'] = "'";
			if($this->data['Ops']['updated_by']){
				$batchJobStatusDetails['Job_Status_Comments'] .= "\n Updated By: " . $this->data['Ops']['updated_by'];
			}
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

			if($this->data['Ops']['action'] != 'ignore'){
				$action = $this->data['Ops']['action']; //restart onhold onice
				$jobName = $jobResultData['BatchJobsStatusData']['Job_Name'];
				$serverName = $jobResultData['BatchJobsStatusData']['Server_Name'];
				// Write the script to invoke
				// exec(" <COMMAND> " .$requestId . " " .$appName . " ".$action );
			}
			
			if($this->BatchJobsStatusData->UpdateAll($batchJobStatusDetails, $conditions)){
				$statusUpdated = true;
			}
		}
		$this->set("statusUpdated", $statusUpdated);
		$this->set('jobEntry',  $_REQUEST['jobEntry']);
		$this->set('jobResultData',  $jobResultData);
	}
  
}

?>