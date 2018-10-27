<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li <?php if($this->action == 'index'){ ?>class="active" <?php }?>><a href="/batchgoals">Batch Goals</a></li>
      <li <?php if($this->action == 'batchgoalschedule'){ ?>class="active" <?php }?>><a href="/batchgoals/batchgoalschedule">Batch Goals Schedule</a></li>
    </ul>
  </div>
</nav>