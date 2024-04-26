@extends('dashboard')

@section('title')
Group User
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
            <i class='bx bx-chevron-down'></i>
        </div>
    </nav>

    <div class="home-content">
        <a href="/administrator/add" class="btn btn-primary text-white" style="margin: 0 0 15px 25px;">Add Group
            <i class='bx bx-user-plus text-white' style="margin-left: 3px"></i>
        </a>
        <div class="overview-bxs" style="margin-left: 10px">
            <div class="box">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Created At</th>
                            {{-- <th>Updated At</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $index => $role)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            {{-- <td>{{ $roles->updated_at }}</td> --}}
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuLink">
                                        {{-- <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#adminDetail_{{ $role->id }}">
                                          <i class='bx bx-info-circle' style='color: rgb(40, 185, 204);'></i> Detail
                                        </button> --}}
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#addRoleModal">
                                          <i class='bx bx-cog' style='color: rgb(40, 185, 204);'></i> Settings
                                        </button>
                                        {{-- <a class="dropdown-item" href="/administrator/update/{{ $role->id }}">
                                            <i class='bx bx-edit' style='color: yellow;'></i> Update
                                        </a>
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $role->id }}">
                                          <i class='bx bx-trash' style='color: red;'></i> Delete
                                        </button> --}}
                                      </div>
                                      <!-- Modal -->
                                      {{-- <div class="modal fade" id="adminDetail_{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                      </div> --}}
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
<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="role-title">Set role permissions</h3>
            {{-- <p>Set role permissions</p> --}}
          </div>
          <!-- Add role form -->
          <form id="addRoleForm" class="row g-3" onsubmit="return false">
            {{-- <div class="col-12 mb-4">
              <label class="form-label" for="modalRoleName">Role Name</label>
              <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1" />
            </div> --}}
            <div class="col-12">
              <h4>Role Permissions</h4>
              <!-- Permission table -->
              <div class="table-responsive">
                <table class="table table-flush-spacing">
                  <tbody>
                    <tr>
                      <td class="text-nowrap fw-medium">Administrator Access <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="selectAll" />
                          <label class="form-check-label" for="selectAll">
                            Select All
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap fw-medium">User Management</td>
                        <td>
                          <div class="d-flex">
                            <div class="form-check mr-3 mr-lg-5">
                              <input class="form-check-input" type="checkbox" id="userManagementRead" />
                              <label class="form-check-label" for="userManagementRead">
                                 Read 
                              </label>
                            </div>
                            <div class="form-check mr-3 mr-lg-5">
                              <input class="form-check-input" type="checkbox" id="userManagementWrite" />
                              <label class="form-check-label" for="userManagementWrite">
                                Create 
                              </label>
                            </div>
                            <div class="form-check mr-3 mr-lg-5">
                              <input class="form-check-input" type="checkbox" id="userManagementCreate" />
                              <label class="form-check-label" for="userManagementCreate">
                                 Update 
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="userManagementCreate" />
                              <label class="form-check-label" for="userManagementCreate">
                                 Delete
                              </label>
                            </div>
                          </div>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <!-- Permission table -->
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              {{-- <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button> --}}
            </div>
          </form>
          <!--/ Add role form -->
        </div>
      </div>
    </div>
  </div>
  <!--/ Add Role Modal -->
@endsection