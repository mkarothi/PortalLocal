  <div class="content">
    <div class="content_resize">
    <br>
      <div class="mainbar">
        <div class="article">
            <br>
          <h2>Contact</h2>
          <p>You can fill out the following form to reach Dex Media LOS Engineering Team. OR you can use side bar to contact respective person individually</p>
        </div>
        <div class="article">
          <h2>Send us E-Mail</h2>
          <?php if($emailSuccessMessage){ ?>
          <div> </div>    
          <?php } ?>
        <form action="/contactus" method="post" id="sendemail">
            <ol>
                
                <?php if($emailSuccessMessage){ ?>
                <li><div class="success-message"> <?php echo $emailSuccessMessage; ?></div></li>
                <?php } ?>
              <li>
                <label for="name">Your Name (Required)</label>
                <?php echo $this->Form->input('name', array("label" => false, "class" => "text", "required" =>true)); ?>
              </li>
              <li>
                <label for="email">Your Email Address (Required)</label>
                <?php echo $this->Form->input('email', array("label" => false, "class" => "text", "required" =>true)); ?>
              </li>
              <li>
                <label for="phone">Your Contact Number (Optional)</label>
                <?php echo $this->Form->input('phone', array("label" => false, "class" => "text")); ?>                
              </li>
              <li>
                <label for="website">Website Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <?php echo $this->Form->input('websiteURL', array("label" => false, "class" => "text")); ?>   
              </li>
              <li>
                <label for="message">Your Message (Required) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br>
                <?php echo $this->Form->input('message', array("label" => false, "rows" => 8, "type" =>"textarea",  "required" =>true)); ?>  
              </li>
              <li>

                <input type="image" name="imageField" id="imageField" src="images/submit.gif" class="send" />
  
              </li>
            </ol>
          <?php echo $this->Form->end() ; ?>
        </div>
      </div>
      <div class="sidebar">
        <div class="gadget">
        <br>
          <h2 class="star"><span>Individual</span> Contacts</h2>
          <ul class="sb_menu">
            <li><a href="mailto:Mike.Hendler@dexmedia.com" class="sb_menu_right">Mike Hendler</a>
                <br /> AVP, Infrastructure & Ops
            </li> 
            <li><a href="mailto:Aminur.Rahman@DexMedia.com" class="sb_menu_right">Aminur Rahman</a>
                <br /> Sr. Manager, App Support & LOS
            </li>
            <li><a href="mailto:Satyamurthy.Karothi@dexmedia.com" class="sb_menu_right">Murthy Karothi</a>
                <br /> Principal Engineer, App Support & LOS
            </li>           
            <li><a href="mailto:Prashanth.Ramalingaiah@dexmedia.com" class="sb_menu_right">Prashanth Ramalingaiah</a>
                <br /> Manager, App Support & LOS
            </li> 
			<li><a href="mailto:DL-EnvironmentTeam@DexMedia.com" class="sb_menu_right"> Environment Group</a>
                <br /> DL-EnvironmentTeam  
            </li> 
          </ul>
        </div>
        <br>
        <div class="gadget">
          <h2 class="star"><span>Groups</span></h2>
          <ul class="ex_menu">
            <li><a href="mailto:DL-USSLINUX@dexmedia.com">Dex Media USS Team</a><br />
              </li>
            <li><a href="mailto:DL-EnvironmentTeam@DexMedia.com">Dex Media Environment</a><br />
              </li>
            <li><a href="mailto:DL-OpsCenter@dexmedia.com">Operation Center</a><br />
             </li>
            <li><a href="mailto:DL-USS-TCS@dexmedia.com">Dex Media USS-TCS</a><br />
             </li>
           </ul>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>