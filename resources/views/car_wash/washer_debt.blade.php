@extends('layouts.base_template')
@section('content')


@php
    $user_session_details = Session::get('user_session');
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
            {{-- <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-vehicle-type">
                    Set Vehicle Type
                </button>
            </ol> --}}
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
            <h3 class="card-title">Car Wash Services </h3>

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
            <form action="{{route('add_washer_debt')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_washer_id">Car Washer</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_washer_id"  name="txt_washer_id" value="{{ old('txt_washer_id') }}" >
                                <option selected disabled>Select Washer</option>
                                @foreach ($all_washers as $washer )
                                    <option value="{{ $washer->id }}" {{ old('txt_washer_id') == $washer->id ? 'selected' : '' }}>{{ $washer->firstname }} {{ $washer->lastname }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('txt_washer_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_debt_amount">Debt Amount</label>
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_debt_amount" name="txt_debt_amount" >                        </div>
                        <span class="text-danger">@error('txt_debt_amount') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_amount_paid">Amount Paid</label>
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_amount_paid" name="txt_amount_paid" >                        </div>
                        <span class="text-danger">@error('txt_amount_paid') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_amount_left">Amount Left</label>
                            <input type="number" min="0" oninput="this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_amount_left" name="txt_amount_left" readonly>
                            </div>
                        <span class="text-danger">@error('txt_amount_left') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_payment_status">Payment Status</label>
                            <select class="form-control" style="width: 100%;" id="txt_payment_status"  name="txt_payment_status" value="{{ old('txt_payment_status') }}" >
                                <option selected id="selected_status"></option>
                                <option value="Fully Paid">Fully Paid</option>
                                <option value="Partly Paid">Partly Paid</option>
                                <option value="Not Paid">Not Paid</option>
                                <option value="Runaway">Runaway</option>
                            </select>
                            <span class="text-danger">@error('txt_payment_status') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_paid_to">Paid To</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_paid_to"  name="txt_paid_to" value="{{ old('txt_paid_to') }}" >
                                <option selected disabled>Select Here</option>
                                @foreach ($all_users as $users)
                                    <option value="{{ $users->username }}">{{ $users->first_name }} {{ $users->last_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('txt_paid_to') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_paid_on">Paid On</label>
                            <input type="date" class="form-control" id="txt_paid_on" name="txt_paid_on" >
                            <span class="text-danger">@error('txt_paid_on') {{ $message }} @enderror</span>
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_debt_description">Remark</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Description" name="txt_debt_description">{{old('txt_debt_description')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_debt_description') {{ $message }} @enderror</span>
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
            Save Service Records
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
                <h3 class="card-title"> Services Details</h3>
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
                        {{-- <th>Vehicle Name</th> --}}
                        <th>Washer Name</th>
                        <th>Amount Owed </th>
                        <th>Payment Status</th>
                        <th>Amount Paid</th>
                        <th>Amount Left</th>
                        <th>Collected On</th>
                        <th>Paid On</th>
                        <th>Paid To</th>
                        <th>Remarks</th>
                        <th>Updated At</th>
                        <th>Updated By</th>

                        @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                        <th>Action</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $all_washer_debts as $debts)
                        <tr class="text-center">
                            <td>{{ucwords(trans($debts->firstname)) }} {{ucwords(trans($debts->lastname)) }}</td>
                            <td>GH¢ {{number_format($debts->debt_amount, 2 ) }}</td>
                            <td>{{$debts->payment_status}}</td>
                            <td>
                                @if ($debts->amount_paid == "" || $debts->amount_paid == NULL)
                                    <p>-</p>
                                @else
                                    <p>{{number_format($debts->amount_paid, 2)}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($debts->amount_left == "" || $debts->amount_left == NULL)
                                    <p>-</p>
                                @else
                                    <p>{{number_format($debts->amount_left, 2)}}</p>
                                @endif
                            </td>
                            <td>{{$debts->created_at}}</td>
                            <td>
                                @if ($debts->paid_on == "" || $debts->paid_on == NULL)
                                    <p>-</p>
                                @else
                                    <p>{{$debts->paid_on}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($debts->paid_to == "" || $debts->paid_to == NULL)
                                    <p>-</p>
                                @else
                                    <p>{{ucwords(trans($debts->paid_to))}}</p>
                                @endif
                            </td>
                            <td>{{ ucfirst($debts->remark) }}</td>
                            <td>
                                @if ($debts->updated_by == "" || $debts->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$debts->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($debts->updated_at == "" || $debts->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$debts->updated_at}}</p>
                                @endif
                            </td>
                            @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')

                                <td class="text-center">
                                    <a class="text-primary"
                                        onclick="edit_debts(this)"
                                        data-toggle="modal"
                                        data-target="#edit_debts"
                                        data-id="{{ $debts->debt_id }}"
                                        data-washer_id="{{ $debts->washer_id }}"
                                        data-washer_firstname="{{ $debts->firstname }}"
                                        data-washer_lastname="{{ $debts->lastname }}"
                                        data-nickname="{{ $debts->nickname }}"
                                        data-debt_amount="{{ $debts->debt_amount }}"
                                        data-amount_paid="{{ $debts->amount_paid }}"
                                        data-amount_left="{{ $debts->amount_left }}"
                                        data-payment_status="{{ $debts->payment_status }}"
                                        data-paid_on="{{ $debts->paid_on }}"
                                        data-paid_to="{{ $debts->paid_to }}"
                                        data-remark="{{ $debts->remark }}"
                                    >
                                    <i class="fas fa-edit"></i>
                                    </a>
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



      <div class="modal fade" id="edit_debts" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="title">Edit Pricing</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_washer_debt') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="debt_id" id="debt_id">

                                    <label for="txt_edit_washer_id">Car Washer</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_washer_id"  name="txt_edit_washer_id" >
                                        <option selected id="selected_washer"></option>
                                        @foreach ($all_washers as $washer )
                                            <option value="{{ $washer->id }}">{{ $washer->firstname }} {{ $washer->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_edit_washer_id') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_debt_amount">Debt Amount</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_debt_amount" name="txt_edit_debt_amount" >                        </div>
                                <span class="text-danger">@error('txt_edit_debt_amount') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_amount_paid">Amount Paid</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_amount_paid" name="txt_edit_amount_paid" >                        </div>
                                <span class="text-danger">@error('txt_edit_amount_paid') {{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_amount_left">Amount Left</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_amount_left" name="txt_edit_amount_left"  readonly>                        </div>
                                <span class="text-danger">@error('txt_edit_amount_left') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_payment_status">Payment Status</label>
                                    <select class="form-control " style="width: 100%;" id="txt_edit_payment_status"  name="txt_edit_payment_status" >
                                        <option selected id="selected_payment_status"></option>
                                        <option value="Fully Paid">Fully Paid</option>
                                        <option value="Partly Paid">Partly Paid</option>
                                        <option value="Not Paid">Not Paid</option>
                                        <option value="Runaway">Runaway</option>
                                    </select>
                                    <span class="text-danger">@error('txt_edit_payment_status') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_paid_to">Paid To</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_paid_to"  name="txt_edit_paid_to" >
                                        <option selected id="selected_paid_to"></option>
                                        @foreach ($all_users as $users)
                                            <option value="{{ $users->username }}">{{ ucwords($users->username) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_edit_paid_to') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_paid_on">Paid On</label>
                                    <input type="date" class="form-control" id="txt_edit_paid_on" name="txt_edit_paid_on" >
                                    <span class="text-danger">@error('txt_edit_paid_on') {{ $message }} @enderror</span>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_debt_description">Remark</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Description" name="txt_edit_debt_description" id="txt_edit_debt_description"></textarea>
                                </div>
                                <span class="text-danger">@error('txt_edit_debt_description') {{ $message }} @enderror</span>
                            </div>
                        </div>
                      </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update Debt</button>
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
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("txt_paid_on")[0].setAttribute('max', today);
    document.getElementsByName("txt_edit_paid_on")[0].setAttribute('max', today);
</script>


  @section('WasherDebt_JS')
    <script type="text/javascript" src="{{ asset('assets/js/washer_debt.js') }}"></script>

    {{-- <script type="text/javascript">
        $(document).ready(function(){
            setServiceList( @json($all_pricing));
        });
    </script> --}}
  @endsection

  <script>
    function edit_debts() {
        $('#edit_debts').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var debt_id = link.data('id')
        var washer_id = link.data('washer_id')
        var washer_firstname = link.data('washer_firstname')
        var washer_lastname = link.data('washer_lastname')
        var nickname = link.data('nickname')
        var debt_amount = link.data('debt_amount')
        var amount_paid = link.data('amount_paid')
        var amount_left = link.data('amount_left')
        var payment_status = link.data('payment_status')
        var paid_on = link.data('paid_on')
        var paid_to = link.data('paid_to')
        var remark = link.data('remark')


        modal.find('#debt_id').val(debt_id);
        modal.find('#selected_washer').val(washer_id);
        modal.find('#txt_edit_debt_amount').val(debt_amount);
        modal.find('#txt_edit_amount_paid').val(amount_paid);
        modal.find('#txt_edit_amount_left').val(amount_left);
        modal.find('#selected_payment_status').val(payment_status);
        modal.find('#selected_paid_to').val(paid_to);
        modal.find('#txt_edit_paid_on').val(paid_on);
        modal.find('#txt_edit_debt_description').val(remark);
        document.getElementById('selected_washer').innerHTML = washer_firstname+' '+washer_lastname;
        document.getElementById('selected_payment_status').innerHTML = payment_status;
        document.getElementById('selected_paid_to').innerHTML = paid_to.charAt(0).toUpperCase()+ paid_to.slice(1);
        // document.getElementById('txt_edit_debt_description').innerHTML = remark;
        document.getElementById('title').innerHTML = 'Edit '+ washer_firstname+' '+washer_lastname+'\s debt';
        });
    }


    // function delete_product() {
    //     $('#delete-product').on('shown.bs.modal', function(e) {
    //     var link = $(e.relatedTarget)
    //         modal = $(this)
    //     var product_id = link.data('product_id')
    //     var product_name = link.data('product_name')

    //     modal.find('#product_id').val(product_id);
    //     document.getElementById('product_name').innerHTML = product_name;
    //     });

    // }

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
            "order": [[ 5, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>



@endsection



