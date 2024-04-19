@extends('dashboard')

@section('title')
Category
@endsection

@section('content')
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Category</span>
        </div>
        <div class="profile-details">
            <span class="admin_name">{{ Auth::user()->name }}</span>
            <i class='bx bx-chevron-down'></i>
        </div>
    </nav>

    <div class="home-content">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData" style="margin: 0 0 15px 25px;">
            <i class='bx bx-plus text-white' style='margin-left: 3px'></i> Add Category
        </button>
        <!-- Modal -->
        <div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Add Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/category/add" method="POST">
                        @csrf
                        <label for="name">Nama Kategori : </label>
                        <input type="text" name="name" id="name"><br><br>
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
                            <th>Kategori</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $index => $c)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->created_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuLink">
                                        <button type="button" class="btn btn-warning dropdown-item" data-toggle="modal" data-target="#updateData_{{ $c->id }}">
                                          <i class='bx bx-trash' style='color: yellow;'></i> Update
                                        </button>
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $c->id }}">
                                          <i class='bx bx-trash' style='color: red;'></i> Delete
                                        </button>
                                    </div>
                                    <!-- Modal -->
                                  <div class="modal fade" id="updateData_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="myModalLabel">Update Data</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/category/update/{{ $c->id }}" method="POST">
                                                @csrf
                                                <label for="name">Nama Kategori : </label>
                                                <input type="text" name="name" id="name" value="{{ $c->name }}"><br><br>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                      </div>                                          
                                      </div>
                                    </div>
                                  </div>
                                  <!-- End Modal -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfirmation_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Delete Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          </div>
                                          <div class="modal-body">
                                            <h7><strong>Are you sure you want to delete this data?</strong></h7><br>
                                            <h8>{{ $c->name }}</h8><br>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">No</button>
                                            <a href="/category/delete/{{ $c->id }}" class="btn btn-primary" id="deleteOk">Yes</a>
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