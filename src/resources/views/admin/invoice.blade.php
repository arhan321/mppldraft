<!DOCTYPE html>
<html>
<head>
    <title>Receipt #{{ $order->id }}</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #10b981;
            --border-color: #e2e8f0;
            --light-bg: #f8fafc;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            line-height: 1.5;
            color: #1e293b;
            background-color: #f9fafb;
            padding: 0;
            margin: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 40px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .header h2 {
            color: var(--primary-color);
            font-size: 32px;
            margin: 0 0 8px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .receipt-number {
            font-size: 16px;
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        .company-info {
            margin: 24px 0;
            text-align: center;
            color: var(--secondary-color);
            font-size: 15px;
            line-height: 1.6;
        }
        
        .company-name {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 18px;
            margin-bottom: 4px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }
        
        .table th {
            background-color: var(--primary-color);
            color: white;
            text-align: left;
            padding: 14px 16px;
            font-weight: 600;
            font-size: 15px;
        }
        
        .table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 15px;
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .total-section {
            margin-top: 32px;
            padding: 24px;
            background-color: var(--light-bg);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 16px;
        }
        
        .total-label {
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .total-amount {
            font-weight: 700;
            font-size: 20px;
            color: var(--primary-color);
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--secondary-color);
            font-size: 14px;
            line-height: 1.6;
        }
        
        .customer-info {
            background-color: var(--light-bg);
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .info-item {
            margin-bottom: 12px;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--secondary-color);
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        .info-value {
            font-size: 15px;
        }
        
        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 60px;
        }
        
        .signature-box {
            text-align: center;
        }
        
        .signature-line {
            height: 1px;
            background: var(--border-color);
            margin: 60px 0 10px;
            position: relative;
        }
        
        .signature-label {
            font-weight: 600;
            margin-top: 8px;
            color: var(--secondary-color);
            font-size: 15px;
        }
        
        .thank-you {
            font-size: 20px;
            color: var(--primary-color);
            font-weight: 700;
            margin: 40px 0;
            text-align: center;
            padding: 16px;
            background-color: #eff6ff;
            border-radius: 8px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            background-color: var(--accent-color);
            color: white;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>RECEIPT PEMBAYARAN</h2>
            <div class="receipt-number">No: RCPT/{{ $order->id }}/{{ date('Y') }}</div>
        </div>
        
        <div class="company-info">
            <div class="company-name">PT Capunk Mobilindo Sejahtera</div>
            <div>Kebayoran Lama RT012/RW001, Jakarta Selatan, Indonesia</div>
            <div>Phone: (021) 1111 - 2222 | Email: capunkmobilindo@gmail.com</div>
        </div>
        
        <div class="info-grid">
            <div class="customer-info">
                <div class="info-label">Kepada:</div>
                <div class="info-value">{{ $order->user->name ?? 'N/A' }}</div>
                <div class="info-value">{{ $order->user->email ?? 'N/A' }}</div>
            </div>
            
            <div>
                <div class="info-item">
                    <span class="info-label">Tanggal Receipt</span>
                    <div class="info-value">{{ $date ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Status Pembayaran</span>
                    <div class="status-badge">LUNAS</div>
                </div>
            </div>
        </div>
        
        <h3 style="font-size: 18px; color: var(--primary-color); margin-bottom: 16px;">Detail Pesanan</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Harga</th>
                    <th>Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $order->vehicle->nama ?? 'N/A' }}</strong><br>
                        <small style="color: var(--secondary-color);">{{ $order->vehicle->merk ?? '' }}</small>
                    </td>
                    <td>Rp {{ isset($order->total_harga) ? number_format($order->total_harga, 0, ',', '.') : 'N/A' }}</td>
                    <td>{{ $order->tanggal_order ? $order->tanggal_order->format('d/m/Y') : 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Subtotal:</span>
                <span>Rp {{ isset($order->total_harga) ? number_format($order->total_harga, 0, ',', '.') : 'N/A' }}</span>
            </div>
            <div class="total-row">
                <span class="total-label">Pajak (0%):</span>
                <span>Rp 0</span>
            </div>
            <div class="total-row total-amount">
                <span>Total Pembayaran:</span>
                <span>Rp {{ isset($order->total_harga) ? number_format($order->total_harga, 0, ',', '.') : 'N/A' }}</span>
            </div>
        </div>

        <div class="thank-you">
            PEMBAYARAN BERHASIL
        </div>
        
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Tanda Tangan Pelanggan</div>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Tanda Tangan Admin</div>
                <div style="margin-top: 10px; font-size: 14px; color: var(--secondary-color);">PT Capunk Mobilindo Sejahtera</div>
            </div>
        </div>
        
        <div class="footer">
            <p>Receipt ini merupakan bukti pembayaran yang sah</p>
            <p>Untuk pertanyaan hubungi: (021) 1111 - 2222 | Email: capunkmobilindo@gmail.com</p>
        </div>
    </div>
</body>
</html>