<?php

App::uses('AppController', 'Controller');
class BatchgoalsController extends AppController {
	
	// var $uses = array();
	var $helpers    = array('Session');
	function beforeFilter(){
		$this->layout = "batchgoals";
		$this->__requireLogin();
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

	function editbatchgoalexceptions($jobEntry){
		$this->layout = false;
		$statusUpdated = false;
		$batchGoalScheduleData = false;
		$batchGoalId = 0;
		$this->loadModel('BatchGoalStatusData');
		$conditions = array('BatchGoalStatusData.Job_Entry' => $jobEntry);
		$jobResultData = $this->BatchGoalStatusData->find('first', array("conditions" => $conditions, "order" => "Latest_Check_Time desc" ) );
		$this->loadModel('BatchGoalExceptions');
		// debug($this->data);
		$raiseJiraTicket = false;
		// debug($batchGoalExceptionData);
		if(!empty($this->data)){
			
			$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.Job_Entry' => $jobEntry)) );
			$this->BatchGoalExceptions->Job_Entry = $jobResultData['BatchGoalStatusData']['Job_Entry'];
			
			$batchJobStatusDetails['Job_Latest_Status'] = "'".ucfirst($this->data['action'])."'";
			
			if($this->data['action'] != 'ignore'){

				$this->loadModel('BatchGoalStatusData');
				if($batchGoalExceptionData){
					$batchGoalId = $this->BatchGoalExceptions->id = $batchGoalExceptionData['BatchGoalExceptions']['id'];
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
				if(!$batchGoalId){
					$batchGoalId = $this->BatchGoalExceptions->getLastInsertID();
				}
				// Write the script to invoke
				// exec(" <COMMAND> " .$requestId . " " .$appName . " ".$action );
			}
		}
		$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.Job_Entry' => $jobEntry)) );

		if($batchGoalExceptionData){
			$this->loadModel('BatchGoalSchedule');
			$batchGoalScheduleData = $this->BatchGoalSchedule->find("first", array("conditions" => array("BatchGoalSchedule.Job_ID" => $jobEntry) ));
			// debug($batchGoalScheduleData);
		}
		$this->set("batchGoalScheduleData", $batchGoalScheduleData);
		$this->set("batchGoalExceptionData", $batchGoalExceptionData);
		$this->set("statusUpdated", $statusUpdated);
		$this->set('jobEntry', $jobEntry);
		$this->set('jobResultData',  $jobResultData);
	}
	
	function createJiraTicket($exceptionId){
		$this->autoRender = false;
		$this->loadModel('BatchGoalExceptions');
		$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.id' => $exceptionId)) );
		if(!empty($this->data)){
			$this->BatchGoalExceptions->id = $exceptionId;
			$reworkDetails['Jira_UserID'] = $this->data['jirauserid'];
			$reworkDetails['Jira_Password'] = $this->data['jirapassword'];
			$reworkDetails['Jira_Summary'] = $this->data['jirasummary'];
			$reworkDetails['Jira_Description'] = $this->data['jiradescription'];
			$reworkDetails['​Updated_Email_Copy'] = $this->data['jiradescription'];
			$this->BatchGoalExceptions->save($reworkDetails);

			if(!$batchGoalExceptionData['BatchGoalExceptions']['Jira_RequestID']){
	
				$base64_usrpwd = base64_encode($batchGoalExceptionData['BatchGoalExceptions']['Jira_UserID'].':'.$batchGoalExceptionData['BatchGoalExceptions']['Jira_Password']);
			
				$ch = curl_init();
				#curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/rest/api/2/issue/');
				curl_setopt($ch, CURLOPT_URL, 'https://jira.dexyp.com/rest/api/2/issue/');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.$base64_usrpwd)); 
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
				
				$arr['project'] = array( 'key' => 'DexYP Incident/Service (DEXYP)');
				$arr['summary'] = $batchGoalExceptionData['BatchGoalExceptions']['Jira_Summary'];
				$arr['description'] = $batchGoalExceptionData['BatchGoalExceptions']['Jira_Description'];
				#$arr['issuetype'] = array( 'name' => $_POST['type']);
				$arr['issuetype'] = array( 'name' => 'Incident');
				
				$json_arr['fields'] = $arr;
				
				$json_string = json_encode ($json_arr);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$json_string);
				$result = curl_exec($ch);
				$curlInfo = curl_getinfo($ch);
				$error = curl_error($ch);
				if($error){
					$this->log("createJiraTicket::requestUrl:error ". $error );
				}
				$this->log($curlInfo);
				curl_close($ch);
		
				if($result){
					$this->BatchGoalExceptions->id = $batchGoalExceptionData['BatchGoalExceptions']['id'];
					$curlResult['Jira_RequestID'] = $result;
					$this->log("goalExceptionId: " . $exceptionId);
					$this->log($curlResult);
					$this->BatchGoalExceptions->save($curlResult);
					$this->Session->setFlash("Ticket created succesfully.");
				}
			}else{
				$this->Session->setFlash("Ticket already submitted - " . $batchGoalExceptionData['BatchGoalExceptions']['Jira_RequestID']);
			}
		}
		$this->redirect("/batchgoals/editbatchgoalexceptions/". $batchGoalExceptionData['BatchGoalExceptions']['Job_Entry']);

	}

	function emailPreview($exceptionId) {
		$this->autoRender = false;
		$this->loadModel('BatchGoalExceptions');
		$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.id' => $exceptionId)) );
		if(!empty($this->data)){
			if($batchGoalExceptionData){
				$this->loadModel('BatchGoalSchedule');
				$batchGoalScheduleData = $this->BatchGoalSchedule->find("first", array("conditions" => array("BatchGoalSchedule.Job_ID" => $batchGoalExceptionData['BatchGoalExceptions']['Job_Entry']) ));
			}
			$final_message = $batchGoalExceptionData['BatchGoalExceptions']['​Updated_Email_Copy'] ; //"Mr./Mrs.  $username (Phone Number : $phone) has an inquiry about portal for the page : $websiteURL \n \n $message \n"; 
			$email = $to= 'SatyaMurthy.Karothi@dexmedia.com';
			$subject = $batchGoalScheduleData['BatchGoalSchedule']['Job_ID'] . "is in < Status > now, and Expected to finish in " . $batchGoalExceptionData['BatchGoalExceptions']['ETA'];
			$headers =  'CC: ' . $email . "\r\n";
					'Reply-To: SatyaMurthy.Karothi@dexmedia.com'. "\r\n"; 
					'Mime-Version: 1.0' . "\r\n";
					'Content-type: text/hotml; charset=iso-8859-1' . "\r\n";
					'X-Mailer: PHP/' . phpversion();
			if(mail($to, $subject, $final_message, $headers)){
				$this->Session->setFlash("Email Message sent successfully !");
			} else {
				$emailSuccess = false;
				$this->Session->setFlash("Email Message sent Failed!. Please try again.");
			}
		}
		$this->redirect("/batchgoals/editbatchgoalexceptions/". $batchGoalExceptionData['BatchGoalExceptions']['Job_Entry']);
	}

	function updateEmailCopy($exceptionId) {
		$this->autoRender = false;
		$this->loadModel('BatchGoalExceptions');
		$batchGoalExceptionData = $this->BatchGoalExceptions->find('first', array("conditions" => array('BatchGoalExceptions.id' => $exceptionId)) );
		if(!empty($this->data)){
			if($batchGoalExceptionData){
				$this->BatchGoalExceptions->id = $exceptionId;
				$updatedCopy['​Updated_Email_Copy'] = $this->data['value'];
				if($this->BatchGoalExceptions->save($updatedCopy)){
					echo $this->data['value'];
				}
			}
		}
	}
	
  
}

?>