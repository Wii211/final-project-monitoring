  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="index3.html" class="brand-link">
          {{-- <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">TEMON </span> --}}
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ Auth::user()->image_profile }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <div class="text-white d-block">{{ Auth::user()->user_name }}</div>
                  <div class="text-white d-block text-NIM">1610817110001</div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-header">Mahasiswa</li>
                  <li class="nav-item">
                      <a href="{{ route('final_registration.index') }}" 
                        class="nav-link {{ Request::is('student') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                            Home
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('pre_proposal.index') }}" 
                      class="nav-link {{ Request::is('student/pre_proposal') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-sticky-note"></i>
                          <p>
                            Pra-Proposal
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="studentFinalProject" href="{{ route('final_project.index') }}" 
                      class="nav-link {{ Request::is('student/final_project') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Tugas Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">Koordinator TA</li>
                  <li class="nav-item">
                      <a id="coorHome" href="{{ route('coordinator_dashboard.index') }}"
                      class="nav-link {{ Request::is('coordinator') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                            Home
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="coorFinalProjectStudent" href="{{ route('final_students.index') }}" 
                      class="nav-link {{ Request::is('coordinator/final_projects/students*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-graduate"></i>
                          <p>
                            Mahasiswa TA
                            <span class="badge badge-danger right">2</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="coorFinalProject" href="{{ route('final_actives.index') }}"
                      class="nav-link {{ Request::is('coordinator/final_projects') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                            Tugas Akhir
                            <span class="badge badge-danger right">2</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="coorFinalProjectSchedule" href="{{ route('final_schedules.index') }}"
                      class="nav-link {{ Request::is('coordinator/final_projects/schedules') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar-alt"></i>
                          <p>
                            Seminar Proposal/Sidang TA
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">Datas</li>
                  <li class="nav-item">
                      <a id="finalProject" href="{{ route('final_projects.index') }}"
                      class="nav-link {{ Request::is('data/final_projects') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Data Tugas Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="lecturer" href="{{ route('lecturers.index') }}" 
                      class="nav-link {{ Request::is('data/lecturers') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Data Dosen
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="student" href="{{ route('students.index') }}" 
                      class="nav-link {{ Request::is('data/students') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Data Mahasiswa
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">PROFILE</li>
                  <li class="nav-item">
                      <a id="changeProfile" href="{{ route('change_profile.index') }}"
                            class="nav-link {{ Request::is('profile/change_profile') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-key"></i>
                          <p>
                              Profil Saya
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="changePassword" href="{{ route('change_password.index') }}"
                      class="nav-link {{ Request::is('profile/change_password') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-key"></i>
                          <p>
                              Ganti Password
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>