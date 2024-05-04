@extends('dashboard')

@section('title')
Status
@endsection

@section('content')
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Status</span>
        </div>
        <div class="profile-details">
          <span class="admin_name">{{ Auth::user()->name }}</span>
          <i class='bx bx-chevron-down'></i>
        </div>
      </nav>

      <div class="home-content">
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
        @can('Status Create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData" style="margin: 0 0 15px 25px;">
          <i class='bx bx-plus text-white' style='margin-left: 3px'></i> Add Status
        </button>
        @endcan
        <!-- Modal -->
        <div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Add Status</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/status/add" method="POST">
                        @csrf
                        <label for="name">Nama Status : </label><br>
                        <input type="text" name="name" id="name"><br>
                        <label for="color">Color : </label><br>
                        <input type="text" name="color" id="color"><br>
                        <label for="name">Button class : </label><br>
                        <input type="text" name="class" id="class"><br>
                        <label for="icon">bx icon : </label><br>
                        <input type="text" name="icon" id="icon"><br><br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
              </div>                             
              </div>
            </div>
          </div>
          <!-- End Modal -->
        <div class="overview-bxs" style="margin-left: 10px">
          <div class="box">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Badge</th>
                            <th>Icon</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($status as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->created_at }}</td>
                            <td>
                              <span class="badge rounded-pill bg-{{ $s->class}} text-white" style="padding: 2px 10px; font-size: 14px;">
                                  {{ $s->name }}
                              </span>
                            </td>
                            <td>
                              <i class='bx {{ $s->icon }}' style='margin-left: 3px'></i>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuLink">
                                        @can('Status Update')
                                        <button type="button" class="btn btn-warning dropdown-item" data-toggle="modal" data-target="#updateData_{{ $s->id }}">
                                          <i class='bx bx-trash' style='color: yellow;'></i> Update
                                        </button>
                                        @endcan
                                        @can('Status Update')
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $s->id }}">
                                          <i class='bx bx-trash' style='color: red;'></i> Delete
                                        </button>
                                        @endcan
                                    </div>
                                    <!-- Modal -->
                                  <div class="modal fade" id="updateData_{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="myModalLabel">Update Data</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/status/update/{{ $s->id }}" method="POST">
                                                @csrf
                                                <label for="name">Nama Status : </label>
                                                <input type="text" name="name" id="name" value="{{ $s->name }}"><br>
                                                <label for="name">Color : </label><br>
                                                <input type="text" name="color" id="color" value="{{ $s->color }}"><br>
                                                {{-- <label for="name">Button class : </label><br>
                                                <input type="text" name="class" id="class"><br> --}}
                                                <label for="name">bx icon : </label><br>
                                                <input type="text" name="icon" id="icon" value="{{ $s->icon}}"><br><br>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                      </div>                                          
                                      </div>
                                    </div>
                                  </div>
                                  <!-- End Modal -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfirmation_{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Delete Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          </div>
                                          <div class="modal-body">
                                            <h7><strong>Are you sure you want to delete this data?</strong></h7><br>
                                            <h8>{{ $s->name }}</h8><br>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">No</button>
                                            <a href="/status/delete/{{ $s->id }}" class="btn btn-primary" id="deleteOk">Yes</a>
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