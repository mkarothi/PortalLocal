<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li <?php if($this->action == 'index'){ ?>class="active" <?php }?>><a href="/ops">Ops Excellence</a></li>
      <li <?php if($this->action == 'jobreport'){ ?>class="active" <?php }?>><a href="/ops/jobreport">Exception Job Report</a></li>
      <li <?php if($this->action == 'jobschedules'){ ?>class="active" <?php }?>><a href="/ops/jobschedules">Job Schedules</a></li>
    </ul>
  </div>
</nav>