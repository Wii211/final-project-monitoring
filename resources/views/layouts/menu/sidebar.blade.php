  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
          <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image mt-1"
          style="opacity: .8">
          <span class="brand-text font-weight-light text-white"><h6><b>Sistem Monitoring <BR>Tugas Akhir</b></h6></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  @if(Auth::user()->image_profile !== null)
                  <img src="{{ asset('storage/'.Auth::user()->image_profile) }}" class="img-circle elevation-2"
                      alt="User Image">
                  @else
                  <img src="{{ asset('storage/image_profile/default.png') }}" class="img-circle elevation-2"
                      alt="User Image">
                  @endif
              </div>
              <div class="info">
                  @if(Auth::user()->finalStudent !== null)
                  <div class="text-white d-block"><b>{{ Auth::user()->finalStudent->name }}</b></div>
                  <div class="text-white d-block text-NIM">{{ Auth::user()->finalStudent->student_id }}</div>
                  @else
                  <div class="text-white d-block"><b>{{ Auth::user()->user_name }}</b></div>
                  @endif
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  @if(Auth::user()->isStudent())
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
                      <a href="{{ route('final_project.index') }}"
                          class="nav-link {{ Request::is('student/final_project') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Proposal/Tugas Akhir
                          </p>
                      </a>
                  </li>
                  @endif
                  @if(Auth::user()->isCoordinator())
                  <li class="nav-item">
                      <a href="{{ route('coordinator_dashboard.index') }}"
                          class="nav-link {{ Request::is('coordinator') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                              Home
                          </p>
                      </a>
                  </li>
                  @endif
                  <li class="nav-item">
                      <a href="{{ route('coordinator.recomendation-title.index') }}"
                          class="nav-link {{ Request::is('recomendation-title') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-graduate"></i>
                          <p>
                              Rekomendasi Topik/Judul
                          </p>
                      </a>
                  </li>
                  @if(Auth::user()->isCoordinator())
                  <li class="nav-item">
                      <a href="{{ route('final_actives.index') }}"
                          class="nav-link {{ Request::is('coordinator/final_projects') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Tugas Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('final_students_verify.index') }}"
                          class="nav-link {{ Request::is('coordinator/final_projects/students*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-graduate"></i>
                          <p>
                              Pendaftaran Mahasiswa
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('final_schedules.index') }}"
                          class="nav-link {{ Request::is('coordinator/final_projects/schedules') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar-alt"></i>
                          <p>
                              Seminar Proposal/Sidang TA
                          </p>
                      </a>
                  </li>
                  @endif
                  @if(Auth::user()->isAdmin())
                  <li class="nav-header">DATA</li>
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
                      <a href="{{ route('lecturers.index') }}"
                          class="nav-link {{ Request::is('data/lecturers') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Data Dosen
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('students.index') }}"
                          class="nav-link {{ Request::is('data/students') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Data Mahasiswa
                          </p>
                      </a>
                  </li>
                  @endif
                  <li class="nav-header">PROFILE</li>
                  <li class="nav-item">
                      <a href="{{ route('change_profile.index') }}"
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