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

     @if(Auth::user()->role == 'bendahara')
     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <!-- Nav Item - Pengaturan Collapse Menu -->
     <!-- Nav Item - Setting Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting"
             aria-expanded="{{ request()->is('kegiatan/*') || request()->is('akun/*') ? 'true' : 'false' }}"
             aria-controls="collapseSetting">
             <i class="fas fa-cogs"></i>
             <span>Setting</span>
         </a>
         <div id="collapseSetting"
             class="collapse {{ request()->is('kegiatan/*') || request()->is('akun/*') ? 'show' : '' }}"
             aria-labelledby="headingSetting" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Menu Setting:</h6>
                 <a class="collapse-item {{ request()->is('kegiatan/view') ? 'active' : '' }}" href="{{ url('/kegiatan/view') }}">
                     Kode Kegiatan
                 </a>
                 <a class="collapse-item {{ request()->is('akun/view') ? 'active' : '' }}" href="{{ url('/akun/view') }}">
                     Kode Akun
                 </a>
                 <a class="collapse-item {{ request()->is('kelas/view') ? 'active' : '' }}" href="{{ url('/kelas/view') }}">
                     Kelas
                 </a>
                 <a class="collapse-item {{ request()->is('jenis/view') ? 'active' : '' }}" href="{{ url('/jenis/view') }}">
                     Jenis Biaya
                 </a>
                 <a class="collapse-item {{ request()->is('siswa/view') ? 'active' : '' }}" href="{{ url('/siswa/view') }}">
                     Siswa
                 </a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'tagihan/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/tagihan/view')}}">
             </i><i class="fas fa-solid fa-credit-card"></i>
             <span>Generate Tagihan</span>
         </a>
     </li>

     <!-- Nav Item - Pembayaran Dropdown -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembayaran"
             aria-expanded="{{ request()->is('pembayaran/*') || request()->is('pagu/*') ? 'true' : 'false' }}"
             aria-controls="collapsePembayaran">
             <i class="fas fa-money-check-alt"></i>
             <span>Pembayaran</span>
         </a>
         <div id="collapsePembayaran"
             class="collapse {{ request()->is('pembayaran/*') || request()->is('pagu/*') ? 'show' : '' }}"
             aria-labelledby="headingPembayaran" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Menu Pembayaran:</h6>
                 <a class="collapse-item {{ request()->is('pembayaran/view') ? 'active' : '' }}" href="{{ url('/pembayaran/view') }}">
                     Pembayaran Tagihan
                 </a>
                 <a class="collapse-item {{ request()->is('pagu/view') ? 'active' : '' }}" href="{{ url('/pagu/view') }}">
                     Mapping RKAS ke SPP
                 </a>
             </div>
         </div>
     </li>

     <!-- Nav Item - RKAS -->
     <li class="{{ request()->is('rkas/view*') ? 'nav-item active' : 'nav-item' }}">
         <a class="nav-link" href="{{ route('rkas.view', ['kategori_id' => 1]) }}">
             <i class="fas fa-file-invoice-dollar"></i>
             <span>RKAS</span>
         </a>
     </li>


     <!-- Nav Item - Pages Collapse Menu -->

     <!-- Nav Item - Transaksi -->
     <li class="{{ request()->is('transaksi/view*') ? 'nav-item active' : 'nav-item' }}">
         <a class="nav-link" href="{{ url('/transaksi/view') }}">
             <i class="fas fa-exchange-alt"></i>
             <span>Transaksi</span>
         </a>
     </li>


     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'laporan/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/laporan/view')}}">
             </i><i class="fas fa-chart-line"></i>
             <span>Laporan</span>
         </a>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="{{'histori/view' == request()->path() ? 'nav-item active' : 'nav-item'}}">
         <a class="nav-link collapsed" href="{{url('/histori/view')}}">
             </i><i class="fas fa-calendar-alt"></i>
             <span>Histori</span>
         </a>
     </li>



     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Addons
     </div>
     @endif

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