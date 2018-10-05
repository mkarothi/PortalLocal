<?php if(!$requestId) { ?>
<div class="col-sm-11 text-left">
    <br />
    <br />
    <?php
        echo $this->Form->create("tigerx", array("method" => "POST") ); ?>
            
        <div class="col-sm-3 text-left">
            <div class ="form-group">
            <?php echo $this->Form->input('servernames', array("label" => false, "type" => "textarea", "rows" => 10, "cols"=>"50", "class" => 'input-lg form-control', "placeholder" => "Server Names")); ?> 
        </div>
        </div>
        <div class="col-sm-3 text-right">
            <div class ="form-group">
                <?php echo $this->Form->input('cmd.1', array("label" => false, "type" => "text", "class" => 'input-lg form-control', "placeholder" => "Command 1")); ?> 
            </div>
            <div class ="form-group">
                <?php echo $this->Form->input('cmd.2', array("label" => false, "type" => "text", "class" => 'input-lg form-control', "placeholder" => "Command 2")); ?> 
            </div>
            <div class ="form-group">
                <?php echo $this->Form->input('cmd.3', array("label" => false, "type" => "text", "class" => 'input-lg form-control', "placeholder" => "Command 3")); ?> 
            </div>
            <div class="text-right">
                <button type="button" class="btn" id="tigerXSubmit">Submit</button>
            </div>
        </div>
        <?php echo $this->Form->end() ; ?>

<?php } ?>
    <div class="col-sm-11 text-left">
        <br />
        <br />
        <?php if(!$requestId) { ?>
        <h3>Previous Requests:</h3><br />
        <?php } ?>
    <?php if($commandOutputsData) { ?>
        <table class="table table-condensed table-responsive table-bordered">
            <thead><tr> 		
            <?php foreach($commandOutputsData[0]['MultiserverCommandOutputData'] as $columnName => $value){ ?>
                <th><?php echo $columnName;?></th>
            <?php } ?>
            </tr></thead>
            <tbody id="myTable">
            <?php 
                $key = 0;
                foreach($commandOutputsData as $commandOutputs){ ?>
                <tr>
                <?php 
                    foreach($commandOutputs['MultiserverCommandOutputData'] as $columnName => $value){  ?>
                        <?php if($columnName == 'Request_ID'){ ?> 
                            <td><a href="/applicationmonitor/tigerxcommand/<?php echo $value;?>"><?php echo $value;?></a></td>
                        <?php  }elseif($columnName == 'Command_Output'){ ?>
                            <td>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key;?>">Show Output..</a>
                                <div id="collapse<?php echo $key;?>" class="panel-collapse collapse">
                                    <pre><?php echo $value;?></pre>
                                </div>
                            </td>
                            
                        <?php  }else{ ?>
                        <td><?php echo $value;?></td>
                        <?php  } ?>
                    <?php } ?>
                </tr>
            <?php 
                $key++;
                } ?>
            </tbody>
        </table>
    <?php } ?>
    </div>

</div>
<script>
$(document).ready(function(){
	$('#tigerXSubmit').click( function() {
		$('#tigerxTigerxcommandForm').attr('action', '/applicationmonitor/tigerxcommand');
		$("#tigerxTigerxcommandForm").submit();
    });
});
</script>