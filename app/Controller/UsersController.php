<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
    
    var $helpers    = array('Session');

    function beforeFilter() {
        parent::beforeFilter();
        Configure::write('debug', 0);
        $this->layout = "user";
    }
    
    function index(){
        
    }
    
    function add() {
		
        if (defined('PARTNER_IS_OPEN_REG') && !PARTNER_IS_OPEN_REG ) {
            $this->redirect("/login");
        }
        if($this->__checkIfUserLoggedIn()) {
            //user already logged in
            $referer = $this->__getLoginReferer();
			$this->redirect('http://' . env('SERVER_NAME') . $referer);
        } else {
        	

            if(!empty($this->data)) {

                // $this->__createNewUser($defaultSuite);
               
            }
        }
    }

    function login() {
        
        if($this->__checkIfUserLoggedIn()) {
            //user already logged in
            $referer = $this->__getLoginReferer();
            $this->redirect('http://' . env('SERVER_NAME') . $referer);
            
        } else {
            if(!empty($this->data)) {
                $userData   = array('email' => trim($this->data["email"]), 'password' => md5(trim($this->data["password"])) );
            
                $this->loadModel('User');
                $userLoggedData = $this->User->find('first', array("conditions" => $userData) );
                if($userLoggedData){

                    $this->log("Users::login - Success --------");
                    $this->__createUserSession($userLoggedData);
                    $referer = $this->__getLoginReferer();
                    
                    /* adding this to redirect to http:// version of admin tool
                    * we are forcing https on login/register but inside site should
                    * still run on http://
                    */
                    $redirectUrl =  'http://' . env('SERVER_NAME') . $referer;
                    $this->redirect($redirectUrl);
                }else{
                    $this->Session->setFlash('Email and Password does not match!');
                }
            }
        } 
    } 

    function logout() {
        
        $this->autoRender = false;
        if($this->__checkIfUserLoggedIn()) {
            $userId      = $this->__getCurrentUserId();
            // debug("TODO: What to do if the logout failed. I think still we need to delete the session locally?");
            $this->__deleteUserSession();
            $redirectUrl = "http://".$_SERVER['SERVER_NAME']."/login";
        }else{
            $redirectUrl =  'http://' . env('SERVER_NAME') . $referer;
        }
        $this->redirect($redirectUrl);
    }
}
?>