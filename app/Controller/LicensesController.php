<?php

App::uses('AppController', 'Controller');
class LicensesController extends AppController {
	
	// var $uses = array();
	var $helpers    = array('Session');
	function beforeFilter(){
		$this->layout = "licenses";
	}
	
	function tqcheck($type = 'history'){

		$this->loadModel('HostLicensesDatas');

		$this->loadModel('HostLicensesHistoryDatas');
		
		$conditions = array();

		$searchTablesArray = array('HostLicensesDatas', 'HostLicensesHistoryDatas');
		
		$results['HostLicensesDatas'] = $this->HostLicensesDatas->find('all', array("conditions" => $conditions) );
		$results['HostLicensesHistoryDatas'] = $this->HostLicensesHistoryDatas->find('all', array("conditions" => $conditions) );

		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			if($type == 'history'){
				$this->exportsheet($results['HostLicensesHistoryDatas'], 'HostLicensesHistoryDatas');
			}else{
				$this->exportsheet($results['HostLicensesDatas'], 'HostLicensesDatas');
			}
		}
		$this->set('results', $results);
		$this->set('searchTablesArray', $searchTablesArray);
	}	
  
}

?>