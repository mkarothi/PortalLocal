<?php

App::uses('AppController', 'Controller');
class SamplesController extends AppController {
	var $components = array('Batchemail');

	function beforeFilter(){
		$this->layout = "samples";
	}
	
	function testemail(){
		echo $this->Batchemail->doComplexOperation(1,3);
	}
	
	function appconfigurations(){
		// $this->loadModel('ApplicationMonitoringStatus');
		$this->loadModel('ApplicationMonitoringConfig');
		// $optionsArray['fields'] = array('Application_Family', 'Application_Name', 'Environment', 'Server_Name', 'Server_Role', 'SW_Running', 'Instance_Name', 'Account', 'Keep_Alive_URL', 'Restart_Script', 'DL_EMAILS', 'Deployment_File');
		$optionsArray['limit'] = 150;
		$jobResultData = $this->ApplicationMonitoringConfig->find('all', $optionsArray );

		// , array("conditions" => array('ApplicationMonitoringConfig.Latest_Check_Time > DATE_SUB(NOW(), INTERVAL 24 HOUR) ' ), 
																	   // "order" => "Latest_Check_Time desc" )
		$this->set('jobResultData',  $jobResultData);
		
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'ApplicationMonitoringConfig');
		}
	}

	function verifydeployment($requestId = ""){
		$jobResultData 	= array();
		$conditions 	= array();
		$deploymentRequests = array();
		$this->loadModel('ApplicationDeploymentfileStatus');
		if(!empty($this->data)){
			$this->loadModel('ApplicationMonitoringConfig');
			if($this->data['Appconfigurations']['applicationfamily']){
				$conditions["Application_Family"] = $this->data['Appconfigurations']['applicationfamily'];
			}
			if($this->data['Appconfigurations']['applicationname']){
				$conditions["Application_Name"] = $this->data['Appconfigurations']['applicationname'];
			}
			if($this->data['Appconfigurations']['environment']){
				$conditions["Environment"] = $this->data['Appconfigurations']['environment'];
			}
			$jobResultData = $this->ApplicationMonitoringConfig->find('all', array("conditions" => $conditions) ); //, array("order" => "Created_On desc" )
			
			if($jobResultData){
				$requestId = time();
				foreach($jobResultData as $jobResult){
					$deploymentdetails['Application_Name'] = $jobResult['ApplicationMonitoringConfig']['Application_Name'];
					$deploymentdetails['Environment'] = $jobResult['ApplicationMonitoringConfig']['Environment'];
					$deploymentdetails['Server_Name'] = $jobResult['ApplicationMonitoringConfig']['Server_Name'];
					$deploymentdetails['Instance_Name'] = $jobResult['ApplicationMonitoringConfig']['Instance_Name'];
					$deploymentdetails['Deployment_File'] = $jobResult['ApplicationMonitoringConfig']['Deployment_File'];
					$deploymentdetails['Request_ID'] = $requestId;
					$this->ApplicationDeploymentfileStatus->save($deploymentdetails);
				}
				$this->set("requestId", $requestId);

				#$deploymentRequests = $this->ApplicationDeploymentfileStatus->find("all", array("conditions" => array("Request_ID" => $requestId)));

				$appName= $jobResult['ApplicationMonitoringConfig']['Application_Name'];
				$env = $jobResult['ApplicationMonitoringConfig']['Environment'];
				if(strrpos($env, "prod") !== false){
					// Prod environment
					exec("echo y | C:\\PSTools\\plink.exe -pw cat34968 ssatomcat@158.95.121.32 /spfs/tomcat/Automation_Work/Traige-Automation/bin/VerifyDeploymentFile.pl " .$requestId . " " .$appName . " ".$env );
				}else{
					// Other environments
					 exec("echo y | C:\\PSTools\\plink.exe -pw cat34968 ssatomcat@158.95.121.30 /spfs/tomcat/Automation_Work/Traige-Automation/bin/VerifyDeploymentFile.pl " .$requestId . " " .$appName . " ".$env );
				}
				sleep(5);
				$deploymentRequests = $this->ApplicationDeploymentfileStatus->find("all", array("conditions" => array("Request_ID" => $requestId)));
			} else{
				$this->set('noResults',  1);
			}
			$this->set('fromSearch',  1);
		}else{
			if($requestId){
				$deploymnetOptions["conditions"] = array("Request_ID" => $requestId);
			}else{
				$deploymnetOptions["group"] = "Request_ID DESC";
				$deploymnetOptions["limit"] = 20;
				$deploymnetOptions["fields"] = array("Request_ID", "Application_Name", "Environment", "Validated_On");
			}
			$deploymentRequests = $this->ApplicationDeploymentfileStatus->find("all", $deploymnetOptions );
			$this->set('fromSearch',  0);
		}
		$this->set('jobResultData',  $jobResultData);
		$this->set("deploymentRequests", $deploymentRequests);
		
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($jobResultData, 'ApplicationMonitoringConfig');
		}
	}
	
	function restartserver($configID,$isProd){
		$this->autoRender = false;
	   	$this->log("restartserver Start");
	   	try{
		   if($isProd){
			   exec("echo y | C:\\PSTools\\plink.exe -pw cat34968 ssatomcat@158.95.121.32 /spfs/tomcat/Automation_Work/Traige-Automation/bin/RestartInstance.pl " .$configID );
		   }else{
			   exec("echo y | C:\\PSTools\\plink.exe -pw cat34968 ssatomcat@158.95.121.30 /spfs/tomcat/Automation_Work/Traige-Automation/bin/RestartInstance.pl " .$configID );
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

	function updatestatus($applicationFamily, $applicationName, $environment){
		$this->autoRender = false;
		$this->log("updatestatus Start");
		
		// $applicationFamily - default value is 0
		// $applicationName - default value is 0
		// $environment - default value is 0

		try{
			exec("echo y | C:\\PSTools\\plink.exe -pw cat34968 ssatomcat@158.95.121.30 /spfs/tomcat/Automation_Work/Traige-Automation/bin/UpdateStatus.pl " . $applicationFamily . " " . $applicationName . " " . $environment );
		   	$result['status'] = 1;
		   	$result['message'] = "Restart initiated";
		} catch(Exception $e){
			$result['status'] = 0;
			$result['message'] = $e->getMessage();
			$this->log("updatestatus has error - ". $e->getMessage());
		}
		sleep(5);
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

	function tigerxcommand($requestId = 0){
		
		$this->loadModel('MultiserverCommandOutputData');

		if(!empty($this->data)){
			$requestId = time();
			$this->MultiserverCommandOutputData->id = Null;

			$commandOptionsData['Request_ID']	= $requestId;

			$serverNames = explode(PHP_EOL, $this->data['tigerx']['servernames']);
			$commands = $this->data['cmd'];

			foreach($serverNames as $serverName){
				if($serverName){
					$commandOptionsData['Server_Name']	= $serverName;
					foreach($commands as $cmd){
						if($cmd){
							$commandOptionsData['Command_To_Run'] = $cmd;
							$this->MultiserverCommandOutputData->save($commandOptionsData);
							// $serverName - Name of the server
							// $requestId - Name of the server
							// $cmd - Command
							exec("echo y | C:\\PSTools\\plink.exe -pw cat34968 ssatomcat@158.95.121.30 /spfs/tomcat/Automation_Work/Traige-Automation/bin/TigerX.pl " .$requestId );
						}
					}
				}
			}
		}
		$commandOptions = array();
		$commandOptions['limit'] = 50;
		$commandOptions['order'] = 'Request_ID DESC';

		if($requestId){
			$commandOptions['conditions'] = array("Request_ID" => $requestId);
		}else{
			// $commandOptions['group'] = 'Request_ID';
		}
		$commandOutputsData = $this->MultiserverCommandOutputData->find("all", $commandOptions);

		$this->set('commandOutputsData', $commandOutputsData);

		$this->set('requestId', $requestId);
	}
	  
}
?>