<style>
.bmd-modalButton {
  display: block;
  margin: 15px auto;
  padding: 5px 15px;
}

.close-button {
  overflow: hidden;
}

.bmd-modalContent {
  box-shadow: none;
  background-color: transparent;
  border: 0;
}
  
.bmd-modalContent .close {
  font-size: 30px;
  line-height: 30px;
  padding: 7px 4px 7px 13px;
  text-shadow: none;
  opacity: .7;
  color:#fff;
}

.bmd-modalContent .close span {
  display: block;
}

.bmd-modalContent .close:hover,
.bmd-modalContent .close:focus {
  opacity: 1;
  outline: none;
}

.bmd-modalContent iframe {
  display: block;
  margin: 0 auto;
}

.embed-responsive{
	min-height: 600px;
}
	
</style>

<div class="col-sm-11 text-left"> 
	<div class="col-sm-10 text-left"><?php echo $this->Session->flash(); ?></div><br>
	<!-- <div class="col-sm-6">
		<input class="form-control" id="myInput" type="text" placeholder="Search...">
	</div>
	<br> -->
	<br>
	<div class="col-sm-12">
	<?php if($batchGoalResultData){ ?>
	  	<table class="table table-condensed table-responsive table-bordered">
		 <thead><tr> 		
		<?php foreach($batchGoalResultData[0]['BatchGoalSchedule'] as $columnName => $value){ ?>
	  		<th><?php echo $columnName;?></th>
	  	<?php } ?>
	  	</tr></thead>
	  	<tbody id="myTable">
	  	<?php foreach($batchGoalResultData as $jobResult){ ?>
	  		<tr>
		  	<?php foreach($jobResult['BatchGoalSchedule'] as $columnName => $value){ ?>
		  		
		  		<?php if($columnName == 'Job_Entry'){ ?>
		  			<td>
		  				<?php if($jobResult['BatchGoalSchedule']['Job_Actual_End_Time'] == 'xx:xx') { ?> 
            				<a class="bmd-modalButton" data-toggle="modal" data-bmdSrc="/ops/editjobstatus?jobEntry=<?php echo $jobResult['BatchGoalSchedule']['Job_Entry'] ?>" data-bmdWidth="640" data-bmdHeight="480" data-target="#myModal"><?php echo $value;?></a>
	  					<?php }else{ ?> 	
		  					<?php echo $value;?>
		  				<?php } ?>
		  			</td>
		  		<?php } elseif($columnName != 'Job_Latest_Status'){ ?>
	  				<td><?php echo $value;?></td>
		  		<?php } else { ?>
		  			<?php if(in_array($value, array('Success', 'Ignore', 'ignore') ) ){
		  					$tdClass = 'background-color: #20dc20;';
		  				  }elseif($value == 'Long Running'){
		  					$tdClass = 'background-color: yellow;';
						  }else {
		  					$tdClass = 'background-color: red;';
		  				  }
	  				?>
		  			<td style="<?php echo $tdClass;?>"><?php echo $value;?></td>
		  		<?php } ?>
		  	<?php } ?>
		  	</tr>
	  	<?php } ?>
	  	</tbody>
	  </table>
	  <?php } ?>
	  </div>
</div>

<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
      
	          <div class="close-button">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          </div>
	          <div class="embed-responsive embed-responsive-16by9">
		            <iframe class="embed-responsive-item" frameborder="3" height="789" ></iframe>
	          </div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  var srcAttr ='';
  
  $('.bmd-modalButton').on('click', function(e) {
      srcAttr = $(this).attr('data-bmdSrc');
  });
  
  $("#myModal").on("shown.bs.modal", function () { 
    $(this).find('iframe').html("").attr("src", srcAttr);
  });
  
  window.closeModal = function(){
    $('#myModal').modal('hide');
  };
  
});
</script>