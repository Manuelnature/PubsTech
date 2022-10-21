@extends('layouts.base_template')
@section('content')

@php
    $user_session_details = Session::get('user_session');
    $current_time =  \Carbon\Carbon::now();
@endphp

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
              {{-- <li class="breadcrumb-item"><a href="#">Warehouse</a></li> --}}
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
                          <select class="form-control   " data-placeholder="Select Product" style="width: 100%;" name="txt_product_name" value="{{ old('txt_product_name') }}" >
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
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_quantity_of_crates" name="txt_quantity_of_crates" value="{{ old('txt_quantity_of_crates') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_of_crates') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_quantity">Quantity (Pieces)</label>
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_quantity" name="txt_quantity" value="{{ old('txt_quantity') }}">
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
                            <td>{{ ucwords(trans($records->name)) }}</td>
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
                                        onclick="edit_warehouse_record(this)"
                                        data-toggle="modal"
                                        data-target="#edit_warehouse_record"
                                        data-warehouse_id="{{ $records->id }}"
                                        data-product_id="{{ $records->product_id }}"
                                        data-product_name="{{ $records->name }}"
                                        data-no_of_crates="{{ $records->no_of_crates }}"
                                        data-no_of_pieces="{{ $records->no_of_pieces }}"
                                        data-description="{{ $records->description }}"
                                        data-stock_date="{{ $records->stock_date }}"
                                    >
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- <a  class="text-danger"
                                        onclick="delete_warehouse_record(this)"
                                        data-toggle="modal"
                                        data-target="#delete_warehouse_record"
                                        data-warehouse_id="{{ $records->id }}"
                                        data-product_id="{{ $records->product_id }}"
                                        data-product_name="{{ $records->name }}"
                                    >
                                    <i class="fas fa-trash"></i>
                                    </a> --}}
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


        <div class="modal fade" id="edit_warehouse_record" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('update_stock') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <input type="hidden" class="form-control" id="warehouse_id" name="warehouse_id">
                                        <input type="hidden" class="form-control" id="product_id" name="product_id">

                                        <label for="txt_edit_product_name"> Product Name</label>
                                        <input type="text" class="form-control" id="txt_edit_product_name" name="txt_edit_product_name" readonly>

                                        <span class="text-danger">@error('txt_edit_product_name') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_edit_number_of_crates">Quantity (Crate)</label>
                                        <input type="number" min="0" oninput="this.value =
                                        !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_number_of_crates" name="txt_edit_number_of_crates">
                                    </div>
                                    <span class="text-danger">@error('txt_edit_number_of_crates') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_edit_number_of_pieces"> Quantity (Pieces)</label>
                                        <input type="number" min="0" oninput="this.value =
                                        !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_number_of_pieces" name="txt_edit_number_of_pieces">

                                        <span class="text-danger">@error('txt_edit_number_of_pieces') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_edit_stock_date">Stock Date</label>
                                        <input type="text" class="form-control" id="txt_edit_stock_date" onfocus="(this.type='date')" onblur="(this.type='text')" name="txt_edit_stock_date">
                                    </div>
                                    <span class="text-danger">@error('txt_edit_stock_date') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txt_edit_description">Description</label>
                                        <textarea class="form-control" rows="3" name="txt_edit_description" id="txt_edit_description"></textarea>
                                    </div>
                                    <span class="text-danger">@error('txt_edit_description') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary">Update Warehouse</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="delete_warehouse_record" >
            <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('delete_stock') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="warehouse_id" name="warehouse_id">
                            </div>
                            <h5 class="text-center mb-4">Are you sure you want to delete </h5>
                            <h4 id="product_name" class="text-center text-bold mb-4"></h4>

                            <div class="text-center">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger pl-3 pr-3">Yes</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


  </div>
  <!-- /.content-wrapper -->

    @section('Extra_JS')
    <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
    @endsection


    <script>
        function edit_warehouse_record() {
            $('#edit_warehouse_record').on('shown.bs.modal', function(e) {
            var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
                modal = $(this)
            var warehouse_id = link.data('warehouse_id')
            var product_id = link.data('product_id')
            var product_name = link.data('product_name')
            var no_of_crates = link.data('no_of_crates')
            var no_of_pieces = link.data('no_of_pieces')
            var stock_date = link.data('stock_date')
            var description = link.data('description')

            modal.find('#warehouse_id').val(warehouse_id);
            modal.find('#product_id').val(product_id);
            modal.find('#txt_edit_product_name').val(product_name);
            modal.find('#txt_edit_number_of_crates').val(no_of_crates);
            modal.find('#txt_edit_number_of_pieces').val(no_of_pieces);
            modal.find('#txt_edit_stock_date').val(stock_date);
            modal.find('#selected').val(status);
            modal.find('#txt_edit_description').val(description);
            // document.getElementById('txt_edit_stock_date').val()
            document.getElementById('selected').innerHTML = status;
            document.getElementById('title').innerHTML = 'Edit '+ product_name;
            });
        }


        function delete_warehouse_record() {
            $('#delete_warehouse_record').on('shown.bs.modal', function(e) {
            var link = $(e.relatedTarget)
                modal = $(this)
            var warehouse_id = link.data('warehouse_id')
            var product_id = link.data('product_id')
            var product_name = link.data('product_name')

            modal.find('#warehouse_id').val(warehouse_id);
            document.getElementById('product_name').innerHTML = product_name;
            });

        }

            $("#txt_price_per_item").attr("value", 0);
            $("#txt_quantity_per_crate").attr("value", 0);
            $("#txt_stock_threshold").attr("value", 0);

    </script>


        <!-- DataTables  & Plugins -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
      {{-- <script src="dist/js/adminlte.min.js"></script> --}}

    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 9, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
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



