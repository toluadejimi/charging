@extends('layout.main')

@section('title', 'Transaction Successful')

@section('content')
    <div class="receipt-container">
        <div class="receipt text-center">
            <h4 class="fw-bold">✅ SUCCESS</h4>
            <hr>
            <p><strong>BOX:</strong>{{$box}}</p>
            <p><strong>Check In TIme:</strong>{{$time_in}}</p>
            <p><strong>Check Out TIme:</strong>{{$time_out}}</p>
            <p><strong>C-Code:</strong>{{$code}}</p>
            <p><strong>Amount:</strong>₦{{ number_format($amount ?? 0, 2) }}</p>
            <hr>
            <p class="fw-bold">Terms and Condition</p>


            <ul>
                <li>  No Extension plug is allowed  </li>
                <li>  ₦ 5,000 penalty for lost or missing key  </li>
                <li>  ₦ 2,000 penalty for late check out  </li>
            </ul>

            <p class="fw-bold">Thank you for your business!</p>
        </div>
    </div>

    <div class="text-center mt-3">
        <button onclick="printReceipt()" class="btn btn-primary">🖨 Print Receipt</button>
    </div>

    <style>
        body { background: #f8f9fa; }
        .receipt-container {
            max-width: 100mm;
            margin: auto;
            padding: 10px;
            background: white;
            border: 1px dashed #000;
        }
        .receipt {
            font-size: 12px;
            font-family: 'Courier New', monospace;
        }
        @media print {
            body * { visibility: hidden; }
            .receipt-container, .receipt-container * { visibility: visible; }
            .receipt-container { position: absolute; left: 0; top: 0; }
            .btn { display: none; } /* Hide buttons when printing */
        }
    </style>

    <script>
        function printReceipt() {
            window.print();
        }
    </script>
@endsection
