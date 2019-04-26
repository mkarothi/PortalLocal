<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
    
    function beforeFilter() {
        parent::beforeFilter();
        Configure::write('debug', 2);
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
    	debug($_REQUEST);
        if($this->__checkIfUserLoggedIn()) {
            //user already logged in
            $referer = $this->__getLoginReferer();
            $this->redirect('http://' . env('SERVER_NAME') . $referer);
            
        } else {
            if(!empty($this->data)) {
                $userData   = array('email' => $this->data["email"], 'password' => MD5($this->data["password"]) );
            
                debug($userData);

                $this->loadModel('User');

                $userLoggedData = $this->User->find('first', array("conditions" => $userData) );

                $this->log("Users::login - Success --------");
                
                $this->__createUserSession($userLoggedData);

                $referer = $this->__getLoginReferer();
                
                /* adding this to redirect to http:// version of admin tool
                    * we are forcing https on login/register but inside site should
                    * still run on http://
                    */
                $redirectUrl =  'http://' . env('SERVER_NAME') . $referer;
                
                $this->redirect($redirectUrl);
            }
        } 
    } 

    function logout() {
        
        $this->autoRender = false;
        if($this->__checkIfUserLoggedIn()) {
            $signature = $this->getAuthenticatedSignature();
            if ($signature) {
                $userId      = $this->__getCurrentUserId();
                    // debug("TODO: What to do if the logout failed. I think still we need to delete the session locally?");
                $this->__deleteUserSession();
            } else {
                //no signature
                $this->log("Users::logout - No Signature");
                debug("no signature");
            }
        }
        $redirectUrl = "http://".$_SERVER['SERVER_NAME']."/login";
        $this->redirect($redirectUrl);
    }
}
?>