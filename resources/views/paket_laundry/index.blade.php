@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Paket Laundry
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Paket Laundry</li>
        </ol>
    </section>
  
    <!-- Main content -->
    <section class="content">
        @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Paket Laundry</h3>
                        <div class="box-tools">
                            <button class="btn btn-default" onclick="location.reload()">Refresh</button>
                            <button class="btn btn-default" data-toggle="modal" data-target="#createModal">Create</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Paket</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Cabang</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pakets as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->berat }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->cabang }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <button class="btn btn-{{ $item->status == 'Aktif' ? 'success' : 'danger' }}" data-toggle="modal" data-target="#statusChangeModal{{ $item->id }}">
                                            {{ $item->status }}
                                        </button>
                                    </td>
                                    <td>
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                          <li>
                                              <a href="#" data-toggle="modal" data-target="#detailModal{{ $item->id }}">Detail</a>
                                          </li>
                                          <li>
                                              <a href="#" data-toggle="modal" data-target="#confirmDeleteModal{{ $item->id }}">Delete</a>
                                          </li>
                                        </ul>
                                      </div>
                                    </td>
                                </tr>

                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="detailModalLabel">Detail Paket Laundry</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('paket.update', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama">Paket:</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="berat">Berat:</label>
                                                                <input type="number" class="form-control" id="berat" name="berat" value="{{ $item->berat }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="satuan">Satuan:</label>
                                                                <select class="form-control" id="satuan" name="satuan">
                                                                    @foreach ($satuans as $st)
                                                                    <option value="{{ $st->id }}" {{ $item->satuan_id == $st->id ? 'selected' : '' }}>{{ $st->satuan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga:</label>
                                                        <input type="number" class="form-control" id="harga" name="harga" value="{{ $item->harga }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cabang">Cabang:</label>
                                                        <input type="text" class="form-control" id="cabang" name="cabang" value="{{ $item->cabang }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                              <!-- Confirm Delete Modal -->
                              <div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="confirmDeleteModalLabel">Yakin Hapus</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin hapus data ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('paket.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <!-- Status Change Modal -->
                              <div class="modal fade" id="statusChangeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="statusChangeModalLabel">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              <h4 class="modal-title" id="statusChangeModalLabel">Change Status</h4>
                                          </div>
                                          <div class="modal-body">
                                              <p>Change status from {{ $item->status }} to {{ $item->status == 'Aktif' ? 'Nonaktif' : 'Aktif' }}?</p>
                                          </div>
                                          <div class="modal-footer">
                                              <form action="{{ route('paket.changeStatus', $item->id) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="status" value="{{ $item->status == 'Aktif' ? 'Nonaktif' : 'Aktif' }}">
                                                  <button type="submit" class="btn btn-primary">Change Status</button>
                                              </form>
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="createModalLabel">Create Paket Laundry</h4>
                </div>
                <div class="modal-body">
                    <!-- Add your form for creating Paket Laundry here -->
                    <!-- For example, you can include a form with input fields -->
                    <form action="{{ route('paket.store') }}" method="POST">
                        @csrf
                        <!-- Your form fields go here -->
                        <div class="form-group">
                            <label for="nama">Paket:</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="berat">Berat:</label>
                                    <input type="number" class="form-control" name="berat" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="satuan">Satuan:</label>
                                    <select class="form-control" name="satuan">
                                        @foreach ($satuans as $st)
                                        <option value="{{ $st->id }}">{{ $st->satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="number" class="form-control" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="cabang">Cabang:</label>
                            <input type="text" class="form-control" name="cabang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <!-- /.content -->
@endsection
