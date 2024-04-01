@extends('dashboard')

@section('title')
Administrator
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
      <a href="/administrator/add" class="btn btn-primary text-white" style="margin: 0 0 15px 25px;">Add Admin
        <i class='bx bx-user-plus text-white' style="margin-left: 3px"></i>
      </a>
      <div class="overview-bxs" style="margin-left: 10px">
        <div class="box">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($user as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>
                  @foreach($user->getRoleNames() as $role)
                    {{ $role }}
                  @endforeach
                </td>
                <td>
                  <span class="badge rounded-pill {{ $user->status == 1 ? 'bg-success' : 'bg-danger' }} text-white" style="padding: 2px 10px; font-size: 14px;">
                    {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td>
                  <div class="dropdown">
                    <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="/administrator/detail">
                        <i class='bx bx-info-circle' style='color: rgb(40, 185, 204);'></i> Detail
                      </a>
                      <a class="dropdown-item" href="/administrator/update">
                        <i class='bx bx-edit' style='color: yellow;'></i> Update
                      </a>
                      <a class="dropdown-item" href="/administrator/delete">
                        <i class='bx bx-trash' style='color: red;'></i> Delete
                      </a>
                    </div>
                  </div>                  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>          
        </div>
      </div>
    </div>
    <hr style="text-align:left; margin-left:0; border-color: rgba(0, 0, 0, 0.5);">

  </section>
@endsection