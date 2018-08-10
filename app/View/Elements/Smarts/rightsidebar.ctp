<?php if(in_array($this->request->params['action'],array('general','migrationstatus', 'migrationreports') )){?>
<div id="right_side">
    <div id='cssmenu' class="sb_menu">
    <ul>
       <li class='has-sub'><a href='#'><span>Export Reports</span></a>
          <ul>
            <li>
                <a href="/smarts/appowner/exportsheet/">Server App Owner Data File</a>
            </li>
        </li>
        </ul>
    </div>
</div>
<?php } ?>