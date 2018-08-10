<?php if($this->request->params['action'] == "serverinventory"){ ?>
<div id="right_side">
    <div id='cssmenu' class="sb_menu">
    <ul>
       <li class='has-sub'><a href='#'><span>Export Reports</span></a>
          <ul>
            <li>
                <a href="/vmreports/Dvport/exportsheet/">dvPort Data File</a>
            </li>
            <li>
                <a href="/vmreports/Dvswitch/exportsheet/">dvSwitch Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vcd/exportsheet/">vCD Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vcluster/exportsheet/">vCluster Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vcpu/exportsheet/">vCpu Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vdatastore/exportsheet/">vDatastore Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vdisk/exportsheet/">vDisk Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vfloppy/exportsheet/">vFloppy Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vhba/exportsheet/">vHba Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vhealth/exportsheet/">vHealth Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vhost/exportsheet/">vHost Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vinfo/exportsheet/">vInfo Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vmemory/exportsheet/">vMemory Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vmultipath/exportsheet/">vMultipath Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vnetwork/exportsheet/">vNetwork Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vnick/exportsheet/">vNick Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vpartition/exportsheet/">vPartition Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vport/exportsheet/">vPort Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vrp/exportsheet/">vRp Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vscvmk/exportsheet/">vScvmk Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vsnapshot/exportsheet/">vSnapshot Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vswitch/exportsheet/">vSwitch Data File</a>
            </li>
            <li>
                <a href="/vmreports/Vtools/exportsheet/">vTools Data File</a>
            </li>
			<li class='last'>
                <a href="/vmreports/DatastoreArray/exportsheet/">vDatastoreArray Data File</a>
            </li>
        </ul>
        </li>
        </ul>
    </div>
</div>
<?php } ?>