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
            <i class='bx bx-chevron-down'></i>
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
                        @foreach($users as $index => $user)
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
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#adminDetail_{{ $user->id }}">
                                          <i class='bx bx-info-circle' style='color: rgb(40, 185, 204);'></i> Detail
                                        </button>
                                        <a class="dropdown-item" href="/administrator/update/{{ $user->id }}">
                                            <i class='bx bx-edit' style='color: yellow;'></i> Update
                                        </a>
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $user->id }}">
                                          <i class='bx bx-trash' style='color: red;'></i> Delete
                                        </button>
                                      </div>
                                      <!-- Modal -->
                                      <div class="modal fade" id="adminDetail_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="myModalLabel">Detail User</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table">
                                                  <tbody>
                                                      <tr>
                                                          <th>Last Updated:</th>
                                                          <td>{{ $user->updated_at }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Nama:</th>
                                                          <td>{{ $user->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Username:</th>
                                                          <td>{{ $user->email }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Role:</th>
                                                          <td>
                                                              @foreach($user->getRoleNames() as $role)
                                                              {{ $role }}
                                                              @endforeach
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <th>Status:</th>
                                                          <td>
                                                              <span class="badge rounded-pill {{ $user->status == 1 ? 'bg-success' : 'bg-danger' }} text-white" style="padding: 2px 10px; font-size: 14px;">
                                                                  {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                                              </span>
                                                          </td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>                                          
                                            {{-- <div class="modal-footer">
                                              <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">Close</button>
                                            </div> --}}
                                          </div>
                                        </div>
                                      </div>
                                      <!-- End Modal -->
                                      <!-- Modal -->
                                      <div class="modal fade" id="deleteConfirmation_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="myModalLabel">Delete Data</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                              <h7><strong>Are you sure you want to delete this data?</strong></h7><br>
                                              <h8>Nama : {{ $user->name }}</h8><br>
                                              <h8>Username : {{ $user->email }}</h8>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">No</button>
                                              <a href="/administrator/delete/{{ $user->id }}" class="btn btn-primary" id="deleteOk">Yes</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- End Modal -->
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