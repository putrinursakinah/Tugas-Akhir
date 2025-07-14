 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">SMK ALAWIYAH</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Dropdown Tahun Ajaran -->
     <li class="nav-item px-3 py-2">
         <form action="{{ route('tahun.store') }}" method="POST">
             @csrf
             <label for="sidebarTahun" class="text-white small">Set Tahun</label>
             <select name="tahun" id="sidebarTahun" class="form-control form-control-sm" onchange="this.form.submit()">
                 @foreach(range(date('Y'), date('Y') - 5) as $year)
                 <option value="{{ $year }}" {{ session('tahun_aktif', date('Y')) == $year ? 'selected' : '' }}>
                     {{ $year }}
                 </option>
                 @endforeach
             </select>
         </form>
     </li>

     <!-- Nav Item - Dashboard -->
     <li class="{{'dashboard' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link" href="{{url('/dashboard')}}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <!-- Nav Item - Pengaturan Collapse Menu -->

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'identitas/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/identitas/view')}}">
             </i><i class="fas fa-solid fa-user"></i>
             <span>Identitas</span>
         </a>
     </li>


     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'kegiatan/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/kegiatan/view')}}">
             </i><i class="fas fa-solid fa-chart-line"></i>
             <span>Kode Kegiatan</span>
         </a>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'akun/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/akun/view')}}">
             </i><i class="fas fa-solid fa-credit-card"></i>
             <span>Kode Akun</span>
         </a>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'siswa/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/siswa/view')}}">
             </i><i class="fas fa-solid fa-credit-card"></i>
             <span>Siswa</span>
         </a>
     </li>



     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'rkas/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/rkas/view')}}">
             </i><i class="fas fa-solid fa-users"></i>
             <span>RKAS</span>
         </a>
     </li>

     <!-- Nav Item - Pages Collapse Menu -->

     <li class="{{'transaksi/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/transaksi/view')}}">
             </i><i class="fas fa-solid fa-users"></i>
             <span>Transaksi</span>
         </a>
     </li>

     <!-- <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="lni lni-chevron-down"></i>
             Transaksi
         </a>

     </li> -->


     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'laporan/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/laporan/view')}}">
             </i><i class="fas fa-solid fa-users"></i>
             <span>Laporan</span>
         </a>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'histori/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/histori/view')}}">
             </i><i class="fas fa-solid fa-users"></i>
             <span>Histori</span>
         </a>
     </li>



     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Addons
     </div>

     <!-- Nav Item - Pages Collapse Menu -->


     <!-- Nav Item - Charts -->
     <li class="nav-item ">
         <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
             <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                 {{ csrf_field() }}
             </form>
             <i class="fas fa-solid fa-door-closed"></i>
             <span>Log Out</span>
         </a>
     </li>





 </ul>
 <!-- End of Sidebar -->