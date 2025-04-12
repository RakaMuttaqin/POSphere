<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets') }}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets') }}/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <!-- END: Vendor CSS -->

    <!-- BEGIN: Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS -->

    <!-- BEGIN: Page CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/css/plugins/forms/pickers/form-flat-pickr.css">
    <!-- END: Page CSS -->

    <!-- BEGIN: Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Kode Pengajuan</th>
                <th>Nama Pengaju</th>
                <th>Nama Barang</th>
                <th>Tanggal Pengajuan</th>
                <th>Qty</th>
                <th>Terpenuhi?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pengajuan)
                <tr>
                    <td>{{ $pengajuan->kode_pengajuan }}</td>
                    <td>{{ $pengajuan->member->nama }}</td>
                    <td>{{ $pengajuan->nama_barang }}</td>
                    <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                    <td>{{ $pengajuan->qty }}</td>
                    <td>
                        <div class="form-check form-check-success form-switch">
                            <input type="checkbox" {{ $pengajuan->status == '1' ? 'checked' : '' }}
                                class="form-check-input update-status" id="customSwitch4"
                                data-id="{{ $pengajuan->kode_pengajuan }}" />
                            <label class="form-check-label" for="customSwitch4">
                                {{ $pengajuan->status == '1' ? 'Terpenuhi' : 'Belum Terpenuhi' }}
                            </label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
