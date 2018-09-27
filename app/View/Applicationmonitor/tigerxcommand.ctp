<div class="col-sm-11 text-left">
    <br />
    <br />
    <?php
        echo $this->Form->create("Reports", array("method" => "POST") ); ?>
            
        <div class="col-sm-3 text-left">
            <div class ="form-group">
            <?php echo $this->Form->input('bulksharenamesearch', array("label" => false, "type" => "textarea", "rows" => 10, "cols"=>"50")); ?> 
        </div>
        </div>
        <div class="col-sm-2 text-right">
            <div class ="form-group">
                <?php echo $this->Form->input('bulksharenamesearch', array("label" => false, "type" => "text")); ?> 
            </div>
            <div class ="form-group">
                <?php echo $this->Form->input('bulksharenamesearch', array("label" => false, "type" => "text")); ?> 
            </div>
            <div class ="form-group">
                <?php echo $this->Form->input('bulksharenamesearch', array("label" => false, "type" => "text")); ?> 
            </div>
            <div class="text-right">
                <button type="button" class="btn" id="submit">Submit</button>
            </div>
        </div>
        <?php echo $this->Form->end() ; ?>
</div>