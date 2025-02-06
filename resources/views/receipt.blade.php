<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Appointment Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f4f8, #e3e8ed);
            padding: 20px;
        }

        .invoice-container {
            width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .watermark {
            position: absolute;
            opacity: 0.05;
            font-size: 120px;
            transform: rotate(-30deg);
            top: 30%;
            left: 10%;
            font-weight: 900;
            color: #2d3748;
            pointer-events: none;
            z-index: 0;
        }

        .header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
            z-index: 1;
        }

        .hospital-info h1 {
            color: #1a365d;
            font-size: 28px;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .hospital-info p {
            color: #718096;
            line-height: 1.6;
            font-size: 14px;
        }

        .patient-info {
            text-align: right;
        }

        .badge {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(72, 187, 120, 0.2);
        }

        .invoice-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .detail-card {
            background: #f8fafc;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #4299e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
        }

        .detail-card h3 {
            color: #1a365d;
            margin-bottom: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-card h3:before {
            content: '';
            width: 6px;
            height: 6px;
            background: #4299e1;
            border-radius: 50%;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .item-label {
            color: #718096;
            flex: 1;
        }

        .item-value {
            color: #1a365d;
            font-weight: 500;
            flex: 1;
            text-align: right;
        }

        .total-section {
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-top: 30px;
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.2);
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 8px 0;
        }

        .total-line:last-child {
            margin-bottom: 0;
        }

        .payment-info {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #718096;
            font-size: 12px;
            padding-top: 20px;
        }

        .payment-methods {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .payment-method {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f7fafc;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .print-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
            padding: 14px 28px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.25);
            transition: transform 0.2s ease;
        }

        .print-button:hover {
            transform: translateY(-2px);
        }

        @media print {
            .print-button {
                display: none;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .invoice-container {
                width: 100%;
                min-height: auto;
                box-shadow: none;
                border-radius: 0;
                padding: 20px;
            }

            .watermark {
                opacity: 0.1;
            }

            @page {
                size: A4;
                margin: 0;
            }
        }

    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="watermark">PAID</div>

        <div class="header">
            <div class="hospital-info">
                <h1>{{ $payment->booking->hospital->name }} Hospital</h1>

                <p>Hospital Receipt | Medical Services Invoice</p>
            </div>

            <div class="patient-info">
                <div class="badge">{{ ucfirst($booking->status) }}</div>

                <h2>Receipt #{{ $payment->id }}</h2>
                <p>Date: {{ date('M d, Y', strtotime($payment->created_at)) }}</p>
            </div>
        </div>

        <div class="invoice-details">
            <div class="detail-card">
                <h3>Patient Information</h3>
                <div class="detail-item">
                    <span class="item-label">Name:</span>
                    <span class="item-value">{{ $payment->booking->user->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">Patient ID:</span>
                    <span class="item-value">P{{ $payment->booking->user->id }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">Email:</span>
                    <span class="item-value">{{ $payment->booking->user->email }}</span>
                </div>
            </div>

            <div class="detail-card">
                <h3>Service Details</h3>
                <div class="detail-item">
                    <span class="item-label">Service:</span>
                    <span class="item-value">{{ $payment->booking->service->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">Appointment Date:</span>
                    <span class="item-value">{{ date('M d, Y', strtotime($payment->booking->booking_date)) }}</span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <h3>Payment Breakdown</h3>
            <div class="detail-item">
                <span class="item-label">Original Amount</span>
                <span class="item-value">{{ number_format($payment->total_amount, 2) }} FRW</span>
            </div>
            <div class="detail-item">
                <span class="item-label">Insurance Coverage</span>
                <span class="item-value">-{{ number_format($payment->discount_amount, 2) }} FRW</span>
            </div>
            <div class="detail-item">
                <span class="item-label">Service Fee</span>
                <span class="item-value">{{ number_format($payment->service_fee, 2) }} FRW</span>
            </div>
        </div>

        <div class="total-section">
            <div class="total-line">
                <span>Total Amount:</span>
                <span>{{ number_format($payment->final_amount, 2) }} FRW</span>
            </div>
            <div class="total-line">
                <span>Amount Paid:</span>
                <span>{{ number_format($payment->final_amount, 2) }} FRW</span>
            </div>
            <div class="total-line" style="font-size: 18px; font-weight: 600;">
                <span>Balance Due:</span>
                <span>0.00 FRW</span>
            </div>
        </div>

        <div class="payment-info">
            <h3>Payment Method</h3>
            <div class="payment-methods">
                <div class="payment-method">
                    <i class="fas fa-credit-card"></i>
                    Credit Card (**** 4242)
                </div>
                <div class="payment-method">
                    <i class="fas fa-check-circle"></i>
                    Completed at {{ date('h:i A', strtotime($payment->created_at)) }}
                </div>
            </div>
        </div>

        <div class="footer">
            <p>{{ $payment->booking->hospital->name }} | Medical Services Provider</p>
            <p>Contact: +250 788 123 456 | Email: info@hospital.rw</p>

        </div>
    </div>

    <button onclick="window.print()" class="print-button">🖨️ Print Receipt</button>
</body>
</html>
