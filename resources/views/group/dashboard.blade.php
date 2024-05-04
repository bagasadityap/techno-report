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
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif  
        {{-- <a href="/administrator/add" class="btn btn-primary text-white" style="margin: 0 0 15px 25px;">Add Group
            <i class='bx bx-user-plus text-white' style="margin-left: 3px"></i>
        </a> --}}
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
                                      <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#editPermission_{{ $role->id }}">
                                        <i class='bx bx-cog' style='color: rgb(40, 185, 204);'></i> Settings
                                      </button>
                                      {{-- <a class="dropdown-item" href="/administrator/update/{{ $role->id }}">
                                        <i class='bx bx-edit' style='color: yellow;'></i> Update
                                      </a>
                                      <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $role->id }}">
                                        <i class='bx bx-trash' style='color: red;'></i> Delete
                                      </button> --}}
                                    </div>
                                    <!-- Edir Permission Modal -->
                                    <div class="modal fade" id="editPermission_{{ $role->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-add-new-role">
                                          <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              <div class="text-center mb-4">
                                                <h3 class="role-title">Set role permissions</h3>
                                              </div>
                                              <!-- Add role form -->
                                              <form class="row g-3" action="/group-user/edit/{{ $role->id }}" method="POST">
                                                @csrf
                                                <div class="col-12">
                                                  <h4>Role Permissions</h4>
                                                  <!-- Permission table -->
                                                  <div class="table-responsive">
                                                    <table class="table table-flush-spacing">
                                                      <tbody>
                                                        <tr>
                                                          <td class="text-nowrap fw-medium">Administrator Access</td>
                                                          <td>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" id="selectAll" />
                                                              <label class="form-check-label" for="selectAll">
                                                                Select All
                                                              </label>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        @foreach ($permissions as $permission)
                                                          @if (Str::contains($permission->name, ['crud']))
                                                              @php
                                                                $permissionName = str_replace('crud', '', $permission->name);    
                                                              @endphp
                                                                <tr>
                                                                  <td class="text-nowrap fw-medium">{{ $permissionName }}</td>
                                                                  <td>
                                                                      <div class="form-check">
                                                                          <input class="form-check-input" type="checkbox" name="{{ $permission->name }}" id="{{ $permission->name }}" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} />
                                                                          <label class="form-check-label" for="{{ $permission->name }}"></label>
                                                                      </div>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td class="text-nowrap fw-medium"></td>
                                                                  <td>
                                                                      <div class="d-flex">
                                                                        <div class="form-check mr-3 mr-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="{{ $permissionName . ' Read' }}" id="{{ $permissionName . ' Read' }}" value="{{ $permissionName . ' Read' }}" {{ $role->hasPermissionTo($permissionName . ' Read') ? 'checked' : '' }} />
                                                                            <label class="form-check-label" for="{{ $permissionName . ' Read' }}">Read</label>
                                                                        </div>
                                                                        <div class="form-check mr-3 mr-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="{{ $permissionName . ' Create' }}" id="{{ $permissionName . ' Write' }}" value="{{ $permissionName . ' Create' }}" {{ $role->hasPermissionTo($permissionName . ' Create') ? 'checked' : '' }} />
                                                                            <label class="form-check-label" for="{{ $permissionName . ' Write' }}">Create</label>
                                                                        </div>
                                                                        <div class="form-check mr-3 mr-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="{{ $permissionName . ' Update' }}" id="{{ $permissionName . ' Update' }}" value="{{ $permissionName . ' Update' }}" {{ $role->hasPermissionTo($permissionName . ' Update') ? 'checked' : '' }} />
                                                                            <label class="form-check-label" for="{{ $permissionName . ' Update' }}">Update</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="{{ $permissionName . ' Delete' }}" id="{{ $permissionName . ' Delete' }}" value="{{ $permissionName . ' Delete' }}" {{ $role->hasPermissionTo($permissionName . ' Delete') ? 'checked' : '' }}/>
                                                                            <label class="form-check-label" for="{{ $permissionName . ' Delete' }}">Delete</label>
                                                                        </div>
                                                                      </div>
                                                                  </td>
                                                              </tr>
                                                          @elseif (Str::contains($permission->name, ['Read', 'Create', 'Update', 'Delete']))
                                                          @else
                                                              <tr>
                                                                  <td class="text-nowrap fw-medium">{{ $permission->name }}</td>
                                                                  <td>
                                                                      <div class="form-check">
                                                                          <input class="form-check-input" type="checkbox" name="{{ $permission->name }}" id="{{ $permission->name }}" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} />
                                                                          <label class="form-check-label" for="{{ $permission->name }}"></label>
                                                                      </div>
                                                                  </td>
                                                              </tr>
                                                          @endif
                                                      @endforeach
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
@endsection

@section('js')
<script>
  document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('selectAll').addEventListener('change', function() {
          console.log("Select All checkbox clicked!");
          const checkboxes = document.querySelectorAll('.form-check-input');
          const isChecked = this.checked;
          checkboxes.forEach(function(checkbox) {
              checkbox.checked = isChecked;
          });
      });
  });
</script>
@endsection