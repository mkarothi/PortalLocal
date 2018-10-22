<?php

App::uses('AppController', 'Controller');
class BatchgoalsController extends AppController {
	
	// var $uses = array();
	
	function beforeFilter(){
		$this->layout = "batchgoals";
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
	
	
  
}

?>