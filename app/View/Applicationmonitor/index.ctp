<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
.loader{top:0;bottom:0;right:0;left:0; opacity:0.3; position:absolute; background-color:#000; display:none;}
.loader img{    top: 100px;
    left: 50%;
    position: absolute;
    background: #000;
    opacity: 0.8;}
</style>
<?php if((isset($fromSearch) && !$fromSearch) ){ ?>

<div class="container-fluid col-sm-10">
    <br>
	<?php 
		echo $this->Form->create("Appconfigurations", array("method" => "POST", "class" => "reports-form-tag", "id" => "AppconfigurationsForm") );
		
		echo $this->Form->input('applicationfamily', array("type" => "text", "placeholder"=>"Application Family", 
															 "class" => "col-sm-3 form-group", "label" => false)); ?>
  	<div class="col-sm-1 form-group">
  		OR
  	</div>
  <?php 
		echo $this->Form->input('applicationname', array("type" => "text", "placeholder"=>"Application Name", 
															 "class" => "col-sm-3 form-group", "label" => false)); ?>
  <div class="col-sm-1 form-group">
  	  AND
  </div>
  <div class="col-sm-3 form-group">
	<?php 
		$environmentType = array("cfit" => "cfit", "ppt" => "ppt", "pm" => "pm", "qa" => "qa", "dev" => "dev", "prod" => "prod", "prod1" => "prod1", "prod2" => "prod2");
		echo $this->Form->input('environment', array("type"  => "select", "empty" => " --Environment-- ", "options" => $environmentType,
													 "class" => "col-sm-3 form-control", "label" => false, "div" => false)); ?>
  	<?php echo $this->Form->end() ; ?>
</div>

<div class="col-sm-10">
	<div class="col-sm-5 text-right">
		<button type="button" class="btn" id="restartApplication">Restart application Instances</button>
  	</div>
  	<div class="col-sm-5 text-left">
  		<button type="button" class="btn" id="verifyDeployment">Verify Deployment File</button>
  	</div>
</div>

<?php } else { ?>

<div class="col-sm-11 text-left">
	<br>
	<div class="col-sm-6">
		<input class="form-control" id="myInput" type="text" placeholder="Search...">
	</div>
	<div class="col-sm-1 pull-right">
		<form method="POST">
			<input name="export" type="hidden" value="export">
			<input class="form-control" type="submit" value="export">
		</form>
	</div>
	<?php if($environment) { ?>
	<div class="loader"> <img src="/images/loading.gif" id="loadingImg" /></div>
	
	<div class="col-sm-2 pull-right">
		<form method="POST">
			<input name="updatestatus" type="hidden" value="updatestatus">
			<input class="form-control" type="button" onclick="updateStatus('<?php echo $applicationFamily;?>','<?php echo $applicationName;?>','<?php echo $environment;?>'); return false;"  value="Update Current Status" />
		</form>
	</div>
	<?php } ?>
	<br>
	<br>
	<div class="col-sm-12">
	<?php if($jobResultData){ ?>
	  	<table class="table table-condensed table-responsive table-bordered">
		 <thead><tr> 		
		<?php foreach($jobResultData[0]['ApplicationMonitoringStatus'] as $columnName => $value){ ?>
	  		<th><?php echo $columnName;?></th>
	  	<?php } ?>
	  	<th>Action</th>
	  	</tr></thead>
	  	<tbody id="myTable">
	  	<?php 
	  	$configId = false;
	  	foreach($jobResultData as $jobResult){ ?>
	  		<tr>
		  	<?php 
				  $configId = false;
				  $isProd = 0;
		  		foreach($jobResult['ApplicationMonitoringStatus'] as $columnName => $value){  ?>
				  	<?php if($columnName == "Current_Status" && $value != '200-OK'){ ?> 
						<td style="color:red"><strong><?php echo $value;?></strong></td>
					<?php } else { ?>
  					<td><?php echo $value;?></td>
					<?php 
						if($columnName == 'Config_ID'){
							$configId = $value; 
						}
						if($columnName == 'Server_Role'){
							$isProd = 0;
							if($value == 'prod') {
								$isProd = 1;
							}
						}
					} ?>
				  <?php } ?>
		  		<td> 
		  			<div id="submit-<?php echo $configId;?>"><input type="button" onclick="restartserver('<?php echo $configId;?>','<?php echo $isProd;?>'); return false;" value="Restart" /></div>	
	  			</td>
		  	</tr>
	  	<?php } ?>
	  	</tbody>
	  </table>
  <?php } ?>
  </div>
</div>

<?php } ?>
<script>
$(document).ready(function(){
  	$("#myInput").on("keyup", function() {
    	var value = $(this).val().toLowerCase();
    	$("#myTable tr").filter(function() {
      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    	});
  	});

  	$('#restartApplication').click( function() {
		$('#AppconfigurationsForm').attr('action', '/applicationmonitor');
		$("#AppconfigurationsForm").submit();
    });

	$('#verifyDeployment').click( function() {
		$('#AppconfigurationsForm').attr('action', '/applicationmonitor/verifydeployment');
		$("#AppconfigurationsForm").submit();
    });
});

function updateStatus(applicationFamily, applicationName, environment){
	$('.loader').show();
  	ajaxUrl = "/applicationmonitor/updatestatus/"+applicationFamily+"/"+applicationName+"/"+environment;
  	$.ajax( {
        url : ajaxUrl,
        cache : false,
        dataType:"json",
        success : function (data) {
			$('.loader').hide();
			if(data.status == 1){
				window.location.reload();
			}
        },
        error : function() {
            alert('Restart failed');
			$('#loadingImg').hide();
        }
    });
}

function restartserver(configId, isProd){
  	ajaxUrl = "/applicationmonitor/restartserver/"+configId+"/"+isProd;
  	$.ajax( {
        url : ajaxUrl,
        cache : false,
        dataType:"json",
        success : function (data) {
           $("#submit-"+configId).html('<span style="color:red">'+data.message+'</span>');
        },
        error : function() {
            alert('Restart failed');
        }
    });
}
</script>