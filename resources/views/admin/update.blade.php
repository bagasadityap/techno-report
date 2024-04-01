@extends('dashboard')

@section('title')
Administrator
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/formStyle.css') }}">  
@endsection

@section('content')
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Administrator</span>
      </div>
      <div class="profile-details">
        <span class="admin_name">{{ Auth::user()->name }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    
    <div class="home-content">
      <div class="containerr">
          <div class="content">
              <form action="/administrator/update-store/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="topic">Update Admin</div>
                      <div class="input-box">
                          <input type="text" name="name" value="{{ $user->name }}" required>
                          <label>Enter Name</label>
                      </div>
                      <div class="input-box">
                          <input type="text" name="email" value="{{ $user->email }}" required>
                          <label>Enter username</label>
                      </div>
                      <div class="input-box">
                          <input type="password" name="password">
                          <label>Enter password (Leave it empty if you don't want to change)</label>
                        </div>
                        <div class="input-box">
                          <select name="role" id="role">
                            <option disabled selected hidden {{ $user->role == '' ? '' : 'selected' }}>Choose a role</option>
                            <option value="super_admin" {{ in_array('super_admin', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Super Admin</option>
                            <option value="admin_kec" {{ in_array('admin_kec', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Admin Kecamatan</option>
                            <option value="admin_kab" {{ in_array('admin_kab', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Admin Kabupaten</option>
                            <option value="admin_opd" {{ in_array('admin_opd', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Admin OPD</option>
                          </select>
                          <label for="role">Posisi:</label>
                        </div>
                        <div>
                          <label>Status</label><br>
                          <input type="radio" name="status" value="1" {{ $user->status === 1 ? 'checked' : '' }}>
                          <label for="active"> Active </label><br>
                          <input type="radio" name="status" value="0" {{ $user->status === 0 ? 'checked' : '' }}>
                          <label for="inactive"> Inactive </label>
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