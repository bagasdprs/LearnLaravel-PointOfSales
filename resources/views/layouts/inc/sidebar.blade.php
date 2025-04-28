  <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link collapsed" href="/dashboard">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          {{--  Super Admin  --}}
          @if (auth()->user()->role_id == 1)
              <li class="nav-item">
                  <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="/categories">
                              <i class="bi bi-circle"></i><span>Category</span>
                          </a>
                      </li>
                      <li>
                          <a href="/user">
                              <i class="bi bi-circle"></i><span>User</span>
                          </a>
                      </li>
                      <li>
                          <a href="/role">
                              <i class="bi bi-circle"></i><span>Roles</span>
                          </a>
                      </li>
                      <li>
                          <a href="/products">
                              <i class="bi bi-circle"></i><span>Product</span>
                          </a>
                      </li>
                      {{--  <li>
                          <a href="/report">
                              <i class="bi bi-circle"></i><span>Report Orders</span>
                          </a>
                      </li>  --}}

                  </ul>
              </li><!-- End Components Nav -->
          @endif

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Order List</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                  <li>
                      <a href="/report">
                          <i class="bi bi-circle"></i><span>Order Details</span>
                      </a>
                  </li>
          </li>

          {{-- KASIR --}}
          @if (auth()->user()->role_id == 3)
              <li class="nav-item">
                  <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                      <i class="bi bi-journal-text"></i><span>POS Manage</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                      <li>
                          <a href="/kasir">
                              <i class="bi bi-circle"></i><span>POS</span>
                          </a>
                      </li>

                      <li>
                          <a href="#">
                              <i class="bi bi-circle"></i><span>POS Sale</span>
                          </a>
                      </li>

                  </ul>
              </li>
          @endif

          <!-- End Forms Nav -->

          {{--  PIMPINAN  --}}
          @if (auth()->user()->role_id == 2)
              <li class="nav-heading">Stock & Reports</li>
              <li class="nav-item">
                  <a class="nav-link collapsed" data-bs-target="#stock-reports-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-menu-button-wide"></i><span>Stock & Reports</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="stock-reports-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('products.index') }}">
                              <i class="bi bi-circle"></i><span>Stock Product</span>
                          </a>
                      </li>
                      <li>
                          <a href="/report">
                              <i class="bi bi-circle"></i><span>Report Orders</span>
                          </a>
                      </li>
                  </ul>
              </li>
          @endif




      </ul>

  </aside>
