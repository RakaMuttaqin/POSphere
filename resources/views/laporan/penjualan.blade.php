@extends('layouts.app')
@push('title')
    - Laporan Penjualan
@endpush
@push('styles')
    <link rel="apple-touch-icon" href="{{ asset('app-assets') }}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets') }}/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/pickers/form-flat-pickr.css">
    <!-- END: Page CSS -->

    <!-- BEGIN: Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <!-- END: Custom CSS -->
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Laporan</a>
                        </li>
                        <li class="breadcrumb-item active">Laporan Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <section id="filter">
        <div class="row">
            <div class="col-12">
                {{-- <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter Tanggal</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="tanggal_awal">Tanggal Awal</label>
                                        <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control"
                                            value="{{ request('tanggal_awal') ?? '' }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                            value="{{ request('tanggal_akhir') ?? '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Basic table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Penanggung Jawab</th>
                                <th>Nama Member</th>
                                <th>Total</th>
                                <th>Tanggal Penjualan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->member->nama ?? 'Umum' }}</td>
                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-detail btn-primary" data-id="{{ $item->kode }}"
                                            data-bs-toggle="modal" data-bs-target="#modalDetailPenjualan">
                                            <i data-feather="eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic table -->
    @include('laporan.modal')
@endsection

@push('scripts')
    <!-- BEGIN: Vendor JS -->
    <script src="{{ asset('app-assets') }}/vendors/js/vendors.min.js"></script>
    <!-- END: Vendor JS -->

    <!-- BEGIN: Page Vendor JS -->
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS -->

    <!-- BEGIN: Theme JS -->
    <script src="{{ asset('app-assets') }}/js/core/app-menu.js"></script>
    <script src="{{ asset('app-assets') }}/js/core/app.js"></script>
    <!-- END: Theme JS -->

    <!-- BEGIN: Page JS -->
    <script src="{{ asset('app-assets') }}/js/scripts/forms/form-validation.js"></script>
    <!-- END: Page JS -->

    <!-- BEGIN: Page JS-->

    {{-- <script src="{{ asset('app-assets') }}/js/scripts/tables/table-datatables-basic.js"></script> --}}

    <script>
        $(document).ready(function() {
            $(".btn-detail").off("click").on("click", function() {
                let id = $(this).data("id");
                console.log(id);

                $.ajax({
                    url: `/penjualan/detail/${id}`,
                    method: "GET",
                    success: function(response) {
                        $("#modal-no-faktur").text(response.kode ?? "-");
                        $("#modal-kasir").text(response.user.name ?? "-");
                        $("#modal-pelanggan").text(response.member.nama ?? "Umum");
                        $("#modal-total-penjualan").text(new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(response.total) ??
                            "-");
                        $("#modal-tanggal").text(response.tanggal ?? "-");

                        $("#modal-dibayar").text(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(response.pembayaran[0]?.total_bayar ?? 0));

                        $("#modal-kembali").text(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(response.pembayaran[0]?.kembalian ?? 0));

                        let tbody = $("#modal-detail-table-penjualan tbody");
                        tbody.empty();

                        if (response.detail_penjualan && response.detail_penjualan.length > 0) {
                            response.detail_penjualan.forEach(detail => {
                                let hargaJual = detail.harga_jual ?
                                    `${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(detail.harga_jual)}` :
                                    "Rp -";

                                let row = `
                            <tr>
                                <td>${detail.barang.nama ?? "-"}</td>
                                <td>${detail.jumlah ?? "-"}</td>
                                <td>${hargaJual}</td>
                                <td>
                                    ${new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }).format(detail.subtotal) ?? "-"}
                                </td>
                            </tr>`;
                                tbody.append(row);
                            });
                        } else {
                            tbody.append(
                                `<tr><td colspan="6" class="text-center">Tidak ada detail pembelian</td></tr>`
                            );
                        }

                        $("#modalDetailPenjualan").modal("show");
                    },
                    error: function(xhr) {
                        let message = "Gagal mengambil detail. Silakan coba lagi.";
                        if (xhr.status === 404) {
                            message = "Data tidak ditemukan.";
                        }
                        Swal.fire('Error', message, 'error');
                    }
                });
            });
        });

        $(document).ready(function() {
            'use strict';

            var dt_basic_table = $('.datatables-basic');

            if (dt_basic_table.length) {
                dt_basic_table.DataTable({
                    paging: true, // Aktifkan paginasi
                    pageLength: 5, // Default jumlah data per halaman
                    lengthMenu: [5, 10, 25, 50, 75, 100], // Pilihan jumlah data per halaman
                    ordering: true, // Aktifkan fitur sorting di header
                    order: [
                        [0, 'asc']
                    ], // Urutan default berdasarkan kolom ke-2 (Nama)
                    dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>>' +
                        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                        't' +
                        '<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [{
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-2',
                        text: feather.icons['share'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Export',
                        buttons: [{
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                } // Menyesuaikan kolom yang diekspor
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5]
                                }
                            }
                        ]
                    }],
                    responsive: true,
                    language: {
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });

                $('div.head-label').html('<h6 class="mb-0">Laporan Penjualan</h6>');
            }
        });
    </script>
    <!-- END: Page JS-->
@endpush
