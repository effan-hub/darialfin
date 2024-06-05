@extends('template.main')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Program Studi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Program Studi</h3>
  
               <div class="card-tools">
                <a href="/prodi/create" class="btn btn-primary">Tambah</a>
                
               </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Prodi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($prodi as $p)
                     
                   
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$p->nama_prodi}}</td>
                      <td></td>
                      <td><a href="" class="btn btn-warning">Edit</a>
                      <a href="" class="btn btn-danger">Hapus</a>
                      @endforeach
                    </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
  
          <!-- /.row (main row) -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
  
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection