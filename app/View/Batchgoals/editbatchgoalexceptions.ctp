<?php if(!$statusUpdated){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Batch Goal Job Status</title>
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

<div class="container-fluid text-center">    
  <div class="row content">

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Enforce Job Status</a></li>
      <li><a data-toggle="tab" href="#menu1">Jira incident</a></li>
      <li><a data-toggle="tab" href="#menu2">Email Preview</a></li>
    </ul>

    <div class="tab-content">
      <?php echo $this->Form->create(false, array("method" => "POST", "url" => "/batchgoals/editbatchgoalexceptions?jobEntry=$jobEntry", "id" => "BatchgoalForm" ) ); ?>   
      <div id="home" class="tab-pane fade in active text-left">
        <h3><u>Enforce Job Status </u></h3>
        <div>
            <label >Job Entry:</label> 
            <?php echo $jobResultData['BatchGoalStatusData']['Job_Entry']; ?>
        </div>
        <div>
            <label >Job Name:</label> 
            <?php echo $jobResultData['BatchGoalStatusData']['Job_Name']; ?>
        </div>
        <div>
            <label >Job Schedule Start Time:</label> 
            <?php // echo $jobResultData['BatchGoalStatusData']['Latest_Check_Time']; ?>
        </div>
        <div>
            <label >Job Schedule End Time:</label> 
            <?php echo $jobResultData['BatchGoalStatusData']['Job_Schedule_End_Time']; ?>
        </div>
        <div>
            <label >Job Actual Start Time:</label> 
            <?php echo $jobResultData['BatchGoalStatusData']['Job_Actual_Start_Time']; ?>
        </div>
        <div>
            <label >Job Actual End Time:</label> 
            <?php echo $jobResultData['BatchGoalStatusData']['Job_Actual_End_Time']; ?>
        </div>
        <div class="form-group">
          <?php echo $this->Form->input("updated_by", array("label"=> 'Your Name:', "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>
        <label class="form-group">Details:</label> 
        <div class="form-group">
            <?php echo $this->Form->input("why", array("label"=> 'Why :', "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input("eta", array("label"=> 'ETA :', "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input("comments", array("label"=> "Comments :", "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input("action",array('label'=>'Re_Work:', 'class'=> 'form-control required', 'options' => array('none' => 'None', 'ignore' => 'Ignore',
                                                        'restart' => 'Restart Job', 'onhold' => 'Put On-Hold', 'onice' => 'Put On-Ice'), 'div'=>false));?>
        </div>
      </div>
      <div id="menu1" class="tab-pane fade text-left">
        <h3>Jira Ticket Details</h3>
        <div class="form-group">
            <?php echo $this->Form->input("jirauserid", array("label"=> "Jira User Id :", "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input("jirapassword", array("label"=> "Jira Password :", "type" => "password", "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input("jirasummary", array("label"=> "Jira Summary :", "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input("jiradescription", array("label"=> "Jira Description :", "maxlength" =>"100", "div" =>false, "class"=>"form-control required", "error" => false));?>
        </div>
      </div>
      <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Some content in menu 2.</p>
      </div>
      <?php echo $this->Form->end();?>
      <div class="form-group">
        <button type="submit" class="btn btn-default" id="updateDetails">Enter/Update Details</button>
        <?php if($batchGoalExceptionData){ ?>
          <button type="submit" class="btn btn-default" id="raiseJira">Raise Jira Incident Request</button>
          <button type="submit" class="btn btn-default" id="emailPreview">Email Preview/Send</button>
        <?php }?>
      </div>
    </div>

    <div class="tab-content">


    <div class=" text-left">
      
      
        
    </div>
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