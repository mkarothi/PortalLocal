<?php

// Also used for the action storagebilling

?>

<div class="content-center-div">
    
<div class="search-fields-div-double">
        <?php echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/vmguest") ); ?>
        <div class="search-fields-div-single-label-short">VM Guest Search :</div>
        <div class="clear"></div>
        <div class="search-fields-div-double-textbox"><?php echo $this->Form->input('vmguestsearch', array("label" => false)); ?></div>
        
        <?php echo $this->Form->end() ; ?>
        <div class="clear"></div>
        <div class="bulksearch-link-double"><a href="/vmreports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkvmguest" class="bulksearch-link">Bulk VM Guest Search</a></div>
</div>
<div class="search-fields-div-double">
        <?php echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/host") ); ?>
        <div class="search-fields-div-single-label-short">ESX Host Search :</div>
        <div class="clear"></div>
        <div class="search-fields-div-double-textbox"><?php echo $this->Form->input('hostsearch', array("label" => false)); ?></div>
        
        <?php echo $this->Form->end() ; ?>
        <div class="clear"></div>
        <div class="bulksearch-link-double"><a href="/vmreports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkhost" class="bulksearch-link">Bulk ESX Host Search</a></div>
</div>
<div class="search-fields-div-double">
        <?php echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/vcenter") ); ?>
        <div class="search-fields-div-single-label-short">VCenter Search :</div>
        <div class="clear"></div>
        <div class="search-fields-div-double-textbox"><?php echo $this->Form->input('vcentersearch', array("label" => false)); ?></div>
        
        <?php echo $this->Form->end() ; ?>
        <div class="clear"></div>
        <div class="bulksearch-link-double"><a href="/vmreports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkvcenter" class="bulksearch-link">Bulk VCenter Search</a></div>
</div>
<!--
<div class="search-fields-div-double">
        <?php echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/app") ); ?>
        <div class="search-fields-div-single-label-short">App Search :</div>
        <div class="clear"></div>
        <div class="search-fields-div-double-textbox"><?php echo $this->Form->input('appsearch', array("label" => false)); ?></div>
        
        <?php echo $this->Form->end() ; ?>
        <div class="clear"></div>
        <div class="bulksearch-link-double"><a href="/vmreports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkapp" class="bulksearch-link">Bulk App Search</a></div>
</div>

<div class="search-fields-div-double">
        <?php echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/os") ); ?>
        <div class="search-fields-div-single-label-short">Operating System Search :</div>
        <div class="clear"></div>
        <div class="search-fields-div-double-textbox"><?php echo $this->Form->input('ossearch', array("label" => false)); ?></div>
        
        <?php echo $this->Form->end() ; ?>
        <div class="clear"></div>
        <div class="bulksearch-link-double"><a href="/vmreports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulkos" class="bulksearch-link">Bulk Operating System Search</a></div>
</div>

<div class="search-fields-div-double">
        <?php echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/lcs") ); ?>
        <div class="search-fields-div-single-label-short">Server LifeCycle Status Search :</div>
        <div class="clear"></div>
        <div class="search-fields-div-double-textbox"><?php echo $this->Form->input('lcssearch', array("label" => false)); ?></div>
        
        <?php echo $this->Form->end() ; ?>
        <div class="clear"></div>
        <div class="bulksearch-link-double"><a href="/vmreports/<?php echo $fromTable; ?>/<?php echo $this->request->params['action'];?>/bulklcs" class="bulksearch-link">Bulk Server LifeCycle Status Search</a></div>
</div> -->

<?php if(!$fromSearch){ //debug($reportType);?>
<br />
<br />
<div class="bulk-results">
<?php if($reportType == "bulkvcenter"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkvcenter") ); ?>
        <div style="float:left;">Bulk VCenter Search :</div>
        <?php 
        echo $this->Form->input('bulkvcentersearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulkvmguest"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkvmguest") ); ?>
        <div style="float:left;">VM Guest Search :</div>
        <?php
        echo $this->Form->input('bulkvmguestsearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulkapp"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkapp") ); ?>
        <div style="float:left;">Bulk Apps Search :</div>
        <?php
        echo $this->Form->input('bulkappsearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulkbu"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkbu") ); ?>
        <div style="float:left;">Bulk Business Units Search :</div>
        <?php
        echo $this->Form->input('bulkbusearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulklc"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulklc") ); ?>
        <div style="float:left;">Bulk Servers LCS Search :</div>
        <?php
        echo $this->Form->input('bulklcsearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulklanid"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulklanid") ); ?>
        <div style="float:left;">Bulk LAN-IDs Search :</div>
        <?php
        echo $this->Form->input('bulklanidsearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulkqtree"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkqtree") ); ?>
        <div style="float:left;">Bulk Qtrees Search :</div>
        <?php
        echo $this->Form->input('bulkqtreesearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulkos"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkos") ); ?>
        <div style="float:left;">Bulk Operating System Search :</div>
        <?php
        echo $this->Form->input('bulkossearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
<?php if($reportType == "bulkhost"){
        echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/$fromTable/". $this->request->params['action'] ."/bulkhost") ); ?>
        <div style="float:left;">Bulk ESX Host Search :</div>
        <?php
        echo $this->Form->input('bulkhostsearch', array("label" => false, "type" => "textarea", "rows" => 20, "cols"=>"75")); 
        echo "<br/>";
        echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/btn_submit.png", 'label'=> false));
        echo $this->Form->end() ;
        ?>
<?php } ?>
</div>
<?php } ?>

<?php if($fromSearch){ ?>
<div class="nav">
    <ul id="menu">
        <?php $iterator = 1;?>
        <?php foreach($searchTablesArray as $tableName) { ?>
            <li <?php if($iterator == "1"){ echo "class='selected'";} ?>>
                <a id="link-<?php echo $iterator;  ?>" href="#"><?php 
                
                if($tableName == "CmdbInventoryData"){ 
                    echo "CMDB Info";
                }elseif($tableName == "RvtoolsVinfoData"){ 
                    echo "VM Info";
                }elseif($tableName == "RvtoolsVhostData"){ 
                    echo "ESX Host Info";
                }elseif($tableName == "RvtoolsVclusterData"){ 
                    echo "Cluster Info";
                }elseif($tableName == "RvtoolsVcpuData"){ 
                    echo "CPU Info";
                }elseif($tableName == "RvtoolsVmemoryData"){ 
                    echo "Memory Info";
                }elseif($tableName == "RvtoolsVdiskData"){ 
                    echo "Disk Info";                
                }elseif($tableName == "RvtoolsVdatastoreData"){ 
                    echo "DataStore Info";
                }elseif($tableName == "RvtoolsVhbaData"){ 
                    echo "HBA Info";
                }elseif($tableName == "RvtoolsVmultipathData"){ 
                    echo "Multipath Info";
                }elseif($tableName == "RvtoolsVpartitionData"){ 
                    echo "Partition Info";
                }elseif($tableName == "RvtoolsVnetworkData"){ 
                    echo "Network Info";
                }elseif($tableName == "RvtoolsVnickData"){ 
                    echo "NIC Info";
                }elseif($tableName == "RvtoolsVswitchData"){ 
                    echo "Switch Info";
                }elseif($tableName == "RvtoolsVportData"){ 
                    echo "Port Info";
                }elseif($tableName == "RvtoolsDvswitchData"){ 
                    echo "DV-Switch Info";
                }elseif($tableName == "RvtoolsDvportData"){ 
                    echo "DV-Port Info";
                }elseif($tableName == "RvtoolsVcdData"){ 
                    echo "CD/vDVD Info";
                }elseif($tableName == "RvtoolsVfloppyData"){ 
                    echo "Floppy Info";
                }elseif($tableName == "RvtoolsVhealthData"){ 
                    echo "Health";
                }elseif($tableName == "RvtoolsVrpData"){ 
                    echo "RP Info";
                }elseif($tableName == "RvtoolsVscVmkData"){ 
                    echo "SC_VMK Info";
                }elseif($tableName == "RvtoolsVsnapshotData"){ 
                    echo "Snapshot Info";
                }elseif($tableName == "RvtoolsVtoolsData"){
                    echo "Tools Info";
                }elseif($tableName == "DatastoreArrayData"){
                    echo "Datastore Array Info";
                }
                 ?>
                </a></li>
            <?php $iterator++;?>
        <?php } ?>
     </ul>
</div>
<?php } ?>

<div class="main">
<?php $iterator = 1;?>
<?php $hasResults = false;?>

<?php foreach($searchTablesArray as $tableName) { ?>
   
    <?php if(isset($results[$tableName]) && $results[$tableName]){ ?> 
        <?php $hasResults = true;?>
        <div class="results results-<?php echo $iterator; ?>">
        <div> 
            <table >
                <tr>
                    <td><?php 
                echo $this->Form->create("Vmreports", array("method" => "POST", "action" => "/". $searchTypes[$tableName]. "/". $this->request->params['action'] ."/$reportType", "class" => "reports-form-tag") ); 
                echo $this->Form->hidden($reportType.'search', array("value" => $searchString)); 
                echo $this->Form->hidden('export', array("value" => "export")); 
                echo $this->Form->input('button', array('type'=>'image', "src"=>"/images/Export_Button.png", 'label'=> false));
                echo $this->Form->end() ;
            ?></td>
                <td style="text-align: center;"><h2><?php echo $tableName ?> search results:</h2></td>
                </tr>
            </table>
            
        </div>
        <table class="tbl_border_gry" border="0" width="100%" cellpadding="1" cellspacing="0" align="left"  style="border-collapse: collapse;">
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
        <?php echo "<div class='results results-".$iterator."'>No results found from " . $tableName . "</div>";
    } ?>
<?php 
$iterator++;
} ?>
</div>
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
<script>
( function( $ ) {
    $( document ).ready(function() { 
        $("#cssmenu > ul > li > a").closest('li').removeClass('active');   
        var checkElement = $("#cssmenu > ul > li > a").next();
        $(this).closest('li').removeClass('active');
        checkElement.slideUp('fast');
    });
})( jQuery );;
    
</script>    
<?php } ?>