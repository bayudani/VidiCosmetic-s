<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px; }
        thead tr { background-color: #f2f2f2; }
        tfoot tr { background-color: #f2f2f2; font-weight: bold; }
        .total-label { text-align: right; }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total Harga</th>
                <th>Status Pesanan</th>
                <th>Status Pembayaran</th>
                <th>Tanggal</th>
                <th>Rincian Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->order_number }}</td>
                    <td>{{ $record->user->name ?? '' }}</td>
                    <td>Rp {{ number_format($record->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $record->order_status }}</td>
                    <td>{{ $record->payment_status }}</td>
                    <td>{{ $record->created_at->format('d M Y') }}</td>
                    <td>
                        {{ $record->items->map(function($item) {
                            return "{$item->product->name} (x{$item->quantity})";
                        })->implode('; ') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="total-label">GRAND TOTAL</td>
                <td>Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
