@extends('layouts.frontend')
@section('title')
    @if(Route::currentRouteName() == 'invoice.amended')
        Amended
    @endif
    Invoices
@endsection
@section('header')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content-header">
        <h1>
            @if(Route::currentRouteName() == 'invoice.amended')
                Amended
            @endif
            Invoice
        </h1>
        <div class="text-right">
            <a href="{{route('invoice.create')}}">
                @can('Generate Invoice')
                    <button class="btn btn-success">Create Invoice</button>
                @endcan
            </a>
            @can('Refund Invoice')
                <button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info"
                        id="refund" style="display:none;">Refund Invoice
                </button>
            @endcan
        </div>
        <div id="append"></div>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa fa-paperclip"></i>Invoice</li>
        </ol>
    </section>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 34px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 34px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px !important;
        }
        .select2-container--default .select2-selection--single {
            border: 1px solid #d2d6de !important;
            border-radius: 0 !important;
        }
    </style>

                <style>
    .export-btn {
        margin-right: 5px;
    }
    .export-btn i {
        margin-right: 5px;
    }
    .btn-group {
        margin-bottom: 15px;
    }

                    .card {
                        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                        border: 1px solid rgba(0, 0, 0, 0.125);
                    }

                    .form-label {
                        margin-bottom: 0.5rem;
                        font-weight: 500;
                        color: #6c757d;
                    }

                    .btn {
                        padding: 0.5rem 1rem;
                        font-weight: 500;
                    }

                    .btn-primary {
                        background-color: #0d6efd;
                        border-color: #0d6efd;
                    }

                    .btn-light {
                        background-color: #f8f9fa;
                        border-color: #f8f9fa;
                    }

                    .btn i {
                        margin-right: 0.5rem;
                    }
                </style>
@stop
@section('content')

    <div class="box box-info">
        <div class="box-body">
            <div class="table-responsive">

                @if(request()->hasAny(['search', 'airline_name', 'service_name', 'date_type', 'start_date', 'end_date']))
                    <div class="card mb-2">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-2 flex-wrap justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="text-muted me-2"><strong>Active Filters:</strong></span>

                                    @if(request('search'))
                                        <div class="badge bg-primary d-inline-flex align-items-center">
                                            <span class="me-2">Search: "{{ request('search') }}"</span>
                                            <a  href="{{ request()->fullUrlWithQuery(array_merge(request()->query(), ['search' => ''])) }}"
                                               class="filter-remove" title="Remove filter">
                                                <span style="color: white; font-size: 17px; margin-left: 5px">x</span>
                                            </a>
                                        </div>
                                    @endif

                                    @if(request('airline_name'))
                                        <div class="badge bg-primary d-inline-flex align-items-center">
                                            <span class="me-2">Airline: {{ request('airline_name') }}</span>
                                            <a href="{{ request()->fullUrlWithQuery(array_merge(request()->query(), ['airline_name' => ''])) }}"
                                               class="filter-remove" title="Remove filter">
                                                <span style="color: white; font-size: 17px; margin-left: 5px">x</span>
                                            </a>
                                        </div>
                                    @endif

                                    @if(request('service_name') && request('service_name') !== 'all')
                                        <div class="badge bg-primary d-inline-flex align-items-center">
                                            <span class="me-2">Service: {{ request('service_name') }}</span>
                                            <a href="{{ request()->fullUrlWithQuery(array_merge(request()->query(), ['service_name' => ''])) }}"
                                               class="filter-remove" title="Remove filter">
                                                <span style="color: white; font-size: 17px; margin-left: 5px">x</span>
                                            </a>
                                        </div>
                                    @endif

                                    @if(request('date_type') && request('start_date') && request('end_date'))
                                        <div class="badge bg-primary d-inline-flex align-items-center">
                            <span class="me-2">
                                {{ ucfirst(str_replace('_', ' ', request('date_type'))) }}:
                                {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }}
                                to
                                {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                            </span>
                                            <a href="{{ request()->fullUrlWithQuery(array_merge(request()->query(), ['date_type' => '', 'start_date' => '', 'end_date' => ''])) }}"
                                               class="filter-remove" title="Remove filter">
                                                <span style="color: white; font-size: 17px; margin-left: 5px">x</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('invoice') }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-x-circle"></i> Clear All Filters
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="mb-0">
                            <div class="row g-3 align-items-end mb-3">
                                <!-- Service Selection -->
                                <div class="col-md-4">
                                    <label class="form-label">Service Type</label>
                                    <select name="service_name" id="service_name" class="form-control select2" onChange="SelectService(this);">
                                        <option value="">--Select Service--</option>
                                        <option value="all" {{ request('service_name') == 'all' ? 'selected' : '' }}>All</option>
                                        @php
                                            $products = \App\products::all();
                                        @endphp
                                        @if($products->count() > 0)
                                            @foreach($products as $product)
                                                <option value="{{ $product->service }}"
                                                        {{ request('service_name') == $product->service ? 'selected' : '' }}>
                                                    {{ $product->service }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Airline Selection -->
                                <div class="col-md-4">
                                    <label class="form-label">Airline Name</label>
                                    <select id="airlineName" name="airline_name" class="form-control select2">
                                        <option value="">Select Airline</option>
                                        @foreach($airlines as $airline)
                                            <option value="{{ $airline }}" {{ request('airline_name') == $airline ? 'selected' : '' }}>
                                                {{ strtoupper($airline) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Search Input -->
                                <div class="col-md-4">
                                    <label class="form-label">Search</label>
                                    <input type="text"
                                           name="search"
                                           value="{{ request('search') }}"
                                           placeholder="Search by invoice no, name, PNR..."
                                           class="form-control">
                                </div>
                            </div>

                            <div class="row g-3 align-items-end mb-3">
                                <!-- Date Type -->
                                <div class="col-md-3">
                                    <label class="form-label">Date Type</label>
                                    <select name="date_type" class="form-control">
                                        <option value="">--Select Date Type--</option>
                                        <option value="booking_date" {{ request('date_type') == 'booking_date' ? 'selected' : '' }}>
                                            Booking date
                                        </option>
                                        <option value="travel_date" {{ request('date_type') == 'travel_date' ? 'selected' : '' }}>
                                            Travel date
                                        </option>
                                    </select>
                                </div>

                                <!-- Date Range -->
                                <div class="col-md-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date"
                                           id="startdate"
                                           name="start_date"
                                           value="{{ request('start_date') }}"
                                           class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date"
                                           id="enddate"
                                           name="end_date"
                                           value="{{ request('end_date') }}"
                                           class="form-control">
                                </div>

                                <!-- Items per page -->
                                <div class="col-md-3">
                                    <label class="form-label">Items per page</label>
                                    <select name="per_page" class="form-control">
                                        @foreach([25, 50, 100] as $size)
                                            <option value="{{ $size }}" {{ request('per_page') == $size ? 'selected' : '' }}>
                                                {{ $size }} items
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        @if(request()->hasAny(['search', 'airline_name', 'service_name', 'date_type', 'start_date', 'end_date']))
                                            <a href="{{ route('invoice') }}" class="btn btn-light">
                                                <i class="bi bi-x-circle"></i> Clear Filters
                                            </a>
                                        @endif
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center py-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-muted">
                                <strong>Total Records:</strong> {{ $invoices->total() }}
                            </div>
                            @if($invoices->total() > 0)
                                <div class="text-muted">
                                    <strong>Showing:</strong>
                                    {{ ($invoices->currentPage() - 1) * $invoices->perPage() + 1 }}
                                    -
                                    {{ min($invoices->currentPage() * $invoices->perPage(), $invoices->total()) }}
                                </div>
                            @endif
                        </div>
                        <div class="text-muted">
                            <strong>Page:</strong> {{ $invoices->currentPage() }} of {{ $invoices->lastPage() }}
                        </div>
                        {!! $invoices->appends(request()->input())->links() !!}
                    </div>
                </div>
                <div class="mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-success btn-sm export-btn" data-type="excel">
            <i class="fas fa-file-excel"></i> Export to Excel
        </button>
        <button type="button" class="btn btn-info btn-sm export-btn" data-type="csv">
            <i class="fas fa-file-csv"></i> Export to CSV
        </button>
    </div>
</div>

                <table id="myTable" class="table table-striped table-bordered">
                    <thead id="ignorePDF">
                    <tr>
                        <th style="display: none">ID</th>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Service Name</th>
                        <th>Receiver Name</th>
                        <th>Travel Date</th>
						<th>Return Travel Date</th>
                        <th>Booking Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center" style="min-width:95px;">Action</th>
                        @if(!Auth::user()->client)
                            <th>Confirmation</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if($invoices->count()>0)
                        @if(Route::currentRouteName() == 'invoice.amended')
                                    @php
                                        $invoices = $invoices->where('amended',1);
                                    @endphp
                            @else
                            @php
                                $invoices = $invoices->where('amended',0);

                            @endphp
                        @endif
                        <?php
                        $invoiceInfo = array();
                        $servic_name = "";
                        $travelDate = "";
                        $traveltime = "";
                        ?>
                        @foreach($invoices->where('refund',0) as $invoice)


                        <?php
                        // $invoice->amendment->count()


                        $invoiceInfo = \App\invoiceInfo::where('invoice_id',$invoice->id)->first();


                        ?>

                        @if($invoice->refund == 0)
                          @if($invoice->flights->count() > 0)
	                        <?php
	                            $flight = $invoice->flights->first();
	                            $bookingTime = strtotime( $flight->booking_date );
                                $travelDate = date("d/m/Y H:i A",strtotime($flight->segment_one_departure));
                                $traveltime = strtotime( $travelDate );
	                            // filter data by start and end date

	                            if(isset($_GET["start_date"]) && !empty($_GET["start_date"]) && isset($_GET["end_date"]) && !empty($_GET["end_date"]) && isset($_GET["date_type"]) && $_GET["date_type"] == "booking_date"){

	                            	$startTime = strtotime( $_GET["start_date"] );
                                    $endTime = strtotime( $_GET["end_date"] );

	                                if($startTime > $bookingTime){
	                                    continue;
	                                }

	                                if($endTime < $bookingTime){
	                                    continue;
	                                }
	                            }elseif(isset($_GET["start_date"]) && !empty($_GET["start_date"]) && isset($_GET["end_date"]) && !empty($_GET["end_date"]) && isset($_GET["date_type"]) && $_GET["date_type"] == "travel_date"){
                                // filter data by start and end date

                                    $startTime = strtotime( $_GET["start_date"] );
                                    $endTime = strtotime( $_GET["end_date"] );

                                    if($startTime > $traveltime){
                                        continue;
                                    }

                                    if($endTime < $traveltime){
                                        continue;
                                    }

                                }
	                        ?>
                          @endif
                        @endif
                        @php
                        if(!empty($invoiceInfo)){
                            $servic_name = $invoiceInfo->service_name;
                          }elseif(isset($flight_jsonArr->service_name[0])){
                            $servic_name = $flight_jsonArr->service_name[0];
                          }else{
                            $servic_name = "Flight";
                          }

                          if(isset($_GET["service_name"]) && !empty($_GET["service_name"]) && $_GET["service_name"] != $servic_name && $_GET["service_name"] != "all"){
                            continue;
                          }
                          @endphp
                            @if($invoice->refund == 0)
                            <?php
                            // echo "<pre>";
                            // print_r($invoice);
                            // echo "</pre>";

                            if(isset($_GET["invoice_type"]) && $_GET["invoice_type"] == "amendment"){
                                if($invoice->amendment->count()){
                                    // echo $invoice->amendment->count();
                                }else{
                                    continue;
                                }
                            }

                            ?>
                                <tr>
                                    <td style="display: none">{{$invoice->id}}</td>
                                    <td>{{$invoice->invoice_no}}</td>
                                    <td>{{Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</td>
                                    <td>{{$servic_name}}</td>
                                    <td>{{$invoice->receiver_name}}</td>
                                    @if($invoice->flights->count() > 0)

                                        @php
                                            $flight = $invoice->flights->first();
									        $allFlightData = json_decode($flight->json_data);
                                        @endphp

                                            <td><?php echo date("d/m/Y H:i A",strtotime($flight->segment_one_departure)); ?></td>
									        <td>

												<?php
												if(empty($flight->json_data)){
												//  echo "segment_one_departure".date("d/m/Y H:i A",strtotime($flight->segment_one_departure))."<br/>";
													 echo date("d/m/Y H:i A",strtotime($flight->segment_two_departure))."<br/>";
												}else{

													if($flight->journey_type=='MULTI WAY'){
														if(isset($allFlightData->segment_one_from)){

															foreach($allFlightData->segment_one_from as $key => $val){
															if($key !=0){
															echo date("d/m/Y H:i A",strtotime($allFlightData->segment_one_departure[$key]))."<br/>";
															}

															}

														}
													}


													if(isset($allFlightData->segment_two_from)){
														 foreach($allFlightData->segment_two_from as $k => $val){
														 echo date("d/m/Y H:i A",strtotime($allFlightData->segment_two_departure[$k]))."<br/>";
														 }
													}


												}
												//echo date("d/m/Y H:i A",strtotime($flight->segment_two_departure));
												?>
									        </td>
                                            <td>{{date("d/m/Y H:i A",strtotime($flight->booking_date))}}</td>

                                    @else
                                        <td>N/A</td>
                                        <td>N/A</td>
									    <td>N/A</td>
                                    @endif

                                    <td>{{$invoice->currency}}{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}</td>
                                        <td>
                                    @if($invoice->status == 1)

                                            <div class="text-success">{{'Paid'}}</div>
                                    @else
                                            <div class="text-danger">{{'Unpaid'}}</div>
                                    @endif
                                            @if($invoice->amendment->count())
                                            <div class="text-warning">({{'Amended'}})</div>
                                        @endif
                                        </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                 @can('Generate Certificate')
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" style="display:block;">
                                                    Certificates
                                                </button>
                                                @endcan



												 @can('Generate Certificate')
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															@if($invoice->certificates->where('type', 'multiPackage')->count() == 0)
															<a class="dropdown-item"
															   href="{{route('generate.certificates',['certName'=>'multiPackageCertificate','invoiceId'=>$invoice->id])}}">Generate
																Multi Service Certificate</a>
																@else
																<a class="dropdown-item"
																   href="{{ route('view.certificate',['id'=>encrypt($invoice->certificates->where('type', 'multiPackage')->first()->id)]) }}">View MultiPackage Certificate</a>
															@endif

																@if($invoice->certificates->where('type', 'singlePackage')->count() == 0)
															<a class="dropdown-item"
															   href="{{route('generate.certificates',['certName'=>'singlePackageCertificate','invoiceId'=>$invoice->id])}}">Generate
																Single Package Certificate</a>
																@else
																<a class="dropdown-item"
																   href="{{ route('view.certificate',['id'=>encrypt($invoice->certificates->where('type', 'singlePackage')->first()->id)]) }}">View Single Package Certificate</a>
															@endif



															@if($invoice->certificates->where('type', 'flightOnly')->count() == 0)
																@if($invoice->flights->count())
																	<a class="dropdown-item"
																	   href="{{route('generate.certificates',['certName'=>'flightOnlyCertificate','invoiceId'=>$invoice->id])}}">Generate
																		Flight Certificate</a>
																@endif
															@else
																<a class="dropdown-item"
																   href="{{ route('view.certificate',['id'=>encrypt($invoice->certificates->where('type', 'flightOnly')->first()->id)]) }}">View
																	Flight
																	Certificate</a>
															@endif
														</div>
												@endcan

                                            </div>
                                            <button type="button" class="btn bg-teal">Action</button>
                                            <button type="button" class="btn bg-teal dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">


                                                @can('View Invoices')
                                                    <li><a href="{{route('invoice.view',['id'=>$invoice->id])}}"
                                                           style="color:white" class="btn bg-aqua btn-xs"> View</a></li>
                                                @endcan

                                                @can('Edit Invoice')
                                                    <li><a href="{{route('invoice.edit',['id'=>$invoice->id])}}"
                                                           style="color:white;margin-top:2px;"
                                                           class="btn bg-purple btn-xs"> Edit</a></li>
                                                        <li><a href="{{route('invoice.ammendment',['id'=>$invoice->id])}}"
                                                               style="color:white;margin-top:2px;"
                                                               class="btn bg-danger btn-xs"> Ammendment</a></li>
                                                @endcan


                                                @if(!Auth::user()->client)
                                                    @if($invoice->status == 0)
                                                        @can('Cancel Invoice')
                                                            <li class="test"><a
                                                                    onClick="return confirm('Are You Sure You Want To Cancel This Invoice')"
                                                                    href="{{route('invoice.delete',['id'=>$invoice->id])}}"
                                                                    {{($invoice->status == 1)?"disabled":" "}} style="color:white;margin-top:2px;"
                                                                    class="btn bg-red btn-xs">Cancel</a></li>
                                                        @endcan
                                                    @else
                                                        @can('Refund Invoice')
                                                            <li class="test">
                                                                <input type="text" value="{{$invoice->id}}"
                                                                       class="inv_id" hidden>
                                                                <input type="text" value="{{$invoice->invoice_no}}"
                                                                       class="inv_no" hidden>
                                                                <input type="text"
                                                                       value="{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}"
                                                                       class="inv_total" hidden>
                                                                <a type="button" onClick="Fun(this);"
                                                                   data-url="{{url('/refund/invoice')}}"
                                                                   class="btn bg-success btn-xs"
                                                                   style="color:white;margin-top:2px;">Refund</a>
                                                            </li>
                                                        @endcan
                                                    @endif
                                                    @if($invoice->status == 0)
                                                        @can('Pay Invoice')

                                                            <li><a href="{{route('invoice.pay',['id'=>$invoice->id])}}"
                                                                   style="color:white;margin-top:2px;"
                                                                   class="btn bg-success btn-xs">Pay</a></li>

                                                        @endcan

                                                        @can('Refund Invoice')
                                                            <li class="test">
                                                                <input type="text" value="{{$invoice->id}}"
                                                                       class="inv_id" hidden>
                                                                <input type="text" value="{{$invoice->invoice_no}}"
                                                                       class="inv_no" hidden>
                                                                <input type="text"
                                                                       value="{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}"
                                                                       class="inv_total" hidden>
                                                                <a type="button" onClick="Funtwo(this);"
                                                                   data-url="{{url('/refund/invoice')}}"
                                                                   class="btn bg-success btn-xs"
                                                                   style="color:white;margin-top:2px;">Refund</a>
                                                            </li>
                                                        @endcan



                                                        @can('Send Reminder For Unpaid Invoice')
                                                            <li>
                                                                <a href="{{route('invoice.reminder',['id'=>$invoice->id])}}"
                                                                   style="color:white;margin-top:2px;"
                                                                   class="btn bg-maroon btn-xs">Send Reminder</a></li>
                                                        @endcan
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </td>

                                    @if(!Auth::user()->client)
                                        <td>
                                            @if($invoice->confirmation)
                                                <span class="text-success"><b>{{'Confirmed By Client'}}</b><br>Through: <br>{{$invoice->confirmation_via}}</span>
                                                <br>
                                                <a onClick="return confirm('Are You Sure You Want To Send Commercial Invoice')"
                                                   href="{{route('send.commercial.invoice',['id'=>$invoice->id])}}"
                                                   class="btn btn-xs btn-success">Send Commercial Invoice</a>
                                            @else
                                                <span
                                                    class="text-danger"><b>{{'Not Yet Confirmed By Client'}}</b></span>
                                                <br>
                                                @can('Confirm Invoice')
                                                    <a onClick="return confirm('Are You Sure You Want To Confirm Invoice')"
                                                       href="{{route('confirm.via.paperprint',['id'=>$invoice->id])}}"
                                                       class="btn btn-xs btn-success">Confirm Via Paper-Print</a>
                                                @endcan
                                                <br>
                                                @if($invoice->issues != null)
                                                    <a href="{{route('invoice.issue',['id'=>$invoice->id])}}"
                                                       class="btn btn-primary btn-xs">Issue Raised By Client</a>
                                                @endif
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                <!----extra add --->

                            @elseif($invoice->refund == 1)
                                @if(!empty($invoice->refunded_amount))
                                    <tr>
                                        <td style="display: none">{{$invoice->id}}</td>
                                        <td>{{$invoice->invoice_no}}</td>
                                        <td>{{Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y,h:i A') }}</td>
                                        <td>{{$invoice->receiver_name}}</td>
                                        <td></td>
                                        <td>{{$invoice->currency}}{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount)-$invoice->refunded_amount, 2, '.', '')}}</td>
                                        @if($invoice->status == 1)
                                            <td>
                                                <div class="text-success">{{'Paid'}}</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="text-danger">{{'Unpaid'}}</div>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-teal">Action</button>
                                                <button type="button" class="btn bg-teal dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @can('View Invoices')
                                                        <li><a href="{{route('invoice.view',['id'=>$invoice->id])}}"
                                                               style="color:white" class="btn bg-aqua btn-xs"> View</a>
                                                        </li>
                                                    @endcan

                                                    @can('Edit Invoice')
                                                        <li><a href="{{route('invoice.edit',['id'=>$invoice->id])}}"
                                                               style="color:white;margin-top:2px;"
                                                               class="btn bg-purple btn-xs"> Edit</a></li>
                                                    @endcan

                                                    @if(!Auth::user()->client)
                                                        @if($invoice->status == 0)
                                                            @can('Cancel Invoice')
                                                                <li class="test"><a
                                                                        onClick="return confirm('Are You Sure You Want To Cancel This Invoice')"
                                                                        href="{{route('invoice.delete',['id'=>$invoice->id])}}"
                                                                        {{($invoice->status == 1)?"disabled":" "}} style="color:white;margin-top:2px;"
                                                                        class="btn bg-red btn-xs">Cancel</a></li>
                                                            @endcan
                                                        @else
                                                            @can('Refund Invoice')
                                                                <li class="test">
                                                                    <input type="text" value="{{$invoice->id}}"
                                                                           class="inv_id" hidden>
                                                                    <input type="text" value="{{$invoice->invoice_no}}"
                                                                           class="inv_no" hidden>
                                                                    <input type="text"
                                                                           value="{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}"
                                                                           class="inv_total" hidden>
                                                                    <a type="button" onClick="Fun(this);"
                                                                       data-url="{{url('/refund/invoice')}}"
                                                                       class="btn bg-success btn-xs"
                                                                       style="color:white;margin-top:2px;">Refund</a>
                                                                </li>
                                                            @endcan
                                                        @endif
                                                        @if($invoice->status == 0)
                                                            @can('Pay Invoice')

                                                                <li>
                                                                    <a href="{{route('invoice.pay',['id'=>$invoice->id])}}"
                                                                       style="color:white;margin-top:2px;"
                                                                       class="btn bg-success btn-xs">Pay</a></li>

                                                            @endcan

                                                            @can('Refund Invoice')
                                                                <li class="test">
                                                                    <input type="text" value="{{$invoice->id}}"
                                                                           class="inv_id" hidden>
                                                                    <input type="text" value="{{$invoice->invoice_no}}"
                                                                           class="inv_no" hidden>
                                                                    <input type="text"
                                                                           value="{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}"
                                                                           class="inv_total" hidden>
                                                                    <a type="button" onClick="Funtwo(this);"
                                                                       data-url="{{url('/refund/invoice')}}"
                                                                       class="btn bg-success btn-xs"
                                                                       style="color:white;margin-top:2px;">Refund</a>
                                                                </li>
                                                            @endcan



                                                            @can('Send Reminder For Unpaid Invoice')
                                                                <li>
                                                                    <a href="{{route('invoice.reminder',['id'=>$invoice->id])}}"
                                                                       style="color:white;margin-top:2px;"
                                                                       class="btn bg-maroon btn-xs">Send Reminder</a>
                                                                </li>
                                                            @endcan
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>

                                        @if(!Auth::user()->client)
                                            <td>
                                                @if($invoice->confirmation)
                                                    <span class="text-success"><b>{{'Confirmed By Client'}}</b><br>Through: <br>{{$invoice->confirmation_via}}</span>
                                                    <br>
                                                    <a onClick="return confirm('Are You Sure You Want To Send Commercial Invoice')"
                                                       href="{{route('send.commercial.invoice',['id'=>$invoice->id])}}"
                                                       class="btn btn-xs btn-success">Send Commercial Invoice</a>
                                                @else
                                                    <span
                                                        class="text-danger"><b>{{'Not Yet Confirmed By Client'}}</b></span>
                                                    <br>
                                                    @can('Confirm Invoice')
                                                        <a onClick="return confirm('Are You Sure You Want To Confirm Invoice')"
                                                           href="{{route('confirm.via.paperprint',['id'=>$invoice->id])}}"
                                                           class="btn btn-xs btn-success">Confirm Via Paper-Print</a>
                                                    @endcan
                                                    <br>
                                                    @if($invoice->issues != null)
                                                        <a href="{{route('invoice.issue',['id'=>$invoice->id])}}"
                                                           class="btn btn-primary btn-xs">Issue Raised By Client</a>
                                                    @endif
                                                @endif
                                            </td>
                                        @endif
                                    </tr>

                                @endif


                                <!----- end extra ---->
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <div class="text-center">
        <a href="{{route('invoice.create')}}">
            @can('Generate Invoice')
                <button class="btn btn-success">Create Invoice</button>
            @endcan
        </a>
        @can('Refund Invoice')
            <button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info" id="refund"
                    style="display:none;">Refund Invoice
            </button>
        @endcan
    </div>
    <div id="append"></div>

@endsection
@section('js')
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
{{--    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#myTable').DataTable({--}}
{{--                dom: 'Bfrtip',--}}
{{--                "order": [[1, "desc"]],--}}
{{--                buttons: [--}}
{{--                    'copyHtml5',--}}
{{--                    'excelHtml5',--}}
{{--                    'csvHtml5',--}}
{{--                    'pdfHtml5'--}}
{{--                ]--}}
{{--            });--}}

{{--            $('#service_name').on('change', function() {--}}
{{--                $("#datesubmit").submit();--}}
{{--            });--}}

{{--            $('#dropdown2').on('change', function() {--}}
{{--                $("#datesubmit").submit();--}}
{{--            });--}}

{{--            $('#dropdown3').on('change', function() {--}}
{{--                if($("#enddate").val() != ""){--}}
{{--                    $("#datesubmit").submit();--}}
{{--                }--}}
{{--            });--}}

{{--            $("#startdate").datepicker({--}}
{{--                onSelect: function () {--}}
{{--                    if($("#enddate").val() != ""){--}}
{{--                        $("#datesubmit").submit();--}}
{{--                    }else{--}}
{{--                    }--}}
{{--                },--}}
{{--                changeMonth: true,--}}
{{--                changeYear: true,--}}
{{--                dateFormat: 'yy-mm-dd'--}}
{{--            });--}}

{{--            $("#enddate").datepicker({--}}
{{--                onSelect: function () {--}}
{{--                    var dateMin = $(this).val();--}}
{{--                    if($("#startdate").val() == ""){--}}
{{--                        confirm("Please select start date!");--}}
{{--                    }else{--}}
{{--                        $("#datesubmit").submit();--}}
{{--                    }--}}
{{--                },--}}
{{--                changeMonth: true,--}}
{{--                changeYear: true,--}}
{{--                dateFormat: 'yy-mm-dd'--}}
{{--            });--}}


{{--            $("#enddate").blur(function(){--}}
{{--                var dateMin = $("#enddate").val();--}}
{{--                if($("#startdate").val() == ""){--}}
{{--                    confirm("Please select start date!");--}}
{{--                }else{--}}
{{--                    $("#datesubmit").submit();--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        $(document).ready(function () {
            $("#pdf").click(function () {
                var doc = new jsPDF()
                var source = document.getElementById('myTable');
                doc.fromHTML(source);
                doc.output("dataurlnewwindow");
            });
        });

        function Fun(temp) {

            var foo = confirm('Are You Sure You Want To Refund This Invoice');
            if (foo) {
                var inv_id = $(temp).parents('.test').find('.inv_id').val();
                var inv_no = $(temp).parents('.test').find('.inv_no').val();
                var inv_total = $(temp).parents('.test').find('.inv_total').val();
                var url = $(temp).attr('data-url')
                // $(temp).parents('.fare-parent').find('.fare').val(fare_sell.toFixed(2));
                // console.log(inv_id);
                var data = '<div class="modal fade" id="modal-info">' +
                    '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">' +
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button>' +
                    '<h4 class="modal-title">Refund Invoice</h4>' +
                    '</div>' +
                    '<form action="' + url + "/" + inv_id + '" method="post" onsubmit ="return check()">' +
                    '@csrf' +
                    '<div class="modal-body">' +
                    '<label for="invoice_no">Invoice No:</label>' +
                    '<input type="text" name="invoice_no" class="form-control" id="invoice_no" value="' + inv_no + '" readonly />' +

                    '<label for="total">Total:</label>' +
                    '<input type="text" name="total" class="form-control" id="total" value="' + inv_total + '" readonly/>' +


                    '<label for="refunded_amount">SAFI:</label>' +
                    '<input type="text" name="SAFI" id="SAFI" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">ATOL:</label>' +
                    '<input type="text" name="ATOL" id="ATOL" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">Credit Charge 1% :</label>' +
                    '<input type="text" name="CreditCharge" id="CreditCharge" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">Service Charges:</label>' +
                    '<input type="text" name="ServiceCharges" id="ServiceCharges" class="form-control mask-money" max="' + inv_total + '"  value="0.00"/>' +
                    '<label for="refunded_amount">Penality Charges:</label>' +
                    '<input type="text" name="PenalityCharges" id="PenalityCharges" class="form-control mask-money" max="' + inv_total + '" value="0.00" />' +
                    '<label for="refunded_amount">Admin Charges:</label>' +
                    '<input type="text" name="AdminCharges" id="AdminCharges" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">Other Miscellaneous Charges:</label>' +
                    '<input type="text" name="MiscellaneousCharges" id="MiscellaneousCharges" class="form-control mask-money" max="' + inv_total + '" value="0.00"s />' +
                    '<br><center><a  class="btn bg-teal" href="#" onClick="calculate()">Caluclate Final Refund Amount:</a></center><br>' +
                    '<label for="refunded_amount">Enter Amount To Refund:</label>' +
                    '<input type="text" name="refunded_amount" id="ref" class="form-control mask-money" max="' + inv_total + '" readonly required />' +

                    '<label for="refund_remarks">Remarks:</label>' +
                    '<textarea name="refund_remarks" id="" class="form-control" cols="30" rows="10"></textarea>' +
                    '</div>' +
                    '<div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">' +
                    '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>' +
                    '<button type="submit" class="btn btn-outline">Refund</button>' +
                    '</div>' +
                    '</form>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#append').html(data);
                $('.mask-money').maskMoney();
                $('#refund').click();
            }
        }

        function Funtwo(temp) {

            var foo = confirm('Are You Sure You Want To Refund This Invoice');
            if (foo) {
                var inv_id = $(temp).parents('.test').find('.inv_id').val();
                var inv_no = $(temp).parents('.test').find('.inv_no').val();
                var inv_total = $(temp).parents('.test').find('.inv_total').val();
                var url = $(temp).attr('data-url')
                // $(temp).parents('.fare-parent').find('.fare').val(fare_sell.toFixed(2));
                // console.log(inv_id);
                var data = '<div class="modal fade" id="modal-info">' +
                    '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">' +
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button>' +
                    '<h4 class="modal-title">Refund Invoice</h4>' +
                    '</div>' +
                    '<form action="' + url + "/" + inv_id + '" method="post" onsubmit ="return check()">' +
                    '@csrf' +
                    '<div class="modal-body">' +
                    '<label for="invoice_no">Invoice No:</label>' +
                    '<input type="text" name="invoice_no" class="form-control" id="invoice_no" value="' + inv_no + '" readonly />' +

                    '<label for="total">Total:</label>' +
                    '<input type="text" name="total" class="form-control" id="total" value="' + inv_total + '" readonly/>' +


                    '<label for="refunded_amount">SAFI:</label>' +
                    '<input type="text" name="SAFI" id="SAFI" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">ATOL:</label>' +
                    '<input type="text" name="ATOL" id="ATOL" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">Credit Charge 1% :</label>' +
                    '<input type="text" name="CreditCharge" id="CreditCharge" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">Service Charges:</label>' +
                    '<input type="text" name="ServiceCharges" id="ServiceCharges" class="form-control mask-money" max="' + inv_total + '"  value="0.00"/>' +
                    '<label for="refunded_amount">Penality Charges:</label>' +
                    '<input type="text" name="PenalityCharges" id="PenalityCharges" class="form-control mask-money" max="' + inv_total + '" value="0.00" />' +
                    '<label for="refunded_amount">Admin Charges:</label>' +
                    '<input type="text" name="AdminCharges" id="AdminCharges" class="form-control mask-money" max="' + inv_total + '" value="0.00"/>' +
                    '<label for="refunded_amount">Other Miscellaneous Charges:</label>' +
                    '<input type="text" name="MiscellaneousCharges" id="MiscellaneousCharges" class="form-control mask-money" max="' + inv_total + '" value="0.00"s />' +
                    '<br><center><a  class="btn bg-teal" href="#" onClick="calculatetwo()">Caluclate Final Refund Amount:</a></center><br>' +
                    '<label for="refunded_amount">Enter Amount To Refund:</label>' +
                    '<input type="text" name="refunded_amount" id="ref" class="form-control mask-money" max="' + inv_total + '" readonly required />' +

                    '<label for="refund_remarks">Remarks:</label>' +
                    '<textarea name="refund_remarks" id="" class="form-control" cols="30" rows="10"></textarea>' +
                    '</div>' +
                    '<div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">' +
                    '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>' +
                    '<button type="submit" class="btn btn-outline">Refund</button>' +
                    '</div>' +
                    '</form>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#append').html(data);
                $('.mask-money').maskMoney();
                $('#refund').click();
            }
        }

        function calculatetwo() {
            var SAFI = parseFloat(document.getElementById("SAFI").value);
            var ATOL = parseFloat(document.getElementById("ATOL").value);
            var CreditCharge = parseFloat(document.getElementById("CreditCharge").value);
            var ServiceCharges = parseFloat(document.getElementById("ServiceCharges").value);
            var PenalityCharges = parseFloat(document.getElementById("PenalityCharges").value);
            var AdminCharges = parseFloat(document.getElementById("AdminCharges").value);
            var MiscellaneousCharges = parseFloat(document.getElementById("MiscellaneousCharges").value);
            var total = SAFI + ATOL + CreditCharge + ServiceCharges + PenalityCharges + AdminCharges + MiscellaneousCharges;
            var totalpaid = parseFloat(document.getElementById("total").value);
            var finlt = totalpaid - total;
            ;
            document.getElementById("ref").value = finlt.toFixed(2);
            ;
        }


        function calculate() {
            var SAFI = parseFloat(document.getElementById("SAFI").value);
            var ATOL = parseFloat(document.getElementById("ATOL").value);
            var CreditCharge = parseFloat(document.getElementById("CreditCharge").value);
            var ServiceCharges = parseFloat(document.getElementById("ServiceCharges").value);
            var PenalityCharges = parseFloat(document.getElementById("PenalityCharges").value);
            var AdminCharges = parseFloat(document.getElementById("AdminCharges").value);
            var MiscellaneousCharges = parseFloat(document.getElementById("MiscellaneousCharges").value);
            var total = SAFI + ATOL + CreditCharge + ServiceCharges + PenalityCharges + AdminCharges + MiscellaneousCharges;
            var totalpaid = parseFloat(document.getElementById("total").value);
            var finlt = totalpaid - total;
            ;
            document.getElementById("ref").value = finlt.toFixed(2);
            ;
        }

        function check() {
            var valid = true
            var total = parseFloat($('#total').val())
            var refund = parseFloat($('#ref').val().replace(',', ""))

            if (refund <= total) {
                valid = true
            } else {
                alert('Now Refund in Minus ')
                valid = true
            }
            return valid

        }
    </script>
    <script>
        $(document).ready(function() {
            // Add Font Awesome if not already present
            if (!$('link[href*="font-awesome"]').length) {
                $('<link>')
                    .appendTo('head')
                    .attr({
                        type: 'text/css', 
                        rel: 'stylesheet',
                        href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'
                    });
            }

            // Handle export button clicks
            $('.export-btn').click(function() {
                const type = $(this).data('type');
                const $btn = $(this);
                const originalText = $btn.html();
                
                // Get all current filter values
                const filterData = {
                    search: $('input[name="search"]').val(),
                    airline_name: $('select[name="airline_name"]').val(),
                    service_name: $('select[name="service_name"]').val(),
                    date_type: $('select[name="date_type"]').val(),
                    start_date: $('input[name="start_date"]').val(),
                    end_date: $('input[name="end_date"]').val(),
                    type: type,
                    _token: '{{ csrf_token() }}'
                };

                // Show loading state
                $btn.html('<i class="fas fa-spinner fa-spin"></i> Exporting...').prop('disabled', true);

                // Create a form and submit it
                const $form = $('<form>')
                    .attr('method', 'POST')
                    .attr('action', '{{ route("invoices.export") }}');

                // Add all filter data as hidden inputs
                $.each(filterData, function(key, value) {
                    $form.append($('<input>')
                        .attr('type', 'hidden')
                        .attr('name', key)
                        .attr('value', value));
                });

                // Append form to body and submit it
                $form.appendTo('body').submit();

                // Reset button state after a delay
                setTimeout(function() {
                    $btn.html(originalText).prop('disabled', false);
                }, 3000);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements with class 'select2'
            $('.select2').select2({
                width: '100%',
                placeholder: function() {
                    return $(this).data('placeholder') || $(this).find('option:first').text();
                },
                allowClear: true
            });

            // Optional: If you want to trigger form submission on select change
            $('.select2').on('change', function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@stop

