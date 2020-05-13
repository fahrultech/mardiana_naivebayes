<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="<?php echo base_url('tingkatkecanduan');?>">
                        <i class="fi-air-play"></i><span> Tipe Kecanduan </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('gejala');?>"><i class="fi-briefcase"></i> <span> Gejala </span></a>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fi-box"></i><span> Konsultasi </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo base_url('datalatih');?>">Data Latih</a></li>
                        <li><a href="<?php echo base_url('datauji');?>">Data Uji</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('pengguna');?>"><i class="fi-head"></i><span> Pengguna </span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/logout');?>"><i class="fa fa-power-off"></i> <span> Keluar </span></a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->