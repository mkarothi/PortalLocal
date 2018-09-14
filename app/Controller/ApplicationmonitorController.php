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
		$jobResultData = array();
		$this->loadModel('ApplicationMonitoringConfig');
		$conditions = array();
		if(!empty($this->data)){
			if($this->data['Appconfigurations']['applicationfamily']){
				$conditions["Application_Family"] = $this->data['Appconfigurations']['applicationfamily'];
			}
			if($this->data['Appconfigurations']['applicationname']){
				$conditions["Application_Name"] = $this->data['Appconfigurations']['applicationname'];
			}
			if($this->data['Appconfigurations']['environment']){
				$conditions["Server_Role"] = $this->data['Appconfigurations']['environment'];
			}
			$jobResultData = $this->ApplicationMonitoringConfig->find('all', array("conditions" => $conditions) ); //, array("order" => "Created_On desc" )
			
			$this->set('fromSearch',  1);
		}else{
			$this->set('fromSearch',  0);
		}
		$this->set('jobResultData',  $jobResultData);

		
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'ApplicationMonitoringConfig');
		}
	}
	
	function restartserver($configID,$isProd){
		$this->autoRender = false;
	   $this->log("restartserver Start");
	   try{
		   if($isProd){
			   exec("<FILE_WITH_PATH> " .$configID );
		   }else{
			   exec("<FILE_WITH_PATH> " .$configID );
		   }
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
