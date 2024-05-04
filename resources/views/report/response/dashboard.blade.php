@extends('dashboard')

@section('title')
Tanggapan
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/formStyle.css') }}">  
@endsection

@section('content')
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Tanggapan</span>
        </div>
        <div class="profile-details">
            <span class="admin_name">{{ Auth::user()->name }}</span>
            <i class='bx bx-chevron-down'></i>
        </div>
    </nav>

    <div class="home-content">
      <div class="overview-bxs" style="margin-left: 10px; margin-bottom: 20px">
        <div class="box">
          <table class="table">
            <tbody>
                <tr>
                    <th>Judul:</th>
                    <td>{{ $report->name }}</td>
                </tr>
                <tr>
                    <th>Pelapor:</th>
                    <td>{{ $report->user->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal:</th>
                    <td>{{ $report->date }}</td>
                </tr>
                <tr>
                    <th>Kategori:</th>
                    <td>{{ $report->category->name }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>{{ $report->status->name }}</td>
                </tr>
                <tr>
                    <th>Gambar:</th>
                    <td>
                        <a href="{{ asset('storage/' . $report->photo) }}" data-lightbox="image-gallery" data-title="{{ $report->name }}">
                          <img src="{{ asset('storage/' . $report->photo) }}" alt="Photo" style="height: 100px"; width="auto";>
                      </td>
                  </tr>
                  <tr>
                      <th>Detail:</th>
                      <td>{!! $report->detail !!}</td>
              </tbody>
          </table>
        </div>
      </div>
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
        @can('Tanggapan Create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTanggapan" style="margin: 0 0 15px 25px;">Add Tanggapan
            <i class='bx bx-user-plus text-white' style="margin-left: 3px"></i>
        </button>
        @endcan
        <!-- Modal -->
        <div class="modal fade" id="addTanggapan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header d-block ">
                <h5 class="modal-title text-center" id="myModalLabel">Add Tanggapan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body content d-flex justify-content-center">
                <form action="/report/response/{{ $report->id }}/store" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="topic"></div>
                        <div class="input-box">
                          <input type="date" name="date" required>
                        </div>
                        <div class="input-box">
                          <select name="status_id" id="status" required>
                            <option hidden>Ganti status</option>
                            @foreach ($statuses as $status)
                              <option value="{{ $status->id }}" {{ $report->status->id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                              </option>
                            @endforeach
                          </select>
                          <label for="status">Status:</label>
                        </div>
                        <label><strong>Gambar : </strong></label><br>
                        <input type="file" name="image" id="image" required>
                        <br><br>
                        <label><strong>Deskripsi : </strong></label><br>
                        <div>
                          <input id="description" type="hidden" name="description">
                          <trix-editor id="description" input="description" style="min-height: 300px;"></trix-editor>
                        </div>
                        <div class="input-box">
                          <input type="submit" value="Submit Tanggapan">
                        </div>
                  </div>
                </form>
              </div>                                          
              {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">Close</button>
              </div> --}}
            </div>
          </div>
        </div>
        <!-- End Modal -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="box">
          @foreach ($response as $r)
            <div class="overview-bxs" style="margin-left: 20px;">
              <div class="card mb-2" style="max-width: 90%;">
                <div class="row no-gutters">
                <div class="col-md-2">
                  <a href="{{ asset('storage/' . $r->image) }}" data-lightbox="image-gallery" data-title="report image">
                    <img src="{{ asset('storage/' . $r->image) }}" alt="Photo" class="card-img" style="height: 215px; object-fit: cover">
                  </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><i class="bx bxs-time-five me-2"></i><small class="text-muted">{{ $r->date }}</small></p>
                        <h5 class="card-title" style="word-wrap: break-word; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden; text-overflow: ellipsis;">{{ $r->user->name }}</h5>
                        <div class="trix-rendered-content" style="word-wrap: break-word; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 4; overflow: hidden; text-overflow: ellipsis;">
                            <div>{!! $r->description !!}</div>
                        </div>                      
                      </div>
                </div>
                <div style="margin-top: 20px; margin-bottom: 20px;">
                  <div class="col-md-1">
                      <div class="dropdown">
                        <a class="btn-lg" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; color: black; size:10px">
                            <strong>&#8230;</strong>
                        </a>                      
                          <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuLink">
                            @can('Tanggapan Read')
                            <button type="button" class="btn btn-info dropdown-item" data-toggle="modal" data-target="#detail_{{ $r->id }}">
                              <i class='bx bx-edit' style='color: rgb(0, 238, 255);'></i> Detail
                            </button>
                            @endcan
                            @can('Tanggapan Update')
                            <button type="button" class="btn btn-warning dropdown-item" data-toggle="modal" data-target="#update_{{ $r->id }}">
                              <i class='bx bx-edit' style='color: rgb(255, 230, 0);'></i> Update
                            </button>
                            @endcan
                            @can('Tanggapan Delete')
                            <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $r->id }}">
                              <i class='bx bx-trash' style='color: red;'></i> Delete
                            </button>
                            @endcan
                          </div>
                      </div>
                      <!-- Modal -->
                      <div class="modal fade" id="detail_{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="myModalLabel">Detail Pelaporan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                  <tbody>
                                      <tr>
                                          <th>Dibuat oleh:</th>
                                          <td>{{ $r->user->name }}</td>
                                      </tr>
                                      <tr>
                                          <th>Tanggal:</th>
                                          <td>{{ $r->date }}</td>
                                      </tr>
                                      <tr>
                                          <th>Gambar:</th>
                                          <td>
                                              <a href="{{ asset('storage/' . $r->image) }}" data-lightbox="image-gallery" data-title="response image">
                                                <img src="{{ asset('storage/' . $r->image) }}" alt="Photo" style="height: 100px"; width="auto";>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Detail:</th>
                                    </tbody>
                                </table>
                                <div class="trix-content" style="margin-left: 10px">
                                    {!! $r->description !!}
                                </div>                                                
                          </div>                                          
                          </div>
                        </div>
                      </div>
                      <!-- End Modal -->
                      <!-- Modal -->
                      <div class="modal fade" id="update_{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header d-block ">
                              <h5 class="modal-title text-center" id="myModalLabel">Update Tanggapan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body content d-flex justify-content-center">
                              <form action="/report/response/{{ $report->id }}/update/{{ $r->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="topic"></div>
                                      <div class="input-box">
                                        <input type="date" name="date" value="{{ $r->date }}" required>
                                      </div>
                                      <div class="input-box">
                                        <select name="status_id" id="status" required>
                                          <option hidden>Ganti status</option>
                                          @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $report->status->id == $status->id ? 'selected' : '' }}>
                                              {{ $status->name }}
                                            </option>
                                          @endforeach
                                        </select>
                                        <label for="status">Status:</label>
                                      </div>
                                      <label><strong>Gambar : </strong></label><br>
                                      <input type="file" name="image" id="image">
                                      <br><br>
                                      <label><strong>Deskripsi : </strong></label><br>
                                      <div>
                                        <input id="desc" type="hidden" name="desc">
                                        <trix-editor id="desc" input="desc" style="min-height: 300px;">
                                            {!! $r->description !!}
                                        </trix-editor>
                                      </div>
                                      <div class="input-box">
                                        <input type="submit" value="Submit Tanggapan">
                                      </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal -->
                      <!-- Modal -->
                      <div class="modal fade" id="deleteConfirmation_{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="myModalLabel">Are you sure want to delete this data?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">No</button>
                              <a href="/report/response/{{ $report->id }}/delete/{{ $r->id }}" class="btn btn-primary" id="deleteOk">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal -->
                  </div>
              </div>              
            </div>
          </div>
          @endforeach
        </div>
    </div>
    <hr style="text-align:left; margin-left:0; border-color: rgba(0, 0, 0, 0.5);">
</section>
@endsection