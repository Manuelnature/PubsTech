@extends('layouts.base_template')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1>Advanced Form</h1> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Warehouse</a></li>
              {{-- <li class="breadcrumb-item active">Sales / Warehouse</li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Warehouse </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('add_stock') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="txt_product_name">Products</label>
                          <select class="form-control select2" data-placeholder="Select Product" style="width: 100%;" name="txt_product_name" value="{{ old('txt_product_name') }}" >
                            <option selected disabled>Select Product</option>
                            @foreach ($all_products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger">@error('txt_product_name') {{ $message }} @enderror</span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_quantity_of_crates">Quantity (Crate)</label>
                            <input type="number" class="form-control" id="txt_quantity_of_crates" name="txt_quantity_of_crates" value="{{ old('txt_quantity_of_crates') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_of_crates') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_quantity">Quantity (Pieces)</label>
                            <input type="number" class="form-control" id="txt_quantity" name="txt_quantity" value="{{ old('txt_quantity') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="txt_stock_date">Stock Date</label>
                            <input type="date" class="form-control" id="txt_stock_date" name="txt_stock_date" value="{{ old('txt_stock_date') }}">
                            {{-- <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="txt_stock_date"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div> --}}
                            <span class="text-danger">@error('txt_stock_date') {{ $message }} @enderror</span>
                        </div>
                      </div>
                </div>
                <!-- /.row -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_description">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter product description" name="txt_description">{{old('txt_description')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_description') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row">
                            <label for="txt_total_price" class="col-sm-2 col-form-label">Total Price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="txt_total_price" name="txt_total_price" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-block btn-secondary">Submit</button>
                    </div>
                </div> --}}
            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Select the product and enter the quantity
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.container-fluid -->

    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Warehouse Info</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Product Name</th>
                        {{-- <th>Quantity per Crate</th> --}}
                        <th>No. of Crates</th>
                        <th>No. of Pieces</th>
                        <th>Price per Piece</th>
                        <th>Total Items</th>
                        <th>Total Price</th>
                        <th>Description</th>
                        <th>Stock Date</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Updated By</th>
                        <th>Updated Reason</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($get_product_records as $records)
                        <tr>
                            <td>{{ $records->name }}</td>
                            {{-- <td> {{ $records->quantity_per_crate }}</td> --}}
                            <td>{{ $records->no_of_crates }}</td>
                            <td>{{ $records->no_of_pieces }}</td>
                            <td>
                                @php
                                    echo 'Gh¢ '.number_format($records->price_per_piece, 2);
                                @endphp
                            </td>
                            <td>{{ $records->total_items }}</td>
                            <td>
                                @php
                                    if ($records->total_price != NULL || $records->total_price != "") {
                                        echo 'Gh¢ '.number_format($records->total_price, 2);
                                    }
                                    else {
                                        echo 'Gh¢ 0.00';
                                    }

                                @endphp
                            </td>
                            <td>{{ $records->description }}</td>
                            <td>{{ $records->stock_date }}</td>
                            <td>{{ $records->created_by }}</td>
                            <td>{{ $records->created_at }}</td>
                            <td>
                                @if ($records->updated_by == "" || $records->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$records->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($records->updated_reason == "" || $records->updated_reason == NULL)
                                    <p>Not Stated</p>
                                @else
                                    <p>{{$records->updated_reason}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($records->updated_at == "" || $records->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$records->updated_at}}</p>
                                @endif
                            </td>

                            <td class="text-center">
                                <a class="text-primary"
                                    onclick="edit_user(this)"
                                    data-toggle="modal"
                                    data-target="#edit-user"
                                    data-id="{{ $records->id }}"
                                    data-product_name="{{ $records->name }}"
                                    data-first_name="{{ $records->no_of_crates }}"
                                    data-last_name="{{ $records->no_of_pieces }}"
                                    data-email="{{ $records->description }}"
                                    data-username="{{ $records->stock_date }}"
                                >
                                <i class="fas fa-edit"></i>
                                </a>
                                <a  class="text-danger"
                                    onclick="delete_user(this)"
                                    data-toggle="modal"
                                    data-target="#delete-user"
                                    data-id="{{ $records->id }}"
                                    data-first_name="{{ $records->name }}"
                                >
                                <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>


  </div>
  <!-- /.content-wrapper -->

  @section('Extra_JS')
  <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection

        <!-- DataTables  & Plugins -->
      <script src="plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="plugins/jszip/jszip.min.js"></script>
      <script src="plugins/pdfmake/pdfmake.min.js"></script>
      <script src="plugins/pdfmake/vfs_fonts.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      {{-- <script src="dist/js/adminlte.min.js"></script> --}}

      <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 10, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>


    <script>
        $("#txt_quantity_of_crates").attr("value", 0);
        $("#txt_quantity").attr("value", 0);

        var today = new Date();
        var dd = ("0" + (today.getDate())).slice(-2);
        var mm = ("0" + (today.getMonth() +　1)).slice(-2);
        var yyyy = today.getFullYear();
        today =  yyyy + '-' + mm + '-' + dd ;
        // today =  mm + '/' + dd + '/' + yyyy ;
        $("#txt_stock_date").attr("value", today);
    </script>




@endsection



