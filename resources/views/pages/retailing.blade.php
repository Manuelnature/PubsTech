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
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-most-purchase">
                    Add To Most Purchased
                </button>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="add-most-purchase" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Item to Most Purchased</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('add_most_purchased') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Products</label>
                                    <select class="form-control" data-placeholder="Select Product" style="width: 100%;" id="txt_modal_product_id"  name="txt_modal_product_id" value="{{ old('txt_modal_product_id') }}" >
                                        <option selected disabled>Select Product</option>
                                        @foreach ($all_products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_modal_product_id') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_modal_product_photo">Upload File</label>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="txt_modal_product_photo" name="txt_modal_product_photo" onChange="loadProductImage(this);">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                      </div>
                                </div>
                                <span class="text-danger">@error('txt_modal_product_photo') {{ $message }} @enderror</span>
                                <div>
                                    <img id="uploaded_product_image" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Retailing </h3>

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
            <form action="{{ route('add_sale') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Products</label>
                                    <select class="form-control" data-placeholder="Select Product" style="width: 100%;" id="txt_product_id"  name="txt_product_id" value="{{ old('txt_product_id') }}" >
                                        <option selected disabled>Select Product</option>
                                        @foreach ($all_products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_product_id') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="txt_quantity">Quantity</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_quantity" name="txt_quantity" placeholder="Quantity">
                                </div>
                                <span class="text-danger">@error('txt_quantity') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_remarks">Remarks</label>
                                    <textarea class="form-control" rows="3" placeholder="" name="txt_remarks">{{old('txt_remarks')}}</textarea>
                                </div>
                                <span class="text-danger">@error('txt_remarks') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="txt_total_amount">Total (Gh¢)</label>
                                    <input type="number" class="form-control" id="txt_total_amount" name="txt_total_amount" readonly>
                                </div>
                                <span class="text-danger">@error('txt_total_amount') {{ $message }} @enderror</span>
                                <button type="submit" class="btn btn-secondary">Enter</button>
                            </div>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-md-6">
                        <label>Most Purchased</label>
                        <div class="table-responsive">
                        <table class="table text-center">
                            <tr class="row">
                                @foreach ($most_purchased_products as $most_purchased)
                                <td class="col-md-3">
                                    <img src="assets/img/products/{{ $most_purchased->photo }}" class="img-thumbnail"  data-toggle="modal"
                                    onclick="enter_product(this)"
                                    data-target="#product_modal"
                                    data-id="{{ $most_purchased->id }}"
                                    data-name="{{ $most_purchased->name }}"
                                    >
                                </td>
                                @endforeach
                            </tr>
                        </table>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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

      <div class="modal fade" id="product_modal" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="product_name_modal"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form class="form-horizontal" action="{{ route('add_sale_from_modal') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control" id="txt_product_id_modal" name="txt_product_id_modal">
                        <input type="hidden" class="form-control" id="txt_product_name_modal" name="txt_product_name_modal">

                        <label for="txt_quantity_model" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                        <input type="number" min="0" oninput="this.value =
                        !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_quantity_modal" name="txt_quantity_modal" placeholder="Quantity">
                        <span class="text-danger">@error('txt_quantity_modal') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row">
                            <label for="txt_total_amount_modal" class="col-sm-2 col-form-label">Total (Gh¢)</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="txt_total_amount_modal" name="txt_total_amount_modal" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_remarks_modal">Remarks</label>
                                    <textarea class="form-control" rows="3" placeholder="" name="txt_remarks_modal">{{old('txt_remarks_modal')}}</textarea>
                                </div>
                                <span class="text-danger">@error('txt_remarks_modal') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>


    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">

            <div class="card">
                <div class="card-header">
                <h3 class="card-title">My Sales Records For Today</h3>
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
                <table id="my_sales" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        {{-- <th>Original Stock</th> --}}
                        <th>Stock Before</th>
                        <th>Quantity Sold</th>
                        <th>Stock After</th>
                        <th>Expected Amount</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Remarks</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($individual_sales_for_today as $today_sales)
                        <tr>
                            <td>{{  ucwords(trans($today_sales->name)) }}</td>
                            {{-- <td>{{ $today_sales->original_stock }}</td> --}}
                            <td>{{ $today_sales->stock_before }}</td>
                            <td>{{ $today_sales->quantity_sold }}</td>
                            <td>{{ $today_sales->stock_after }}</td>
                            <td>
                                    @php
                                        echo 'Gh¢ '.number_format($today_sales->expected_price, 2);
                                    @endphp
                            </td>
                            <td>{{ ucwords(trans($today_sales->created_by)) }}</td>
                            <td>{{ $today_sales->created_at }}</td>
                            <td>
                                    @if ($today_sales->remarks == "" || $today_sales->remarks == NULL)
                                        <p>No Remarks</p>
                                    @else
                                        <p>{{$today_sales->remarks}}</p>
                                    @endif
                            </td>
                                <td>
                                    @if (($current_time->diffInHours($today_sales->created_at)) < 1)
                                        <a class="text-primary"
                                        onclick="edit_sales_record(this)"
                                        data-toggle="modal"
                                        data-target="#edit_sales_record"
                                        data-sale_id="{{ $today_sales->id }}"
                                        data-product_id="{{ $today_sales->product_id }}"
                                        data-product_name="{{ $today_sales->name }}"
                                        data-quantity_sold="{{ $today_sales->quantity_sold }}"
                                        data-stock_before="{{ $today_sales->stock_before }}"
                                        data-stock_after="{{ $today_sales->stock_after }}"
                                        data-expected_price="{{ $today_sales->expected_price }}"
                                        data-remarks="{{ $today_sales->remarks }}"
                                        >
                                        <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
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

    @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Overrall Sales Record</h3>
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
                    <table id="all_sales" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            {{-- <th>Original Stock</th> --}}
                            <th>Stock Before</th>
                            <th>Quantity Sold</th>
                            <th>Stock After</th>
                            <th>Expected Amount</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($all_sales_records as $sales_record)
                            <tr>
                                <td>{{ ucwords(trans($sales_record->name)) }}</td>
                                {{-- <td>{{ $sales_record->original_stock }}</td> --}}
                                <td>{{ $sales_record->stock_before }}</td>
                                <td>{{ $sales_record->quantity_sold }}</td>
                                <td>{{ $sales_record->stock_after }}</td>
                                <td>
                                        @php
                                            echo 'Gh¢ '.number_format($sales_record->expected_price, 2);
                                        @endphp
                                </td>
                                <td>{{ $sales_record->created_by }}</td>
                                <td>{{ $sales_record->created_at }}</td>
                                <td>
                                        @if ($sales_record->remarks == "" || $sales_record->remarks == NULL)
                                            <p>No Remarks</p>
                                        @else
                                            <p>{{$sales_record->remarks}}</p>
                                        @endif
                                </td>

                                <td>
                                    @if (($current_time->diffInHours($sales_record->created_at)) < 1)
                                        <a class="text-primary"
                                        onclick="edit_sales_record(this)"
                                        data-toggle="modal"
                                        data-target="#edit_sales_record"
                                        data-sale_id="{{ $sales_record->id }}"
                                        data-product_id="{{ $sales_record->product_id }}"
                                        data-product_name="{{ $sales_record->name }}"
                                        data-quantity_sold="{{ $sales_record->quantity_sold }}"
                                        data-stock_before="{{ $sales_record->stock_before }}"
                                        data-stock_after="{{ $sales_record->stock_after }}"
                                        data-expected_price="{{ $sales_record->expected_price }}"
                                        data-remarks="{{ $sales_record->remarks }}"
                                        >
                                        <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
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


            <div class="modal fade" id="edit_sales_record" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="edit_title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{ route('update_sale') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="hidden" class="form-control" id="txt_sale_id" name="txt_sale_id">
                                                {{-- <input type="hidden" class="form-control" id="txt_product_id" name="txt_product_id"> --}}

                                                <label for="txt_edit_product_id"> Product Name</label>
                                                <select class="form-control" data-placeholder="Select Product" style="width: 100%;" name="txt_edit_product_id" id="txt_edit_product_id" >
                                                    <option selected id="product_name"></option>
                                                    @foreach ($all_products as $product)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                            </select>

                                                <span class="text-danger">@error('txt_edit_product_id') {{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="txt_edit_quantity">Quantity</label>
                                                <input type="number" min="0" oninput="this.value =
                                                !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_quantity" name="txt_edit_quantity" >
                                            </div>
                                            <span class="text-danger">@error('txt_edit_quantity') {{ $message }} @enderror</span>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txt_edit_total">Total</label>
                                                <input type="number" class="form-control" id="txt_edit_total" name="txt_edit_total" readonly>
                                            </div>
                                            <span class="text-danger">@error('txt_edit_total') {{ $message }} @enderror</span>
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
                                <button type="submit" class="btn btn-secondary">Update Sale</button>
                            </div>
                        </form>
                    </div>
                <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
            </div>


        </section>
    @endif

</div>
<!-- /.content-wrapper -->




{{-- ================= Edit Sales modal =============== --}}

<script>
    function edit_sales_record() {
        $('#edit_sales_record').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var sale_id = link.data('sale_id')
        var product_id = link.data('product_id')
        var product_name = link.data('product_name')
        var quantity_sold = link.data('quantity_sold')
        var stock_before = link.data('stock_before')
        var stock_after = link.data('stock_after')
        var expected_price = link.data('expected_price')
        var remarks = link.data('remarks')

        modal.find('#txt_sale_id').val(sale_id);
        modal.find('#txt_edit_product_id').val(product_id);
        modal.find('#txt_edit_product_name').val(product_name);
        modal.find('#txt_edit_quantity').val(quantity_sold);
        modal.find('#txt_edit_remarks').val(remarks);
        modal.find('#product_name').val(product_id);
        modal.find('#txt_edit_total').val(expected_price);
        document.getElementById('product_name').innerHTML = product_name;
        document.getElementById('edit_title').innerHTML = 'Edit '+ product_name + 'Sales';
        });


    }


    // function delete_transfer_record() {
    //     $('#delete_transfer_record').on('shown.bs.modal', function(e) {
    //     var link = $(e.relatedTarget)
    //         modal = $(this)
    //     var warehouse_id = link.data('warehouse_id')
    //     var product_id = link.data('product_id')
    //     var product_name = link.data('product_name')

    //     modal.find('#warehouse_id').val(warehouse_id);
    //     document.getElementById('product_name').innerHTML = product_name;
    //     });

    // }
</script>



{{-- ======== Show modal with Values ============== --}}
  <script>
    function enter_product() {
        $('#product_modal').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var product_id = link.data('id')
        var product_name = link.data('name')

        modal.find('#txt_product_id_modal').val(product_id);
        modal.find('#txt_product_name_modal').val(product_name);
        document.getElementById('product_name_modal').innerHTML = product_name;
        });
    }

            $("#txt_quantity_modal").attr("value", 0);
            $("#txt_quantity").attr("value", 0);
  </script>



{{-- ======== Clear All Inputs when closed ============== --}}
<script>
    $('#product_modal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        })
</script>

{{-- ======== Perform Calculation on Product Selected ============== --}}
@section('Product_JS')
    <script type="text/javascript" src="{{ asset('assets/js/product.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            setProductList( @json($all_products) );
        });
    </script>
 @endsection

 <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

 <script>
    $(function () {
      bsCustomFileInput.init();
    });
</script>


@section('Extra_JS')
    <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
@endsection

@section('LoadImage_JS')
  <script src="{{ asset('assets/js/load_image.js') }}" ></script>
@endsection




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
            $("#my_sales").DataTable({
            "paging": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 6, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#my_sales_wrapper .col-md-6:eq(0)');

            $('#all_sales').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "order": [[ 6, "desc" ]],
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#all_sales_wrapper .col-md-6:eq(0)');
        });
    </script>

@endsection



