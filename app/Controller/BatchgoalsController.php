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
		// debug($this->data);
		// debug($batchGoalExceptionData);
		if(!empty($this->data)){
			
			$this->BatchGoalExceptions->Job_Entry = $jobResultData['BatchGoalStatusData']['Job_Entry'];
			
			$batchJobStatusDetails['Job_Latest_Status'] = "'".ucfirst($this->data['action'])."'";
			
			if($this->data['action'] != 'ignore'){

				$this->loadModel('BatchGoalStatusData');
				if($batchGoalExceptionData){
					$this->BatchGoalExceptions->id = $batchGoalExceptionData['BatchGoalExceptions']['id'];
				}else{
					$this->BatchGoalExceptions->id = NULL;
				}
				$reworkDetails['Job_Entry'] = $jobResultData['BatchGoalStatusData']['Job_Entry'];
				$reworkDetails['Engineer_Name'] = $this->data['updated_by'];
				$reworkDetails['Why_Exception'] = $this->data['why'];
				$reworkDetails['ETA'] = $this->data['eta'];
				$reworkDetails['Comment'] = $this->data['comments'];
				$reworkDetails['Rework_Type'] = $this->data['action'];
				$this->BatchGoalExceptions->save($reworkDetails);
				// Write the script to invoke
				// exec(" <COMMAND> " .$requestId . " " .$appName . " ".$action );
			}
		}
		$this->set("batchGoalExceptionData", $batchGoalExceptionData);
		$this->set("statusUpdated", $statusUpdated);
		$this->set('jobEntry',  $_REQUEST['jobEntry']);
		$this->set('jobResultData',  $jobResultData);
	}
	
	function createjiraticket($goalExceptionId){
		$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.id' => $goalExceptionId)) );

		$base64_usrpwd = base64_encode($batchGoalExceptionData['BatchGoalExceptions']['Jira_UserID'].':'.$batchGoalExceptionData['BatchGoalExceptions']['Jira_Password']);
	
		$ch = curl_init();
		#curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/rest/api/2/issue/');
		curl_setopt($ch, CURLOPT_URL, 'https://jira.dexyp.com/rest/api/2/issue/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.$base64_usrpwd)); 
		
		$arr['project'] = array( 'key' => 'DexYP Incident/Service (DEXYP)');
		$arr['summary'] = $batchGoalExceptionData['BatchGoalExceptions']['Jira_Summary'];
		$arr['description'] = $batchGoalExceptionData['BatchGoalExceptions']['Jira_Description'];
		#$arr['issuetype'] = array( 'name' => $_POST['type']);
		$arr['issuetype'] = array( 'name' => 'Incident');
		
		$json_arr['fields'] = $arr;
		
		$json_string = json_encode ($json_arr);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$json_string);
		$result = curl_exec($ch);
		curl_close($ch);

		if($result){
			$this->BatchGoalExceptions->id = $batchGoalExceptionData['BatchGoalExceptions']['id'];
			$curlResult['Jira_RequestID'] = $result;
			$this->log("goalExceptionId: " . $goalExceptionId);
			$this->log($curlResult);
			$this->BatchGoalExceptions->save($curlResult);
		}
		echo $result;
	}
	
  
}

?>