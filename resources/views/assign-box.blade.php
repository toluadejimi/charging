@php use App\Models\Box;use App\Models\Transaction; @endphp
@extends('layout.main')

@section('title', 'Assign Box')

@section('content')

    @if($box->status == "available")

        <div class="text-center my-3">
            <h4 class="my-3">Assign Box</h4>

            <div class="p-3 bg-success text-white rounded col-xl-12 col-sm-12 my-4">
                <h5>{{$box->title}}</h5>
                <small>{{$box->status}}</small>

            </div>


            <div class="card mx-auto" style="max-width: 400px;">
                <div class="card-body">
                    <form method="POST" action="assign-box-now">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="name" required>
                            <input type="text" class="form-control" value="{{$box->id}}" name="box_id" hidden>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Items</label>
                            <input type="text" class="form-control" name="items" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>

        </div>

    @elseif($box->status == "occupied")

        <div class="p-3 bg-danger text-white rounded col-xl-12 col-sm-12 my-4">
            <h5>{{$box->title}}</h5>
            <small>{{$box->status}}</small>

        </div>
        @php
            $boxx = Transaction::where('box_id',$box->id)->first();
        @endphp

        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form method="POST" action="assign-box-now">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" value="{{$boxx->name}}" name="box_id" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="{{$boxx->phone}}" name="phone" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" value="{{$boxx->address}}" name="address" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Items</label>
                        <input type="text" class="form-control" value="{{$boxx->items}}" readonly name="items">
                    </div>
                </form>
            </div>

            <hr>

            <div class="card-body">


                <div class="row">
                    <div class="col">
                        <label>Today's Date </label>
                        <h6>{{\Carbon\Carbon::parse()->format('d-m-y')}}</h6>

                    </div>

                    <div class="col">
                        <label>Check In Date </label>
                        <h6>{{\Carbon\Carbon::parse($boxx->time_in)->format('d-m-y')}}</h6>

                    </div>

                </div>



                <div class="text-center">

                </div>

                <hr>


                <div class="row">
                    <div class="col">
                        <label> Check In Time </label>
                        <h6>{{\Carbon\Carbon::parse($boxx->time_in)->format('h:i A')}}</h6>

                    </div>

                    <div class="col">
                        <label> Check Out Time </label>
                        <h6>{{\Carbon\Carbon::parse($boxx->time_out)->format('h:i A')}}</h6>

                    </div>

                </div>

            </div>

            <hr>
            <div>
                <button type="button" class="btn btn-danger w-100"  data-bs-toggle="modal" data-bs-target="#submitModal" >Check Out</button>

            </div>


            <div class="modal fade" id="submitModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="submitModalLabel">Check Out</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="myForm" method="POST" action="check-out">
                                @csrf
                                <input class="form-control" name="box_id" value="{{$box->id}}" hidden>
                                <label class="my-2">Enter Code</label>
                                <input class="form-control mb-3" name="code"  type="number">

                                <label class="my-2" >Collected By</label>
                                <input class="form-control" placeholder="Enter name" name="collect_by" type="text">


                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" onclick="document.getElementById('myForm').submit();">Check Out</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    @else

        <div class="p-3 bg-warning text-white rounded col-xl-12 col-sm-12 my-4">
            <h5>{{$box->title}}</h5>
            <small>{{$box->status}}</small>

        </div>

    @endif

@endsection
