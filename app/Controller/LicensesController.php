<?php

App::uses('AppController', 'Controller');
class LicensesController extends AppController {
	
	// var $uses = array();
	var $helpers    = array('Session');
	function beforeFilter(){
		$this->layout = "licenses";
	}
	
	function tqcheck(){
		$this->loadModel('HostLicensesData');
		
		$conditions = array();
		
		if(isset($_POST['days']) && $_POST['days'] == 7){
			// $conditions = array('HostLicensesData.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 7 DAY) ' );
		}
		
		$batchGoalResultData = $this->HostLicensesData->find('all', array("conditions" => $conditions) );

		$this->set('batchGoalResultData',  $batchGoalResultData);
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($batchGoalResultData, 'BatchGoalSchedule');
		}
	}

	function counthistory(){

	}

	
	
  
}

?>