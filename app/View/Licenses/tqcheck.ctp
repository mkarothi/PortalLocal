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
	</div> -->
<div class="nav">
		<ul id="menu">
				<?php $iterator = 1;?>
				<?php foreach($searchTablesArray as $tableName) { ?>
						<li <?php if($iterator == "1"){ echo "class='selected'";} ?>><a id="link-<?php echo $iterator;  ?>" href="#"><?php echo str_replace("Stat", "", str_replace("Storage", "", $tableName))?></a></li>
						<?php $iterator++;?>
				<?php } ?>
		</ul>
</div>


<div class="main">
<?php $iterator = 1;?>
<?php $hasResults = false;?>
<?php 
foreach($searchTablesArray as $tableName) { ?>
   
		<?php 
		if(isset($results[$tableName]) && $results[$tableName]){ ?> 
        <?php $hasResults = true;?>
        <div class="results results-<?php echo $iterator; ?>">
            
            
        <table class="tbl_border_gry table table-condensed table-responsive table-bordered">
            <tr>
                <?php foreach($results[$tableName][0][$tableName] as $fieldNames => $values){ ?> 
                        <th><?php echo ($fieldNames); ?></th>   
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
    <?php }else{ ?>
    <?php echo "<div class='results results-".$iterator."'>No results found from " . $tableName . "</div>";
    } ?>
<?php 
$iterator++;
} ?>
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
  
	$('#menu a').click(function(e){
			e.preventDefault();
			$('#menu a').parent().removeClass("selected")
			$(this).parent().addClass("selected")
			var i = $(this).attr("id").split("-")[1];
			$(".results").hide();
			$(".results-"+i).show();
	});
	$(".results").hide();
	$(".results-1").show();

});
</script>