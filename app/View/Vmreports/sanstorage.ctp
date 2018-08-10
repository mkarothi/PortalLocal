<div class="content-center-div">
<!-- --  Array name and DevID - Respective tables except view Storage_By_Server_Stats -->

    <div class="search-fields-div-multiple">
        <?php echo $this->Form->create("Reports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/frame") ); ?>
        <div class="search-fields-div-multiple-label">Storage Frame Name :</div>
        <div class="search-fields-div-multiple-select"><?php echo $this->Form->select('framename', $frameNamesArray, array("label" => false, "div" => false)); ?></div>
        <div class="clear"></div>
        <div class="search-fields-div-multiple-label">Device ID:</div>
        <div class="search-fields-div-multiple-textbox"><?php echo $this->Form->input('deviceid', array("label" => false, "div" => false)); ?></div>
        <div class="clear"></div>
        <div class="bulksearch-link"><a href="/reports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkframe" class="bulksearch-link">Bulk Device IDs Search</a></div>
        <?php echo $this->Form->end() ;?>
   </div>

<div class="search-fields-div-single-or">
<div class = "or-text-div" > OR </div>
<!-- OR
--  Host from View Storage_By_Server_Stats -->

<div class="search-fields-div-single">
    <?php echo $this->Form->create("Reports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/storagehost") ); ?>
    <div class="search-fields-div-single-label-short">Host Name:</div>
    <div class="search-fields-div-single-textbox"><?php echo $this->Form->input('storagehost', array("label" => false, "div" => false)); ?></div>
    <div class="clear"></div>
    <div class="bulksearch-link"><a href="/reports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkstoragehost" class="bulksearch-link">Bulk Storage Hosts Search</a></div>
    <?php echo $this->Form->end() ;?>
</div>

</div>
<div class="search-fields-div-single-or">
<div class="or-text-div"> OR </div>
<!-- OR
--  WWN from View Storage_By_Server_Stats -->

<div class="search-fields-div-single">
    <?php echo $this->Form->create("Reports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/wwn") ); ?>
    <div class="search-fields-div-single-label-short">WWN :</div>
    <div class="search-fields-div-single-textbox"><?php echo $this->Form->input('wwn', array("label" => false, "div" => false)); ?></div>
    <div class="clear"></div>
    <div class="bulksearch-link"><a href="/reports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkwwn" class="bulksearch-link">Bulk WWNs Search</a></div>
    <?php echo $this->Form->end() ;?>
</div>
</div>
<?php if(!$fromSearch){ //debug($reportType);?>

    <?php if($reportType == "bulkframe"){ ?>
    <div style="clear:both;"></div>
    <div class="bulk-results">
        <?php echo $this->Form->create("Reports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkframe") ); ?>
            <div style="float:left;"><h3>Bulk Storage Frames Search :</h3></div>
            <div style="clear:both;"></div>
            <div style="float:left;">Storage Frame Name :
            <?php echo $this->Form->select('framename', $frameNamesArray, array("label" => false)); ?></div>
            <div style="clear:both;"></div>
            <br/>
            <div style="float:left;">
            <?php 
            echo $this->Form->input('bulkdeviceid', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
            echo "<br>";
            echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
            echo $this->Form->end() ;
            ?></div>
    </div>
    <?php }elseif($reportType == "bulkstoragehost"){ ?>
    <div style="clear:both;"></div>
    <div class="bulk-results">
        <div style="float:left;"><h3>Bulk Storage Hosts Search :</h3></div>
        <div style="clear:both;"></div>
        <?php echo $this->Form->create("Reports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkstoragehost") ); ?>
        <?php
        echo $this->Form->input('storagehost', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ; ?>
    </div>
    <?php }elseif($reportType == "bulkwwn"){ ?>
    <div style="clear:both;"></div>
    <div class="bulk-results">
        <div style="float:left;"><h3>Bulk WWNs Search : </h3></div>
        <div style="clear:both;"></div>
        <?php echo $this->Form->create("Reports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkwwn") ); ?>
        <?php
        echo $this->Form->input('wwn', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ; ?>
    </div>
    <?php } ?>
<?php } ?>

<?php $hasResults = false;?>
<?php 
// debug($searchTypes);
foreach($searchTablesArray as $tableName) { ?>
   
    <?php if(isset($results[$tableName]) && $results[$tableName]){ ?> 
        <?php $hasResults = true;?>
        <div style="clear:both;"></div>
        <div class="results">
        <table >
            <tr>
                <td><?php 
            echo $this->Form->create("Reports", array("method" => "POST", "action" => "/". $searchTypes[$tableName]. "/". $this->request->params['action'] ."/$reportType", "class" => "reports-form-tag") );
            if(in_array($reportType, array("bulkframe", "frame"))){
                echo $this->Form->hidden('framename', array("value" => $framename));
                echo $this->Form->hidden('bulkdeviceid', array("value" => $searchString)); 
            }elseif(in_array($reportType, array("bulkstoragehost", "storagehost"))){
                echo $this->Form->hidden('storagehost', array("value" => $searchString));
            }elseif(in_array($reportType, array("bulkwwn", "wwn"))){
                echo $this->Form->hidden('wwn', array("value" => $searchString));
            }
            echo $this->Form->hidden('export', array("value" => "export")); 
            echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/Export_Button.png", 'label'=> false));
            echo $this->Form->end() ;
        ?></td>
            <td style="text-align: center;"><h2><?php echo strtoupper($tableName) ?> search results:</h2></td>
            </tr>
        </table>
            
        <table class="tbl_border_gry" border="0" width="100%" cellpadding="1" cellspacing="0" align="left">
            <tr>
                <?php foreach($results[$tableName][0][$tableName] as $fieldNames => $values){ ?> 
                    <?php if($fieldNames == "Location"){ ?>
                        <th style="width:100px;"><?php echo ($fieldNames); ?></th>
                    <?php }else{ ?>
                        <th><?php echo ($fieldNames); ?></th>   
                    <?php } ?>
                <?php } ?>
            </tr>
            <?php foreach($results[$tableName] as $result){ ?>
                <tr>
                    <?php foreach($result[$tableName] as $values){ ?> 
                    <td><?php echo ($values); ?></td>   
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
        </div>
    <?php }elseif($fromSearch){ ?>
        <div style="clear:both;"></div>
    <?php echo "<div>No results found from " . $tableName . "</div>";
    } ?>
<?php } ?>

<?php if($hasResults){ ?>
<script>
( function( $ ) {
    $( document ).ready(function() { 
        $("#cssmenu > ul > li > a").closest('li').removeClass('active');   
        var checkElement = $("#cssmenu > ul > li > a").next();
        $(this).closest('li').removeClass('active');
        checkElement.slideUp('normal');
    });
})( jQuery );;
    
</script>    
    
<?php } ?>

</div>