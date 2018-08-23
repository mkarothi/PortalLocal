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
		<?php foreach($jobResultData[0]['ApplicationMonitoringStatus'] as $columnName => $value){ ?>
	  		<th><?php echo $columnName;?></th>
	  	<?php } ?>
	  	</tr></thead>
	  	<tbody id="myTable">
	  	<?php foreach($jobResultData as $jobResult){ ?>
	  		<tr>
		  	<?php foreach($jobResult['ApplicationMonitoringStatus'] as $columnName => $value){ ?>
		  		<?php if($columnName != 'Instance_Latest_Status'){ ?>
	  				<td><?php echo $value;?></td>
		  		<?php } else { ?>
		  			<?php if($value == 'Success'){
		  					$tdClass = 'success';
		  				  }elseif($value == 'RESTARTED, SUCCESS'){
		  					$tdClass = 'warning';
						  }else {
		  					$tdClass = 'danger';
		  				  }
	  				?>
		  			<td class = "<?php echo $tdClass;?>"><?php echo $value;?></td>
		  		<?php } ?>
		  	<?php } ?>
		  	</tr>
	  	<?php } ?>
	  	</tbody>
	  </table>
  <?php } ?>
	</div>
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
