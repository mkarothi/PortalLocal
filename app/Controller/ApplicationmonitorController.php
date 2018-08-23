<?php

// App::uses('AppController', 'Controller');
class ApplicationmonitorController extends AppController {
	var $uses = array();

	function beforeFilter(){
		$this->layout = "applicationmonitor";
	}
	
	function index(){
		$this->loadModel('ApplicationMonitoringStatus');
		
		$jobResultData = $this->ApplicationMonitoringStatus->find('all', array("conditions" => array('ApplicationMonitoringStatus.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 24 HOUR) ' ), 
																	   "order" => "Latest_Check_Time desc" ) );
		$this->set('jobResultData',  $jobResultData);
		
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'ApplicationMonitoringStatus');
		}
		
	}
	
	function appconfigurations(){
		$this->loadModel('ApplicationMonitoringConfig');
		$jobResultData = $this->ApplicationMonitoringConfig->find('all'); //, array("order" => "Created_On desc" )
		$this->set('jobResultData',  $jobResultData);
		
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'ApplicationMonitoringConfig');
		}
	}
	
	function restartserver($configID){
		$this->autoRender = false;
	   $this->log("restartserver Start");
	   try{
          exec("<FILE_WITH_PATH> " .$configID );
		  $result['status'] = 1;
		  $result['message'] = "Restart initiated";
       } catch(Exception $e){
   		  $result['status'] = 0;
		  $result['message'] = $e->getMessage();
          $this->log("restartserver has error - ". $e->getMessage());
       }
	   echo json_encode($result);
	   exit;
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
	  
}
?>
