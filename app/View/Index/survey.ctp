  <div class="content">
    <div class="content_resize">
        
      <div class="surveycontainer">
        <br> 
        You are receiving this survey in an attempt to help facilitate 2017 server/storage migrations. You are identified in our systems to be the owner of a server that:        
        <ol class="surveyol">
          <li>The server currently resides on an array that will be decommissioned prior to the end of 2017.</li>
          <li>The server is currently running on hardware that is beyond End of Service Life (EOSL).</li>
          <li>The server has an Operating System (OS) that is also Unsupported moving forward, in this case the OS is Windows 2008 (W2K8)</li>
        </ol> 
        We will help facilitate by submitting for a new server build of equal or greater specs to the existing server.<br><br>
        
        In order to facilitate the migration we need you to agree to the following tasks.<br>
        
        <form action="/survey" method="post" id="surveyid">
                <?php if(isset($emailSuccessMessage) && $emailSuccessMessage){ ?>
                <div class="success-message"> <?php echo $emailSuccessMessage; ?></div>
                <?php } ?>
              <div class="input text width100per mtop5">
                <label for="EmailAddress" class="fl">Please provide your email Address.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <div class="clr"></div>
                <div class="rightinputcont">
                <?php echo $this->Form->input('email_address', array("div" => false, "type" => "email","label" => false,    )); ?>
                </div>
             </div>
             <div class="input text width100per mtop5">
               <label for="OsUpgradeAgree">You agree to upgrading to a supported Operating System – Windows 2012.</label>
               <div class="clr"></div>
                <?php echo $this->Form->input('os_upgrade_agree', array("div" => false,"label" => false, "legend" => false, "required" =>true, "type" => "radio", "options" => array("Yes"=>"Yes", "No" =>"No") )); ?>
              </div>
             <div class="input text width100per mtop5">
                <label for="CerticationAgree">You agree to testing/certifying you application will run on Windows 2012.</label>
                <div class="clr"></div>
                <?php echo $this->Form->input('certification_agree', array("div" => false,"label" => false, "legend" => false, "required" =>true, "type" => "radio", "options" => array("Yes"=>"Yes", "No" =>"No") )); ?>                
              </div>
             <div class="input text width100per mtop5">
                <label for="website">You agree to setting up a storage migration window in the 1st half of 2017. </label>
                <div class="clr"></div>
                <?php echo $this->Form->input('storage_migration_agree', array("div" => false,"label" => false, "legend" => false, "type" => "radio", "options" => array("Yes"=>"Yes", "No" =>"No") )); ?>   
              </div>
              <div class="width100per mtop5"> OR </div>
             <div class="input text width100per mtop5">
                <label for="website">I will be moving my application/server/storage all to the cloud prior to the end of 2017 and I will submit a Decommission request.</label>
                <div class="clr"></div>
                <?php echo $this->Form->input('decommission_agree' , array("div" => false,"label" => false, "legend" => false, "type" => "radio", "options" => array("Yes"=>"Yes", "No" =>"No") )); ?>   
              </div>
             <div class="input text width100per mtop5">
                <label for="message">Additional Comments &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <div class="clr"></div>
                <?php echo $this->Form->input('comments', array("div" => false,"label" => false, "rows" => 8, "type" =>"textarea",  "required" =>true)); ?>  
              </div>
             <div class="width100per mtop10">
                  By agreeing to all the above and submitting this survey you will be added to our migration list and will receiver further guidance once your new server is built <br><br>
                  If you do not respond we will put you on the non-compliant Server Unaccountability Detected  (NC-SUD) list and the following charges will be added to your monthly server/storage charge. <br><br>
                    1. Server and Storage charges will be doubled. <br>
                    2. Additional Maintenance charge will be added equivalent to the cost of maintaining End of AIG support lifecycle, which will equated by a formula whereas all servers remaining will equally share the cost of the extended maintenance.<br><br>
                  
              </div>
              <div class="width100per mtop5">
                <input type="image" name="imageField" id="imageField" src="images/submit.gif" class="send" />
              </div>
          <?php echo $this->Form->end() ; ?>
        </div>
      </div>
      <div class="clr"></div>
    </div>
