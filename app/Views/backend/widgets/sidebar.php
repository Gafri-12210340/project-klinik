 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-reguler fa-hospital"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Sistem Informasi Klinik<sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=base_url('dashboard')?>">
        <i class="fas fa-regular fa-home"></i>
        <span>Halaman Utama</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Halaman
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-reguler fa-stethoscope"></i>
        <span>Dokter</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-warning py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Dokter:</h6>
            <a class="collapse-item" href="<?=site_url('dokter')?>">Data Dokter</a>
            <a class="collapse-item" href="<?=site_url('poli')?>"> Data Poli</a>
            <a class="collapse-item" href="<?=site_url('polidokter')?>">Data Poli Dokter</a>
            <a class="collapse-item" href="<?=site_url('spesialis')?>">Data Spesialis</a>
            <a class="collapse-item" href="<?=site_url('spesialisdokter')?>">Data Spesialis Dokter</a>
            <a class="collapse-item" href="<?=site_url('jadwalpraktek')?>">Jadwal Praktek</a>
            
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-reguler fa-user-nurse"></i>
        <span>Petugas</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Petugas:</h6>
            <a class="collapse-item" href="<?=site_url('petugas')?>">Data Petugas</a>
            <a class="collapse-item" href="<?=site_url('jasabarang')?>">Data Jasa Barang</a>
            <a class="collapse-item" href="<?=site_url('rinciantagihan')?>">Data Rincian Tagihan</a>
           
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepasien"
        aria-expanded="true" aria-controls="collapsepasien">
        <i class="fas fa-reguler fa-bed"></i>
        <span>Pasien</span>
    </a>
    <div id="collapsepasien" class="collapse" aria-labelledby="headingpasien"
        data-parent="#accordionSidebar">
        <div class="bg-danger py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Pasien:</h6>
            <a class="collapse-item" href="<?=site_url('pasien')?>">Data Pasien</a>
            <a class="collapse-item" href="<?=site_url('pendaftarankonsultasi')?>">Pendaftaran Konsultasi</a>
            <a class="collapse-item" href="<?=site_url('rekammedis')?>">Data Rekammedis</a>
            <a class="collapse-item" href="<?=site_url('tagihan')?>">Data Tagihan</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
