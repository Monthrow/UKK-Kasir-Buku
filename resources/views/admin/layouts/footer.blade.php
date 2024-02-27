<footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    UKK &copy; 2024
                    <a href="." class="link-secondary">Kasir Buku</a>.
                    Ahmad Arif Dhuha XII RPL 1/04
                  </li>
                  
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="/vendor/jquery.min.js"></script>
    <script src="/vendor/datatables/datatables.min.js"></script>
    <script src="/vendor/datatables/Datatables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <!-- Tabler Core -->
    <script src="/vendor/admin/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/vendor/admin/dist/js/demo.min.js?1692870487" defer></script>

    @stack('script')

    @if(session('berhasil'))
    <script>
      window.open("/aplikasikasir/transaksi/{{session('berhasil')}}/print")
    </script>
    @endif
  </body>
</html>