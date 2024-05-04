@extends('dashboard')

@section('title')
Group User
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/formStyle.css') }}">  
@endsection

@section('content')
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Group User</span>
      </div>
      <div class="profile-details">
        <span class="admin_name">{{ Auth::user()->name }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    
    <div class="home-content">
      <div class="containerr">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif 
        <div class="content">
              <form action="{{ url('/administrator/store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="topic">Add Admin</div>
                      <div class="input-box">
                          <input type="text" name="name" required>
                          <label>Enter Name</label>
                      </div>
                      <div class="input-box">
                          <input type="text" name="email" required>
                          <label>Enter username</label>
                      </div>
                      <div class="input-box">
                          <input type="password" name="password" required>
                          <label>Enter password</label>
                        </div>
                        <div class="input-box">
                          <select name="role" id="cars">
                            <option disabled selected hidden>Choose a role</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin_kec">Admin Kecamatan</option>
                            <option value="admin_kab">Admin Kabupaten</option>
                            <option value="admin_opd">Admin OPD</option>
                          </select>
                          <label for="cars">Posisi:</label>
                        </div>
                        <div class="input-box">
                          <input type="submit" value="Upload Content">
                      </div>
                  </div>
                </form>
          </div>
      </div>
    </div>
    <hr style="text-align:left; margin-left:0; border-color: rgba(0, 0, 0, 0.5);">
    
  </section>
  
@endsection
  {{-- <div class="message-box">
      <textarea rows="1" name="description" class="auto_height" oninput="auto_height(this)" required></textarea>
      <label>Enter description</label>
  </div>
  <div class="input-img">
      <label>Enter image</label>
      <br>
      <input type="file" name="image" required>
  </div> --}}