<?php

// Also used for the action storagebilling

?>

<div class="content-center-div">
    
<div class="main">
<?php $iterator = 1;
//debug($searchString);
?>
<?php $hasResults = false;?>
<?php foreach($searchTablesArray as $tableName) { ?>
   
    <?php if(isset($results[$tableName]) && $results[$tableName]){ ?> 
        <?php $hasResults = true;?>
        <div class="results results-<?php echo $iterator; ?>" > 
        <div> 
            <table >
                <tr>
                    <td><?php 
                            echo $this->Form->create("Smarts", array("method" => "POST", "action" => "/". $searchTypes[$tableName]. "/". $this->request->params['action'] ."/$reportType", "class" => "reports-form-tag") ); 
                            echo $this->Form->hidden($reportType, array("value" => $searchString)); 
                            echo $this->Form->hidden('export', array("value" => "export")); 
                            echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/Export_Button.png", 'label'=> false));
                            echo $this->Form->end() ;
                        ?>
                    </td>
                <td style="text-align: center;"><h2><?php echo $tableName ?> search results:</h2></td>
                </tr>
            </table>
            
        </div>
        <table class="tbl_border_gry" border="0" width="100%" cellpadding="1" cellspacing="0" align="left" style="border-collapse: collapse;">
            <thead>
            <tr>
                <?php 
                // debug($results);
                if(isset($results[$tableName][0]['CmdbServerData'])){ ?>
                    <?php foreach($results[$tableName][0]['CmdbServerData'] as $fieldNames => $values){ ?>
                            <th style="background-color: #959595;"><?php echo ($fieldNames); ?></th>
                    <?php } ?>
                    <?php foreach($results[$tableName][0]['SanStorageBillingData'] as $fieldNames => $values){ ?>
                            <th style="background-color: #959595;"><?php echo ($fieldNames); ?></th>
                    <?php } ?>
                    <?php foreach($results[$tableName][0][$tableName] as $fieldNames => $values){ ?> 
                            <th style="background-color: #959595;"><?php echo ($fieldNames); ?></th>   
                    <?php } ?>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($results[$tableName] as $key => $result){ ?>
                <tr>
                    <?php foreach($result['CmdbServerData'] as $fieldNames => $values){ ?> 
                            <td><?php echo ($values) ? ($values) : "-N/A-" ; ?></td>   
                    <?php } ?>
                    <?php foreach($result['SanStorageBillingData'] as $fieldNames => $values){ ?> 
                            <td><?php echo ($values) ? ($values) : "-N/A-" ; ?></td>   
                    <?php } ?>
                <?php $urlString = "";
                      foreach($result[$tableName] as $fieldNames => $values){ 
                        if($fieldNames == 'AppOwner_Email_Group') {  
                            $urlString .= $result[$tableName]["AppOwner_Email_Group"] .";";                           
                        } ?>
                        <td><?php echo ($values) ? ($values) : "-N/A-" ; ?></td>   
                <?php }  ?>
                <?php  $urlString = "?emails=".urlencode($urlString); ?>
                  
                </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    <?php }elseif($fromSearch){ ?>
        <?php echo "<div class='results results-".$iterator."'>No results found from " . $tableName . "</div>";
    } ?>
<?php 
    $iterator++;
} 
?>
</div> 
<?php if(!$hasResults){ ?> 

<div class="bulk-results">

    <?php if($reportType == "serverslist"){
        echo $this->Form->create("Smarts", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/serverslist") ); ?>
        <div style="float:left;">Servers List :</div>
        <?php 
        echo $this->Form->input('serverslist', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>

</div>

<?php }?>
</div>

<script>
    $( document ).ready(function() { 
        $('#menu a').click(function(e){
            e.preventDefault();
            $('#menu a').parent().removeClass("selected")
            $(this).parent().addClass("selected")
            var i = $(this).attr("id").split("-")[1];
            $(".results").hide();
            $(".results-"+i).show();
        });
    });
</script> 

<?php if($hasResults){ ?>
    
    <?php 
          $searchArray = explode("\n", $searchString);
          $searchString = implode("||", $searchArray);
    ?>
    <div class="bottomButton">
        <div class="submit">
            <a class="serverdetails" href="/smarts/migraterequest/<?php echo $urlString ;?>&serverslist=<?php echo urlencode($searchString); ?>">Start Migration Project</a>
        </div>
    </div>
    
<script>
( function( $ ) {
    $( document ).ready(function() { 
        $("#cssmenu > ul > li > a").closest('li').removeClass('active');   
        var checkElement = $("#cssmenu > ul > li > a").next();
        $(this).closest('li').removeClass('active');
        checkElement.slideUp('fast');
        
        $('.serverdetails').click(function(e){
            e.preventDefault();
            var urlVal = $(this).attr('href');
            window.open( urlVal,'',"resizable=yes,status=no,menubar=no,addressbar=no,scrollbars=yes,height=300,width=350,left=300,top=200");
        });
        
    });
})( jQuery );;
    
</script>    
<?php } ?>