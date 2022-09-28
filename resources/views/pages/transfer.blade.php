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
              <li class="breadcrumb-item"><a href="#">Transfer Products</a></li>
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
            <h3 class="card-title">Transfer From Warehouse to Retail </h3>

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
            <form action="{{ route('transfer_stock') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="txt_product_id">Products Name</label>
                          <select class="form-control" data-placeholder="Select Product" style="width: 100%;" name="txt_product_id" value="{{ old('txt_product_id') }}" >
                                <option selected disabled>Select Product</option>
                                @foreach ($all_products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                          </select>
                          <span class="text-danger">@error('txt_product_id') {{ $message }} @enderror</span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_quantity_to_transfer_in_crate">Quantity To Transfer (In Crate)</label>
                            <input type="number" class="form-control" id="txt_quantity_to_transfer_in_crate" name="txt_quantity_to_transfer_in_crate" value="{{ old('txt_quantity_to_transfer_in_crate') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_to_transfer_in_crate') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_quantity_to_transfer_in_pieces">Quantity To Transfer (In Pieces)</label>
                            <input type="number" class="form-control" id="txt_quantity_to_transfer_in_pieces" name="txt_quantity_to_transfer_in_pieces" value="{{ old('txt_quantity_to_transfer_in_pieces') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_to_transfer_in_pieces') {{ $message }} @enderror</span>
                      </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_collected_by">Collected By</label>
                            <select class="form-control" data-placeholder="Select User" style="width: 100%;" name="txt_collected_by" value="{{ old('txt_collected_by') }}" >
                                <option selected disabled>Select User</option>
                                @foreach ($all_users as $user)
                                    <option value="{{$user->first_name}} {{$user->last_name}}">{{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                          </select>
                        </div>
                        <span class="text-danger">@error('txt_collected_by') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_collected_at">Date Collected</label>
                            <input type="date" class="form-control" id="txt_collected_at" name="txt_collected_at" value="{{ old('txt_collected_at') }}">

                        </div>
                        <span class="text-danger">@error('txt_collected_at') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_remarks">Remarks</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Remarks Here" name="txt_remarks">{{old('txt_remarks')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_remarks') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Select the product and enter the quantity to transfer
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
                <h3 class="card-title">Transaction Info</h3>
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
                        <th>Original Stock</th>
                        <th>Stock Before</th>
                        <th>Quantity Transfered (In Crates)</th>
                        <th>Quantity Transfered (In Pieces)</th>
                        <th>Total Transfered</th>
                        <th>Stock Left</th>
                        <th>Price per Piece</th>
                        <th>Expected Amount</th>
                        <th>Collected By</th>
                        <th>Collected At</th>
                        <th>Remarks</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_transfer_records as $transfer_record)
                        <tr>
                            <td>{{ $transfer_record->name }}</td>
                            <td> {{ $transfer_record->original_stock }} </td>
                            <td>{{ $transfer_record->stock_before }}</td>
                            <td>{{ $transfer_record->quantity_transfered_in_crates }}</td>
                            <td>{{ $transfer_record->quantity_transfered_in_pieces }}</td>
                            <td>{{ $transfer_record->total_quantity_transfered }}</td>
                            <td>{{ $transfer_record->stock_after }}</td>
                            <td>{{ $transfer_record->price_per_piece }}</td>
                            <td>
                                @php
                                    echo 'Gh¢ '.number_format($transfer_record->expected_price, 2);
                                @endphp
                            </td>
                            <td>{{ $transfer_record->collected_by }}</td>
                            <td>{{ $transfer_record->collected_at }}</td>
                            <td>{{ $transfer_record->remarks }}</td>
                            <td>{{ $transfer_record->created_by }}</td>
                            <td>{{ $transfer_record->created_at }}</td>
                            <td>
                                <a class="text-primary"
                                    onclick="edit_transfer_record(this)"
                                    data-toggle="modal"
                                    data-target="#edit_transfer_record"
                                    data-transfer_id="{{ $transfer_record->id }}"
                                    data-product_id="{{ $transfer_record->product_id }}"
                                    data-product_name="{{ $transfer_record->name }}"
                                    data-price_per_piece="{{ $transfer_record->price_per_piece }}"
                                    data-quantity_transfered_in_crates="{{ $transfer_record->quantity_transfered_in_crates }}"
                                    data-quantity_transfered_in_pieces="{{ $transfer_record->quantity_transfered_in_pieces }}"
                                    data-total_quantity_transfered="{{ $transfer_record->total_quantity_transfered }}"
                                    data-stock_before="{{ $transfer_record->stock_before }}"
                                    data-stock_after="{{ $transfer_record->stock_after }}"
                                    data-expected_price="{{ $transfer_record->expected_price }}"
                                    data-collected_at="{{ $transfer_record->collected_at }}"
                                    data-collected_by="{{ $transfer_record->collected_by }}"
                                    data-remarks="{{ $transfer_record->remarks }}"
                                >
                                <i class="fas fa-edit"></i>
                                </a>
                                {{-- <a  class="text-danger"
                                    onclick="delete_transfer_record(this)"
                                    data-toggle="modal"
                                    data-target="#delete_transfer_record"
                                    data-transfer_id="{{ $transfer_record->id }}"
                                    data-product_id="{{ $transfer_record->product_id }}"
                                    data-product_name="{{ $transfer_record->name }}"
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


        <div class="modal fade" id="edit_transfer_record" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('update_transfer') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" id="txt_transfer_id" name="txt_transfer_id">
                                            {{-- <input type="hidden" class="form-control" id="txt_product_id" name="txt_product_id"> --}}

                                            <label for="txt_product_id"> Product Name</label>
                                            {{-- <input type="text" class="form-control" id="txt_edit_product_name" name="txt_edit_product_name" readonly> --}}
                                            <select class="form-control" data-placeholder="Select Product" style="width: 100%;" name="txt_product_id" id="txt_product_id" >
                                                <option selected id="product_name"></option>
                                                @foreach ($all_products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                        </select>

                                            <span class="text-danger">@error('txt_edit_product_name') {{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_edit_price_per_piece">Price Per Piece</label>
                                            <input type="number" class="form-control" id="txt_edit_price_per_piece" name="txt_edit_price_per_piece" readonly>
                                        </div>
                                        <span class="text-danger">@error('txt_edit_price_per_piece') {{ $message }} @enderror</span>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_edit_total_quantity_transfered">Total Quantiy Transfered</label>
                                            <input type="number" class="form-control" id="txt_edit_total_quantity_transfered" name="txt_edit_total_quantity_transfered" readonly>
                                        </div>
                                        <span class="text-danger">@error('txt_edit_total_quantity_transfered') {{ $message }} @enderror</span>
                                    </div> --}}
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_edit_quantity_transfered_in_crates">Quantity Transfered (In Crates)</label>
                                            <input type="number" class="form-control" id="txt_edit_quantity_transfered_in_crates" name="txt_edit_quantity_transfered_in_crates">
                                        </div>
                                        <span class="text-danger">@error('txt_edit_quantity_transfered_in_crates') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_edit_quantity_transfered_in_pieces"> Quantity Transfered (in Pieces)</label>
                                            <input type="number" class="form-control" id="txt_edit_quantity_transfered_in_pieces" name="txt_edit_quantity_transfered_in_pieces">

                                            <span class="text-danger">@error('txt_edit_quantity_transfered_in_pieces') {{ $message }} @enderror</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_edit_collected_at">Date Transfered</label>
                                            <input type="text" class="form-control" id="txt_edit_collected_at" onfocus="(this.type='date')" onblur="(this.type='text')" name="txt_edit_collected_at">
                                        </div>
                                        <span class="text-danger">@error('txt_edit_collected_at') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_edit_collected_by">Collected By</label>
                                            <select class="form-control" style="width: 100%;" id="txt_edit_collected_by"  name="txt_edit_collected_by">
                                                <option selected id="collected_by"></option>
                                                @foreach ($all_users as $user)
                                                    <option value="{{$user->first_name}} {{$user->last_name}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('txt_edit_collected_by') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txt_edit_remarks">Remarks</label>
                                            <textarea class="form-control" rows="3" name="txt_edit_remarks" id="txt_edit_remarks"></textarea>
                                        </div>
                                        <span class="text-danger">@error('txt_edit_remarks') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Update Transfer</button>
                        </div>
                    </form>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="delete_transfer_record" >
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


    </section>

  </div>
  <!-- /.content-wrapper -->

  @section('Extra_JS')
    <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection


    <script>
        function edit_transfer_record() {
            $('#edit_transfer_record').on('shown.bs.modal', function(e) {
            var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
                modal = $(this)
            var transfer_id = link.data('transfer_id')
            var product_id = link.data('product_id')
            var product_name = link.data('product_name')
            var price_per_piece = link.data('price_per_piece')
            var quantity_transfered_in_crates = link.data('quantity_transfered_in_crates')
            var quantity_transfered_in_pieces = link.data('quantity_transfered_in_pieces')
            var total_quantity_transfered = link.data('total_quantity_transfered')
            var collected_at = link.data('collected_at')
            var collected_by = link.data('collected_by')
            var remarks = link.data('remarks')

            modal.find('#txt_transfer_id').val(transfer_id);
            modal.find('#txt_product_id').val(product_id);
            modal.find('#txt_edit_product_name').val(product_name);
            modal.find('#txt_edit_price_per_piece').val(price_per_piece);
            modal.find('#txt_edit_quantity_transfered_in_crates').val(quantity_transfered_in_crates);
            modal.find('#txt_edit_quantity_transfered_in_pieces').val(quantity_transfered_in_pieces);
            modal.find('#txt_edit_total_quantity_transfered').val(quantity_transfered_in_pieces);
            modal.find('#txt_edit_collected_at').val(collected_at);
            // modal.find('#collected_by').val(collected_by);
            modal.find('#txt_edit_remarks').val(remarks);
            modal.find('#product_name').val(product_id);
            document.getElementById('product_name').innerHTML = product_name;
            document.getElementById('collected_by').innerHTML = collected_by;
            document.getElementById('title').innerHTML = 'Edit '+ product_name + 'Transfer';
            });
        }


        function delete_transfer_record() {
            $('#delete_transfer_record').on('shown.bs.modal', function(e) {
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
        $("#txt_quantity_to_transfer_in_crate").attr("value", 0);
        $("#txt_quantity_to_transfer_in_pieces").attr("value", 0);

        var today = new Date();
        var dd = ("0" + (today.getDate())).slice(-2);
        var mm = ("0" + (today.getMonth() +　1)).slice(-2);
        var yyyy = today.getFullYear();
        today =  yyyy + '-' + mm + '-' + dd ;
        // today =  mm + '/' + dd + '/' + yyyy ;
        $("#txt_collected_at").attr("value", today);
    </script>



@endsection



