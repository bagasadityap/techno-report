@extends('dashboard')

@section('title')
Pelaporan
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/formStyle.css') }}">  
@endsection

@section('content')
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Pelaporan</span>
      </div>
      <div class="profile-details">
        <span class="admin_name">{{ Auth::user()->name }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

    <div class="home-content">
      <div class="containerr">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <div class="content">
              <form action="{{ url('/report/store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="topic">Add Laporan</div>
                      {{-- <input type="text" name="reporter_id" value="{{ Auth::user()->id }}" hidden required> --}}
                      {{-- <input type="text" name="status_id" value={{ $status->id }} hidden required> --}}
                      <div class="input-box">
                          <input type="text" name="name" required>
                          <label>Judul</label>
                        </div>
                        <div class="input-box">
                          <input type="date" name="date" required>
                          {{-- <label>Tanggal</label> --}}
                        </div>
                        <div class="input-box">
                          <select name="category_id" id="category" required>
                            <option hidden>Pilih kategori</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                          <label for="category">Kategori:</label>
                        </div>
                        <div class="input-box">
                          <select name="authority_id" id="authority" required>
                            <option hidden>Pilih kewenangan</option>
                            @foreach ($authorities as $authority)
                              <option value="{{ $authority->id }}">{{ $authority->name }}</option>
                            @endforeach
                          </select>
                          <label for="authority">Kewenangan:</label>
                        </div>
                        <label><strong>Gambar : </strong></label><br>
                        <input type="file" name="photo" id="photo" required>
                        <br><br>
                        <label><strong>Detail Pelaporan : </strong></label><br>
                        <div>
                          <input id="detail" type="hidden" name="detail">
                          <trix-editor id="detail" input="detail" style="min-height: 300px;"></trix-editor>
                        </div>
                        <div class="input-box">
                          <input type="submit" value="Submit Laporan">
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