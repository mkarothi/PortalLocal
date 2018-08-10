<div id="portal_header">
    <div id="portal_logo">  <a href="/"><span class="logo-title"><img src="images/stunts-1.png" alt=""/></a> 
         <div id="portal_sitetitle">DEXYP Infrastructure</div>
        <!-- <img src="images/tiger.png" alt="Logo" /> -->
    </div>
    <div id="portal_login">
        <form method="post" action="submit()" class="login-form">
            <label>User ID:</label><input class="inputfield" name="userID" type="text" id="email_address"/>
            <label>Password:</label><input class="inputfield" name="password" type="password" id="password"/>
            <input class="button" name="Submit" value="Login" /> <!-- type="submit" -->
        </form>
    </div>
</div>
<div id="portal_menu">
    <ul>
<!--    <li><a href="javascript:history.go(-1)" title="Go Back"<img src="images/back.png"</a></li> -->
        <li><a href="/home" <?php if($this->action == "home"){?> class="current" <?php } ?> >Home</a></li>
        <li><a href="/reports/CMDB/serverinventory">HW Inventory</a></li>
        <li><a href="/comingsoon">Operations</a></li>  
        <li><a href="/reports/CMDB/serverinventory">DevOps</a></li>   
        <li><a href="ftp://ci-jenkins.dexmedia.com" target="_blank">FTP Site</a></li>            
        <!--  <li><a href="mailto:SatyaMurthy.Karothi@dexyp.com" class="lastmenu">Contact Us</a></li>        -->
        <li><a href="/contactus" <?php if($this->action == "contactus"){?> class="current" <?php } ?> >Contact Us</a></li>           
    </ul>  
</div>

