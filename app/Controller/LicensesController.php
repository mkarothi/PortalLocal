<?php

App::uses('AppController', 'Controller');
class LicensesController extends AppController {
	
	// var $uses = array();
	var $helpers    = array('Session');
	function beforeFilter(){
		$this->layout = "licenses";
	}
	
	function tqcheck(){
		$this->loadModel('HostLicensesDatas');
		
		$conditions = array();
		
		$hostLicensesData = $this->HostLicensesDatas->find('all', array("conditions" => $conditions) );

		$this->set('hostLicensesData',  $hostLicensesData);
		if(isset($_POST['export']) && $_POST['export'] == 'export'){
			$this->exportsheet($hostLicensesData, 'HostLicensesDatas');
		}
	}

	function counthistory(){

	}

	
	
  
}

?>