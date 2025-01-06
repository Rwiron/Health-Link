@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4">Invoice for {{ $appointment->patient->name ?? 'N/A' }}</h4>
        </div>

        <!-- Invoice Details -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Hospital Information</h6>
                            <p><strong>Name:</strong> {{ $hospital->name ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $hospital->address ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <h6>Doctor Information</h6>
                            <p><strong>Name:</strong> {{ $doctor->name ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $doctor->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Appointment Details</h6>
                            <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
                            <p><strong>Status:</strong>
                                @if ($appointment->status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                                @elseif ($appointment->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @else
                                <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <h6>Invoice</h6>
                            <p><strong>Invoice Number:</strong> {{ $invoice->id ?? 'N/A' }}</p>
                            <p><strong>Total Amount:</strong> ${{ $invoice->total_amount ?? '0.00' }}</p>
                        </div>
                    </div>

                    <!-- Print Button -->
                    <div class="d-flex justify-content-end">
                        <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
