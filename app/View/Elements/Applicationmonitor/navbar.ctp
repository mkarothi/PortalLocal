<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li <?php if($this->action == 'index'){ ?>class="active" <?php }?>><a href="/applicationmonitor">Application Monitoring</a></li>
      <li <?php if($this->action == 'appconfigurations'){ ?>class="active" <?php }?>><a href="/applicationmonitor/appconfigurations">Application Configurations</a></li>
    </ul>
  </div>
</nav>
