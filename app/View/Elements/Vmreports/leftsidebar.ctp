<?php if($this->request->params['action'] == "serverinventory"){ ?>
<div id="left_side">
    <h3>Search Reports</h3>
    <div class="gadget">
        <ul class="sb_menu">
            <li>
                <a href="/vmreports/global/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "global") {?>class = "sidebar-selected" <?php } ?> >Global Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Dvport/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Dvport") {?>class = "sidebar-selected" <?php } ?> >dvPort Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Dvswitch/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Dvswitch") {?>class = "sidebar-selected" <?php } ?> >dvSwitch Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vcd/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vcd") {?>class = "sidebar-selected" <?php } ?> >vCD Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vcluster/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vcluster") {?>class = "sidebar-selected" <?php } ?> >vCluster Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vcpu/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vcpu") {?>class = "sidebar-selected" <?php } ?> >vCpu Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vdatastore/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vdatastore") {?>class = "sidebar-selected" <?php } ?> >vDatastore Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vdisk/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vdisk") {?>class = "sidebar-selected" <?php } ?> >vDisk Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vfloppy/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vfloppy") {?>class = "sidebar-selected" <?php } ?> >vFloppy Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vhba/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vhba") {?>class = "sidebar-selected" <?php } ?> >vHba Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vhealth/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vhealth") {?>class = "sidebar-selected" <?php } ?> >vHealth Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vhost/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vhost") {?>class = "sidebar-selected" <?php } ?> >vHost Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vinfo/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vinfo") {?>class = "sidebar-selected" <?php } ?> >vInfo Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vmemory/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vmemory") {?>class = "sidebar-selected" <?php } ?> >vMemory Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vmultipath/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vmultipath") {?>class = "sidebar-selected" <?php } ?> >vMultipath Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vnetwork/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vnetwork") {?>class = "sidebar-selected" <?php } ?> >vNetwork Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vnick/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vnick") {?>class = "sidebar-selected" <?php } ?> >vNick Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vpartition/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vpartition") {?>class = "sidebar-selected" <?php } ?> >vPartition Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vport/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vport") {?>class = "sidebar-selected" <?php } ?> >vPort Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vrp/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vrp") {?>class = "sidebar-selected" <?php } ?> >vRp Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vscvmk/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vscvmk") {?>class = "sidebar-selected" <?php } ?> >vScvmk Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vsnapshot/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vsnapshot") {?>class = "sidebar-selected" <?php } ?> >vSnapshot Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vswitch/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vswitch") {?>class = "sidebar-selected" <?php } ?> >vSwitch Server Search</a>
            </li>
            <li>
                <a href="/vmreports/Vtools/serverinventory" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Vtools") {?>class = "sidebar-selected" <?php } ?> >vTools Server Search</a>
            </li>
        </ul>
    </div>
</div>
<?php }elseif($this->request->params['action'] == "extendedview"){ ?>
<div id="left_side">
    <h3>Search Reports</h3>
    <div class="gadget">
        <ul class="sb_menu">
            <li>
                <a href="/vmreports/global/extendedview" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "global") {?>class = "sidebar-selected" <?php } ?> >Global Server Search</a>
            </li>
            <li>
                <a href="/vmreports/storage/extendedview" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Dvport") {?>class = "sidebar-selected" <?php } ?> >Storage View</a>
            </li>
            <li>
                <a href="/vmreports/networking/extendedview" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Dvswitch") {?>class = "sidebar-selected" <?php } ?> >Networking View</a>
            </li>
            <li>
                <a href="/vmreports/server/extendedview" <?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == "Dvswitch") {?>class = "sidebar-selected" <?php } ?> >Server View</a>
            </li>
        </ul>
        
    </div>
</div>
<?php } ?> 