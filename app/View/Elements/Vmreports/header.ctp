<div id="header_wrapper">
    <div id="header">
      <table> <tr><td>
      <a href="/vmreports/global/serverinventory"><span class="logo-title"><img src="/images/VMware_Logo.png" alt="" width="50px;"/></a>
      </td><td></td>
      <td>
      <h1> <font color="#CC0033">V</font>irtual <font color="#CC0033">I</font>nfrastructure <font color="#CC0033">E</font>xtended vie<font color="#CC0033">W</font> <font color="#CC0033">S</font>ystem</h1>
      </td>
      </tr>
      </table>
    </div>
    <?php // debug($this->request->params['action']);?>
    <div id="navcontainer">
      <ul id="navlist">
        <li <?php if($this->request->params['action'] == 'capacity'){?>class="active" <?php }?> ><a href="/vmreports/comingsoon/" <?php if($this->request->params['action'] == 'capacity'){?>class="current" <?php }?>>Capacity</a></li>
        <!-- <li <?php if($this->request->params['action'] == 'sanstorage'){?>class="active" <?php }?> ><a href="/reports/global/sanstorage/" <?php if($this->request->params['action'] == 'sanstorage'){?>class="current" <?php }?>>SAN Storage</a></li>
        <li <?php if($this->request->params['action'] == 'nassearch'){?>class="active" <?php }?> ><a href="/reports/comingsoon/" <?php if($this->request->params['action'] == 'nassearch'){?>class="current" <?php }?>>NAS Storage</a></li>
         --><li <?php if($this->request->params['action'] == 'storagebilling'){?>class="active" <?php }?> ><a href="/vmreports/comingsoon/" <?php if($this->request->params['action'] == 'storagebilling'){?>class="current" <?php }?>>Server Billing</a></li>
         <li <?php if(in_array($this->request->params['action'],array('extendedview')) ){?>class="active" <?php }?> ><a href="/vmreports/global/extendedview" <?php if(in_array($this->request->params['action'],array('extenededview'))){?>class="current" <?php }?>>Extented Views</a></li>
        <li <?php if(in_array($this->request->params['action'],array('serverinventory')) ){?>class="active" <?php }?> ><a href="/vmreports/global/serverinventory" <?php if(in_array($this->request->params['action'],array('pingnslookup', 'serverinventory'))){?>class="current" <?php }?>>Total View</a></li>
      </ul>
    </div>
</div>