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
              <li class="breadcrumb-item"><a href="#">Products</a></li>
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
            <h3 class="card-title">Products </h3>

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
            <form action="{{route('add_product')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_product_name">Product Name</label>
                            <input type="text" class="form-control" id="txt_product_name" name="txt_product_name" value="{{old('txt_product_name')}}">
                        </div>
                        <span class="text-danger">@error('txt_product_name') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_price_per_item">Price Per Item</label>
                            <input type="number" min="0" step=".01" class="form-control" id="txt_price_per_item" name="txt_price_per_item" value="{{old('txt_price_per_item')}}">
                        </div>
                        <span class="text-danger">@error('txt_price_per_item') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_quantity_per_crate">Quantity per Crate</label>
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_quantity_per_crate" name="txt_quantity_per_crate" value="{{old('txt_quantity_per_crate')}}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_per_crate') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_stock_threshold">Stock Threshold</label>
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_stock_threshold" name="txt_stock_threshold" value="{{old('txt_stock_threshold')}}">
                        </div>
                        <span class="text-danger">@error('txt_stock_threshold') {{ $message }} @enderror</span>
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
            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Save Product Records
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
                <h3 class="card-title"> Product Details</h3>
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
                        <th>Product</th>
                        <th>Price per Item</th>
                        <th>Quantity per Crate</th>
                        <th>Price per Crate</th>
                        <th>Stock Threshold</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Updated By</th>
                        <th>Updated At</th>

                        @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                        <th>Action</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $all_products as $product)
                        <tr>
                            {{-- <td>{{$product->name}}</td> --}}
                            <td>{{ ucwords(trans($product->name)) }}</td>
                            <td>{{$product->price_per_item}}</td>
                            <td>{{$product->quantity_per_crate}}</td>
                            <td>{{$product->price_per_crate}}</td>
                            <td>{{$product->stock_threshold}}</td>
                            <td>
                                @if ($product->status == "Active")
                                    <p class="text-success">{{$product->status}}</p>
                                @elseif ($product->status == "Inactive")
                                    <p class="text-danger">{{$product->status}}</p>
                                @endif
                            </td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->created_by}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>
                                @if ($product->updated_by == "" || $product->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$product->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($product->updated_at == "" || $product->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$product->updated_at}}</p>
                                @endif
                            </td>
                            @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                                {{-- Edit Button --}}
                                <td class="text-center">
                                    <a class="text-primary"
                                        onclick="edit_product(this)"
                                        data-toggle="modal"
                                        data-target="#edit-product"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-status="{{ $product->status }}"
                                        data-price_per_item="{{ $product->price_per_item }}"
                                        data-quantity_per_crate="{{ $product->quantity_per_crate }}"
                                        data-stock_threshold="{{ $product->stock_threshold }}"
                                        data-description="{{ $product->description }}"
                                    >
                                    <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- <a class="text-danger"
                                        onclick="delete_product(this)"
                                        data-toggle="modal"
                                        data-target="#delete-product"
                                        data-product_id="{{ $product->id }}"
                                        data-product_name="{{ $product->name }}"
                                    >
                                    <i class="fas fa-trash"></i>
                                    </a> --}}
                                </td>
                            @endif
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



      <div class="modal fade" id="edit-product" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_product') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="product_id" name="product_id">

                                    <label for="txt_edit_product_name"> Product Name</label>
                                    <input type="text" class="form-control" id="txt_edit_product_name" name="txt_edit_product_name">

                                    <span class="text-danger">@error('txt_edit_product_name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_price_per_item">Price Per Item</label>
                                    <input type="number" min="0" step=".01" class="form-control" id="txt_edit_price_per_item" name="txt_edit_price_per_item">
                                </div>
                                <span class="text-danger">@error('txt_edit_price_per_item') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_quantity_per_crate"> Quantity Per Crate</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_quantity_per_crate" name="txt_edit_quantity_per_crate">

                                    <span class="text-danger">@error('txt_edit_quantity_per_crate') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_stock_threshold">Stock Threshold</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_stock_threshold" name="txt_edit_stock_threshold">
                                </div>
                                <span class="text-danger">@error('txt_edit_stock_threshold') {{ $message }} @enderror</span>
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

                    <div class="card-footer">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_status">Status</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_status"  name="txt_edit_status">
                                        <option selected id="selected"></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    <span class="text-danger">@error('txt_edit_status') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update Product</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      {{-- <div class="modal fade" id="delete-product" >
        <div class="modal-dialog">
          <div class="modal-content">

            <form action="{{ route('delete_product') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="product_id" name="product_id">
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
      </div> --}}



    </section>


</div>
  <!-- /.content-wrapper -->

  @section('Extra_JS')
  <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection

  <script>
    function edit_product() {
        $('#edit-product').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var product_id = link.data('id')
        var product_name = link.data('name')
        var status = link.data('status')
        var price_per_item = link.data('price_per_item')
        var quantity_per_crate = link.data('quantity_per_crate')
        var stock_threshold = link.data('stock_threshold')
        var description = link.data('description')

        modal.find('#product_id').val(product_id);
        modal.find('#txt_edit_product_name').val(product_name);
        modal.find('#txt_edit_price_per_item').val(price_per_item);
        modal.find('#txt_edit_quantity_per_crate').val(quantity_per_crate);
        modal.find('#txt_edit_stock_threshold').val(stock_threshold);
        modal.find('#selected').val(status);
        modal.find('#txt_edit_description').val(description);
        document.getElementById('selected').innerHTML = status;
        document.getElementById('title').innerHTML = 'Edit '+ product_name;
        });
    }


    function delete_product() {
        $('#delete-product').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var product_id = link.data('product_id')
        var product_name = link.data('product_name')

        modal.find('#product_id').val(product_id);
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
            "order": [[ 8, "desc" ]],
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



@endsection



