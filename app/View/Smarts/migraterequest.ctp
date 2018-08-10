<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <script src="/js/jquery/jquery-1.7.2.min.js"></script>
        <?php echo $this->Html->css("/css/datepicker/jquery-ui-1.8.6.custom.css", null, array("inline" => true)); ?>
        <?php echo $this->Html->script('/js/jquery/jquery-ui-1.8.6.custom.min.js', array('inline' => true)); ?>
        <?php echo $this->Html->script('/js/jquery/jquery-ui-timepicker-addon.js', array('inline' => true)); ?>
        <title></title>
        <link rel="stylesheet" type="text/css" href="/css/report_style.css" />
    </head>
    <body>
    <style>
    body, html { 
      height: 100%; 
      width:100%;
    }
    
    body { 
      display: table; 
    }
    table { 
      display: table-cell;
      vertical-align: middle;
      height: 80%;
      width: 100%;
    }
    </style>
    
    <?php if(!$saveSuccess){ ?>
        
    
    <div class="mainbar">
        <div class="article">
            <?php echo $this->Form->create("Smarts", array("method" => "POST", 
                                                           // "action" => "/". $this->request->params['action'] ."/serverslist"
                                                           ) ); ?>
                
              <div>
                <?php echo $this->Form->hidden('serverslist', array( "value" =>$serverslist)); ?>
                <?php echo $this->Form->hidden('email_id', array( "value" =>$emails)); ?>
              </div>
              <div>
                <label for="email">Start Date</label>
                <?php echo $this->Form->input('start_date', array("label" => false, "class" => "text", "required" =>true)); ?>
              </div>
              <div>
                <label for="phone">End Date</label>
                <?php echo $this->Form->input('end_date', array("label" => false, "class" => "text")); ?>                
              </div>
              
              <div class="bottomButton">
                  <div class="submit">
                    <input type="submit" name="imageField" id="imageField" />
                  </div>
              </div>
          <?php echo $this->Form->end() ; ?>
        </div>
      </div>
      <?php } else { ?>
          <div class="success-message"> Successfully Updated with reference id: <?php echo $saveSuccess; ?></div>
      <?php } ?>
      
    <script>
        $(document).ready(function(){
            $('#SmartsStartDate').datetimepicker({
                showSecond: false,
                showMinute: false,
                showHour: false,
                timeFormat: '',
                beforeShow: function(input, inst) {
                    $.datepicker._pos = $.datepicker._findPos(input);
                    $.datepicker._pos[1] = $.datepicker._pos[1] - 245;
                }
            
            });
            
            $('#SmartsEndDate').datetimepicker({showSecond: false, showMinute: false, showHour:false, timeFormat: '', beforeShow: function(input, inst)
            {
                $.datepicker._pos = $.datepicker._findPos(input);
                $.datepicker._pos[1] = $.datepicker._pos[1] - 245   ;
            
            } });
        });
    </script>
    </body>
</html>
