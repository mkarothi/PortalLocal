<?php 

App::uses('Component', 'Controller');

class BatchemailComponent extends Component {
    
    var $components = array("Email");


    function getTemplate($template_name,$partnerId) {

		$conditions        = "Emailtemplate.email_name='$template_name' and Emailtemplate.type='$type' and partner_id in($partnerId,0) and contest_id in ($contestid,0)";
		$order             = "Emailtemplate.partner_id desc, Emailtemplate.contest_id desc";
		$currEmailTemplate = $this->Emailtemplate->find("first",array("conditions"=>$conditions,"order"=>$order));
		return $currEmailTemplate;
	}


    function merge($string) {
		return str_replace($this->keyArray,$this->valueArray,$string);
	}
}

?>