<div id="print-content">
    <div style="font-family: 'Courier New', monospace; font-size: 12px; width: 58mm; margin: auto;">
        <div style="text-align: center;">
            <strong>{{ config('app.name', 'POSphere') }}</strong><br>
            Jl. Contoh Alamat No. 123<br>
            Telp: 0812-3456-7890
        </div>
        <hr>
        <table style="width:100%;">
            <tr>
                <td>No Faktur</td>
                <td style="text-align:right;">{{ $penjualan->kode }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td style="text-align:right;">
                    {{ date('d/m/Y H:i', strtotime($penjualan->tanggal)) }}
                </td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td style="text-align:right;">{{ $penjualan->member->nama ?? 'Umum' }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td style="text-align:right;">{{ $penjualan->user->name ?? '-' }}</td>
            </tr>
        </table>

        <hr>

        @foreach ($penjualan->detail_penjualan as $detail)
            <div>
                {{ $detail->barang->nama ?? '-' }}<br>
                {{ $detail->jumlah }} x Rp{{ number_format($detail->harga_jual, 0, ',', '.') }}
                <span style="float:right;">
                    Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                </span>
            </div>
        @endforeach

        <div style="clear:both;"></div>
        <hr>
        <div>
            <strong>TOTAL:</strong>
            <span style="float:right;">
                <strong>Rp{{ number_format($penjualan->total, 0, ',', '.') }}</strong>
            </span>
        </div>
        <div style="clear:both;"></div>
        <hr>
        <div style="text-align: center;">
            <p>Terima kasih atas kunjungan Anda</p>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        print();
    };
</script>
