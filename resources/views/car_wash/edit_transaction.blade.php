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
            <h3 class="card-title">Edit Transactions</h3>

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
            <form action="{{route('update_transaction', $transaction_to_edit->transaction_id)}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_edit_vehicle_type_id">Vehicle Name</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_edit_vehicle_type_id"  name="txt_edit_vehicle_type_id" >
                                <option selected value="{{ $transaction_to_edit->vehicle_type_id }}">{{ $transaction_to_edit->vehicle_type_name }}</option>
                                @foreach ($all_vehicles_types as $vehicle_type )
                                    <option value="{{ $vehicle_type->id }}">{{ $vehicle_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_edit_vehicle_type_id') {{ $message }} @enderror</span>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_edit_service_id">Services</label>
                            <select class="select2" multiple="multiple" data-placeholder="Select Services" name="txt_edit_service_id[]" id="txt_edit_service_id" style="width: 100%;">

                                @foreach (json_decode($transaction_to_edit->service_ids, true) as $service_id )
                                    @foreach ( $all_services as $service )
                                        @if ($service->id == $service_id)
                                            <option selected value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                                {{-- <option selected value="">
                                    @php
                                        foreach (json_decode($transaction_to_edit->service_ids, true) as $service_id) {
                                            foreach ( $all_services as $service ){
                                                if ($service->id == $service_id){
                                                    echo $service->name;
                                                }
                                            }
                                        }
                                     @endphp
                                </option> --}}

                                @foreach ($all_services as $service )
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_edit_service_id') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_edit_washer_id">Select Car Washer</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_edit_washer_id"  name="txt_edit_washer_id" value="{{ old('txt_edit_washer_id') }}" >
                                <option selected value="{{ $transaction_to_edit->washer_id }}">{{ $transaction_to_edit->firstname }} {{ $transaction_to_edit->lastname }}</option>
                                @foreach ($all_washers as $washer )
                                    <option value="{{ $washer->id }}">{{ $washer->firstname }} {{ $washer->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_edit_washer_id') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_edit_supervisor">Supervisor</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_edit_supervisor"  name="txt_edit_supervisor" value="{{ old('txt_edit_supervisor') }}" >
                                <option selected value="{{ $transaction_to_edit->supervisor }}">{{ $transaction_to_edit->supervisor }}</option>
                                @foreach ($all_users as $user )
                                    <option value="{{ $user->first_name }} {{ $user->last_name }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_edit_supervisor') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_edit_total_price">Total Price</label>
                            <input type="number" min="0" step=".01" class="form-control" id="txt_edit_total_price" name="txt_edit_total_price" value="{{ $transaction_to_edit->amount }}" readonly>
                        </div>
                        <span class="text-danger">@error('txt_edit_total_price') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_edit_washer_commission">Washer Commision</label>
                            <input type="number" min="0" step=".01" class="form-control" id="txt_edit_washer_commission" name="txt_edit_washer_commission" value="{{ $transaction_to_edit->washer_commission }}" readonly>
                         </div>
                        <span class="text-danger">@error('txt_edit_washer_commission') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_edit_description">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Transaction Description" name="txt_edit_description">{{ $transaction_to_edit->transaction_description }}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_edit_description') {{ $message }} @enderror</span>
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
            Perform Washing Bay Transactions Here
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.container-fluid -->
    </section>

</div>

  @section('Extra_JS')
  <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection


  {{-- ======== Perform Calculation on Services Selected ============== --}}
    @section('Service_JS')
    <script type="text/javascript" src="{{ asset('assets/js/service.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            setServiceList( @json($all_pricing) );
        });
    </script>
    @endsection


@endsection



