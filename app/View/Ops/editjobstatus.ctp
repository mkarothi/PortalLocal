<?php if(!$statusUpdated){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Job Status</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid text-center">    
  <div class="row content">

    
<?php echo $this->Html->script('jquery/plugins/jquery.validate.js?v=1', array('inline' => true)); ?>
<script>
$(document).ready(function(){
	
	var validator = $("#jobUpdateForm").validate({
        rules: {
            "data[Ops][updated_by]":{
            	required: true,
            },
            "data[Ops][who_requested]":{
            	required: true,
            	minlength:5,
                maxlength:255
            },
            "data[Ops][ignore_time]":{
                required: true,
                minlength:1,
                maxlength:255
            },
            "data[Ops][why]":{
                required: true,
                minlength:5,
                maxlength:255
            }
            
        },
        messages: {
        },
        submitHandler : function(form){
            form.submit();
        }
    });
});
</script>
<div class="col-sm-3 text-left">
	
	<?php echo $this->Form->create("Ops", array("method" => "POST", "action" => "/editjobstatus?jobEntry=$jobEntry", "id" => "jobUpdateForm" ) ); ?>
	
		<div class="col-sm-3 text-left">
	    <h3><u>Enforce Job Status </u?</h3>   
	  </div>
	
	  <div class="form-group">
	    <label for="OpsUpdatedBy">Your Name: </label>
	    <?php echo $this->Form->input("updated_by", array("label"=> false, "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
	  </div>
	  <div class="form-group">
		    <label >Job Entry:</label> 
		    <?php echo $jobResultData['BatchJobsStatusData']['Job_Entry']; ?>
	  </div>
	  <div class="form-group">
		    <label >Server Name:</label> 
		    <?php echo $jobResultData['BatchJobsStatusData']['Server_Name']; ?>
	  </div>
             
	  <div class="form-group">
		    <label >Job Name:</label> 
		    <?php echo $jobResultData['BatchJobsStatusData']['Job_Name']; ?>
	  </div>
	  
	  <div class="form-group">
		    <label >Job Schedule Start Day:</label> 
		    <?php echo $jobResultData['BatchJobsStatusData']['Job_Schedule_Start_Day']; ?>
	  </div>
	  
	  <div class="form-group">
		    <label >Job Schedule Actual Start time:</label> 
		    <?php echo $jobResultData['BatchJobsStatusData']['Job_Schedule_Start_Time']; ?>
	  </div>
	  
	  <div class="form-group">
		    <label >ob Schedule Actual End time:</label> 
		    <?php echo $jobResultData['BatchJobsStatusData']['Job_Actual_End_Time']; ?>
	  </div>
	  <label>Comments:</label> 
	  <div class="form-group">
		    <label for="OpsWhoRequested">Who requested :</label> 
		    <?php echo $this->Form->input("who_requested", array("label"=> false, "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
	  </div>
	  
<!-- 	  <div class="form-group">    
		    <label for="OpsIgnoreTime">How Long will be Ignored:</label> 
		    <?php echo $this->Form->input("ignore_time", array("label"=> false, "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
	  </div> -->
	  
	  <div class="form-group">
		    <label for="OpsWhy">Why:</label> 
		    <?php echo $this->Form->input("why", array("label"=> false, "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
	  </div>

    <div class="form-group">
		    <label for="OpsAction">Action:</label> 
		    <?php echo $this->Form->input("action",array('label'=>false, 'class'=> 'form-control required', 'options' => array('ignore' => 'Ignore',
                                                    'restart' => 'Restart Job', 'onhold' => 'Put On-Hold', 'onice' => 'Put On-Ice'), 'div'=>false));?>
	  </div>
		
	  <button type="submit" class="btn btn-default">Submit</button>
	<?php echo $this->Form->end();?>
</div>
    
   
  </div>
</div>

</body>
</html>


<?php } else{ ?>
	
<div class="col-sm-3 text-left"> Request Accepted, Now you can close this window </div>

<script>
$(document).ready(function(){
	$('#myModal', window.parent.document).modal('hide');
});
</script>
<?php } ?>