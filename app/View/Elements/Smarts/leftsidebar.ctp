<?php if(in_array($this->request->params['action'], array("general", "migrationstatus", 'migrationreports') ) ){ ?>
<div id="left_side">
    <h3>Search Reports</h3>
    <div class="gadget">
        <ul class="sb_menu">
            <li>
                <a href="smarts/appowners/<?php echo $this->request->params['action'];?>/serverslist" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "appowners") {?>class = "sidebar-selected" <?php } ?> >General</a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>