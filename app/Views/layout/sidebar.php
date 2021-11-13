<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PUSKESWAN</sup></div>
    </a>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        MAINTENANCE
    </div>
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
            <i class="fas fa-fw fa-cog"></i>
            <span>Accounts</span>
        </a>
        <div id="collapseAccount" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Accounts</h6>
                <a class="collapse-item" href="<?= base_url('/manage/roles'); ?>">Roles</a>
                <a class="collapse-item" href="<?= base_url('/manage/accounts'); ?>">Accounts</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users</h6>
                <a class="collapse-item" href="<?= base_url('/manage/owners'); ?>">Owners</a>
                <a class="collapse-item" href="<?= base_url('/manage/doctors'); ?>">Doctors</a>
                <a class="collapse-item" href="<?= base_url('/manage/nurses'); ?>">Nurses</a>
                <a class="collapse-item" href="<?= base_url('/manage/staffs'); ?>">Staffs</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePets" aria-expanded="true" aria-controls="collapsePets">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pets</span>
        </a>
        <div id="collapsePets" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pets</h6>
                <a class="collapse-item" href="<?= base_url('/manage/types'); ?>">Pets Types</a>
                <a class="collapse-item" href="<?= base_url('/manage/breeds'); ?>">Pets Breeds</a>
                <a class="collapse-item" href="<?= base_url('/manage/pets'); ?>">Pets</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog"></i>
            <span>Medicals</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Medicals</h6>
                <a class="collapse-item" href="<?= base_url('/manage/diseases'); ?>">Disease</a>
                <a class="collapse-item" href="<?= base_url('/manage/medicines'); ?>">Medicines</a>
                <a class="collapse-item" href="<?= base_url('/manage/tools'); ?>">Medical Devices</a>
                <a class="collapse-item" href="<?= base_url('/manage/rooms'); ?>">Rooms</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        TRANSACTION
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrans" aria-expanded="true" aria-controls="collapseTrans">
            <i class="fas fa-fw fa-cog"></i>
            <span>Check Health</span>
        </a>
        <div id="collapseTrans" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Setup</h6>
                <a class="collapse-item" href="<?= base_url('/transaction/registration'); ?>">Registration</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->