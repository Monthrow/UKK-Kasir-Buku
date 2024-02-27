<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h2><b>Dashboard</b></h2>


                    <div class="col-12">
                                    <div class="row row-cards">
                                      <div class="col-sm-6 col-lg-6">
                                        <div class="card card-sm bg-primary">
                                          <div class="card-body">
                                            <div class="row align-items-center">
                                              <div class="col-auto">
                                                <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                <i class="nav-icon fas fa-users"></i>
                                                </span>
                                              </div>
                                              <div class="col">
                                                <div class="font-weight-medium text-white">
                                                  Jumlah User
                                                </div>
                                                <div class="text-light">
                                                  {{ $userCount }}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="col-sm-6 col-lg-6">
                                        <div class="card card-sm bg-primary">
                                          <div class="card-body">
                                            <div class="row align-items-center">
                                              <div class="col-auto">
                                                <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                <i class="nav-icon fas fa-book"></i>
                                                </span>
                                              </div>
                                              <div class="col">
                                                <div class="font-weight-medium text-white">
                                                  Jumlah Produk
                                                </div>
                                                <div class="text-light">
                                                  {{ $produk }}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-sm-6 col-lg-6">
                                        <div class="card card-sm bg-primary">
                                          <div class="card-body">
                                            <div class="row align-items-center">
                                              <div class="col-auto">
                                                <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                <i class="nav-icon fas fa-cash-register"></i>
                                                </span>
                                              </div>
                                              <div class="col">
                                                <div class="font-weight-medium text-white">
                                                  Jumlah Transaksi Keseluruhan
                                                </div>
                                                <div class="text-light">
                                                  {{ $totalTransaksi }}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-sm-6 col-lg-6">
                                        <div class="card card-sm bg-primary">
                                          <div class="card-body">
                                            <div class="row align-items-center">
                                              <div class="col-auto">
                                                <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                <i class="nav-icon fas fa-calendar-day"></i>
                                                </span>
                                              </div>
                                              <div class="col">
                                                <div class="font-weight-medium text-white">
                                                  Jumlah Transaksi Hari Ini
                                                </div>
                                                <div class="text-light">
                                                  {{ $td }}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-sm-6 col-lg-6">
                                        <div class="card card-sm bg-primary">
                                          <div class="card-body">
                                            <div class="row align-items-center">
                                              <div class="col-auto">
                                                <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                <i class="nav-icon fas fa-wallet"></i>
                                                </span>
                                              </div>
                                              <div class="col">
                                                <div class="font-weight-medium text-white">
                                                Pendapatan Hari Ini
                                                </div>
                                                <div class="text-light">
                                                Rp.{{ format_rupiah($totalBiayaPembelian) }}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                    </div>
                                  </div>

                                  
                                    
                                  

                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->