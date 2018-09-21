<div class="col-sm-11 text-left">
    <br />
    <br />
    <?php if(isset($requestId)){ ?>
        <div class="container-fluid col-sm-10">
            The new Request Id - <?php echo $requestId; ?>
        </div>
        <br />
        <br />
    <?php } elseif(!isset($noResults)) { ?>
        <div class="container-fluid col-sm-10">
            <h3>Latests Requests:</h3>
        </div>
    <?php } elseif(isset($noResults) && $noResults) { ?>
        <div class="container-fluid col-sm-10">
            <h3>No results with search criteria.</h3>
        </div>
    <?php } ?>

    <div class="col-sm-12">
    <?php if($deploymentRequests){ ?>
        <table class="table table-condensed table-responsive table-bordered">
            <thead>
            <tr> 		
                <?php foreach($deploymentRequests[0]['ApplicationDeploymentfileStatus'] as $columnName => $value){ ?>
                    <th><?php echo $columnName;?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php 
            foreach($deploymentRequests as $deploymentRequest){ ?>
            <tr>
                <?php 
                    foreach($deploymentRequest['ApplicationDeploymentfileStatus'] as $columnName => $value){  ?>
                        <?php if($columnName == "Request_ID") { ?>
                            <td><a href = "/applicationmonitor/verifydeployment/<?php echo $value;?>"><?php echo $value;?></a></td>
                        <?php } else { ?>
                            <td><?php echo $value;?></td>
                        <?php } ?>
                <?php } ?>
            </tr>
        </tbody>
        <?php } ?>
        </table>
    <?php } ?>
    </div>
</div>