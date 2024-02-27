<header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="/aplikasikasir/dashboard" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Dashboard
                    </span>
                  </a>
                </li>
                @if(auth()->user()->level=='Admin')
                <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}" href="/aplikasikasir/kategori" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <i class="nav-icon fas fa-list"></i>
                    </span>

                    <span class="nav-link-title">
                      Kategori
                    </span>
                  </a>
                </li>
                @endif

                @if(auth()->user()->level=='Admin')
                <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/penerbit') ? 'active' : '' }}" href="/aplikasikasir/penerbit" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <i class="nav-icon fas fa-building"></i>
                    </span>

                    <span class="nav-link-title">
                      Penerbit
                    </span>
                  </a>
                </li>
                @endif

                @if(auth()->user()->level=='Admin')
                <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/genre') ? 'active' : '' }}" href="/aplikasikasir/genre" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <i class="nav-icon fas fa-bars"></i>
                    </span>

                    <span class="nav-link-title">
                      Genre
                    </span>
                  </a>
                </li>
                @endif

                @if(auth()->user()->level=='Admin')
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('admin/produk') ? 'active' : '' }}" href="/aplikasikasir/produk" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                    <i class="nav-icon fas fa-book"></i>
                    </span>
                  
                    <span class="nav-link-title">
                      Produk
                    </span>
                  </a>
                </li>
                @endif

                
                <li class="nav-item dropdown">
                <a class="nav-link {{ Request::is('admin/transaksi') ? 'active' : '' }}" href="/aplikasikasir/transaksi" >

                    @if(auth()->user()->level=='Kasir')
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <i class="nav-icon fas fa-cash-register"></i>
                    </span>
                    <span class="nav-link-title">
                      Transaksi
                    </span>
                    @endif

                    @if(auth()->user()->level=='Admin')
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <i class="nav-icon fas fa-file"></i>
                    </span>
                    <span class="nav-link-title">
                      Laporan
                    </span>
                    @endif
                    
                    
                  </a>
                </li>
                

                @if(auth()->user()->level=='Admin')
                <li class="nav-item dropdown">
                <a class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}" href="/aplikasikasir/user" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                    <i class="nav-icon fas fa-users"></i>
                    </span>
                    <span class="nav-link-title">
                      User
                    </span>
                  </a>
                </li>
                @endif
                
              </ul>
              
            </div>
          </div>
        </div>
      </header>
      <div class="page-wrapper">