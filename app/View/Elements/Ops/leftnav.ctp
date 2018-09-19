<div class="col-sm-1 list-group">
	<a class="list-group-item <?php if($this->action == 'index'){ ?>active<?php }?>" href="/applicationmonitor">Application Monitoring</a>
  	<a class="list-group-item <?php if($this->action == 'appconfigurations'){ ?>active<?php }?>" href="/applicationmonitor/appconfigurations">Application Configurations</a>
	<a class="list-group-item <?php if($this->action == 'verifydeployment'){ ?>active<?php }?>" href="/applicationmonitor/verifydeployment">Verify Deployment File</a>
</div>