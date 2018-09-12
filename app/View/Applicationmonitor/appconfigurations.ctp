<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php if((isset($fromSearch) && !$fromSearch) || !isset($fromSearch) ){ ?>

<div class="container-fluid col-sm-10">
    <br>
	<form>
  	<div class="col-sm-3 form-group">
  		<input class="form-control" id="appFamily" type="text" placeholder="Application Family">
  	</div>
  	<div class="col-sm-1 form-group">
  		OR
  	</div>
  <div class="col-sm-3 form-group">
  	 <input class="form-control" id="appName" type="text" placeholder="Application Name">
  </div>
  <div class="col-sm-1 form-group">
  	  AND
  </div>
  <div class="col-sm-3 form-group">
	<select class="form-control" name="environment"  placeholder="Environment">
        <option>​cfit</option>​
        <option>ppt</option>
        <option>pm</option>
        <option>prod</option>
		<option>qa</option>
        <option>dev</option>
        <option>prod1</option>
		<option>prod2</option>
    </select>
  </div>
  </form>
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
	<br>
	<br>
	<div class="col-sm-12">
	<?php if($jobResultData){ ?>
	  	<table class="table table-condensed table-responsive table-bordered">
		 <thead><tr> 		
		<?php foreach($jobResultData[0]['ApplicationMonitoringConfig'] as $columnName => $value){ ?>
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
		  		foreach($jobResult['ApplicationMonitoringConfig'] as $columnName => $value){  ?>
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
		  			<div id="submit-<?php echo $configId;?>"><input type="button" onclick="restartserver(<?php echo $configId;?>,<?php echo $isProd;?>); return false;" value="Restart" /></div>	
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
		alert("restartApplication");
    });

	$('#verifyDeployment').click( function() {
		alert("verifyDeployment");
    });
});

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
