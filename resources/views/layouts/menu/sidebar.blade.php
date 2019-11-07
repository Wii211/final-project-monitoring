  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <div class="text-white d-block">Achmad Mujaddid Islami</div>
                  <div class="text-white d-block text-NIM">1610817110001</div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-header">Mahasiswa</li>
                  <li class="nav-item">
                      <a id="studentHome" href="{{ route('final_registration.index') }}" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                            Home
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="studentProposal" href="{{ route('pre_proposal.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-sticky-note"></i>
                          <p>
                            Pra-Proposal
                            {{-- <span class="badge badge-danger right"><i class="fa fa-info"></i></span> --}}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="studentFinalProject" href="{{ route('final_project.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Tugas Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">Koordinator TA</li>
                  <li class="nav-item">
                      <a id="coorHome" href="{{ route('coordinator_dashboard.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                            Home
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="coorFinalProjectStudent" href="{{ route('final_students.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-user-graduate"></i>
                          <p>
                            Mahasiswa TA
                            <span class="badge badge-danger right">2</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="coorFinalProject" href="{{ route('final_actives.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                            Tugas Akhir
                            <span class="badge badge-danger right">2</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="coorFinalProjectSchedule" href="{{ route('final_schedules.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-calendar-alt"></i>
                          <p>
                            Seminar Proposal/Sidang TA
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">Datas</li>
                  <li class="nav-item">
                      <a id="finalProject" href="{{ route('final_project.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Data Tugas Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="lecturer" href="{{ route('lecturers.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Data Dosen
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="student" href="{{ route('students.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Data Mahasiswa
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">PROFILE</li>
                  <li class="nav-item">
                      <a id="changeProfile" href="{{ route('change_profile') }}" class="nav-link">
                          <i class="nav-icon fas fa-key"></i>
                          <p>
                              Profil Saya
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a id="changePassword" href="{{ route('change_password') }}" class="nav-link">
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