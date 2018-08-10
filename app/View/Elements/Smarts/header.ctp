<div id="header_wrapper">
    <div id="header">
        <div class="smartsheader"><img src="/images/Smarts/header.jpg" alt="" /></div>
      <!--<table> <tr>
       <td>
      <a href="/smarts/"><span class="logo-title"><img src="/images/Smarts/smart.png" alt=""/></a>
      </td> 
      <td>
      </td>
      </tr>
      </table>-->
    </div>
    <?php // debug($this->request->params['action']);?>
    <div id="navcontainer">
      <ul id="navlist">
        <li <?php if(in_array($this->request->params['action'], array("general") ) ){ ?>class="active" <?php }?> ><a href="/smarts/all/general/" <?php if(in_array($this->request->params['action'], array("general") ) ){ ?>class="current" <?php }?>>General</a></li>
        <li <?php if($this->request->params['action'] == 'migrationstatus'){?>class="active" <?php }?> ><a href="/smarts/all/migrationstatus/" <?php if($this->request->params['action'] == 'migrationstatus'){?>class="current" <?php }?>>Status Check</a></li>
        <li <?php if($this->request->params['action'] == 'migrationreports'){?>class="active" <?php }?> ><a href="/smarts/all/migrationreports/" <?php if($this->request->params['action'] == 'migrationreports'){?>class="current" <?php }?>>Reports</a></li>
        
      </ul>
    </div>
</div>