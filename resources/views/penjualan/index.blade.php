@extends('layouts.app')
@push('title')
    Penjualan
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
    <style>
        @media print {
            @page {
                size: 58mm auto;
            }

            #print-content * {
                visibility: visible;
            }

            #print-content {
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: white;
                z-index: 9999;
                padding: 20px;
                box-shadow: none;
            }

        }
    </style>
@endpush

@section('content-header')
    <div class="content-header-left col-md-9 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <!-- Basic table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="container mt-1">
                <h4 class="fw-bold mb-1">Penjualan</h4>
                <form class="form-validate" action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <!-- Pencarian Barang -->
                    <div class="card mb-1">
                        <div class="card-body">
                            <label class="form-label" for="searchBarang">Cari Barang</label>
                            <select class="form-select select2" id="searchBarang"></select>
                        </div>
                    </div>

                    <!-- Pencarian Member -->
                    <div class="card mb-1">
                        <div class="card-body">
                            <label for="searchMember" class="form-label fw-semibold">Cari Member</label>
                            <input type="search" class="form-control" id="searchMember"
                                placeholder="Masukkan email atau no HP member...">
                        </div>
                    </div>

                    <!-- Keranjang Belanja -->
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="card-title text-white mb-0">Keranjang Belanja</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle" id="keranjang-belanja">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan ditambahkan di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <div class="text-end">
                                <p class="form-label mb-1">Total Keseluruhan: <span id="total_keseluruhan">Rp 0,00</span>
                                </p>
                                <div class="mb-1">
                                    <label for="total_bayar" class="form-label fw-semibold">Total Bayar:</label>
                                    <input type="number" class="form-control w-40 text-end d-inline-block"
                                        id="total_bayar" placeholder="Rp 0,00" oninput="hitungKembalian()">
                                </div>
                                <p class="form-label mb-1">Kembalian: <span id="kembalian">Rp 0,00</span></p>
                                <button type="submit" class="btn btn-success">Proses Penjualan</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

    </section>
    <!--/ Basic table -->
    {{-- @include('penjualan.faktur') --}}
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
    <script src="{{ asset('app-assets') }}/js/scripts/forms/form-select2.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('{{ route('penjualan.faktur', session('faktur_kode')) }}', '_blank');
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk pencarian barang
            $('#searchBarang').select2({
                width: 'resolve',
                dropdownAutoWidth: true,
                dropdownParent: $('#searchBarang').parent(),
                placeholder: "Ketik untuk mencari barang...",
                allowClear: true,
                minimumInputLength: 1,
                ajax: {
                    url: '/barang/list',
                    dataType: 'json',
                    delay: 100,
                    data: (params) => ({
                        search: params.term,
                        context: 'penjualan'
                    }),
                    processResults: (data) => ({
                        results: data.barang.map((item) => ({
                            id: item.kode,
                            text: `${item.barcode} - ${item.nama}`,
                            harga_beli: item.harga_beli,
                            harga_jual: item.harga_jual,
                        }))
                    })
                }
            });

            // Ketika barang dipilih, tambahkan ke tabel
            $('#searchBarang').on('select2:select', function(e) {
                let data = e.params.data;
                tambahKeTabel(data.id, data.text, data.harga_beli, data.harga_jual);

                // Reset input pencarian setelah dipilih
                setTimeout(() => {
                    $('#searchBarang').val(null).trigger('change');
                }, 100);
            });
        });

        // Fungsi menambahkan barang ke tabel
        function tambahKeTabel(kode, nama, harga_beli, harga_jual) {
            let tableBody = document.querySelector("#keranjang-belanja tbody");
            let rowCount = tableBody.rows.length;

            let newRow = `
        <tr>
            <td><input type="hidden" name="details[${rowCount}][kode_barang]" value="${kode}">${nama}</td>
            <td><input type="number" class="form-control" name="details[${rowCount}][harga_beli]" value="${harga_beli}" readonly></td>
            <td><input type="number" class="form-control" name="details[${rowCount}][harga_jual]" value="${harga_jual}" readonly></td>
            <td><input type="number" class="form-control" name="details[${rowCount}][jumlah]" oninput="hitungSubtotal(this)" required></td>
            <td class="subtotal">Rp 0</td>
            <td><button type="button" class="btn btn-danger btn-remove"><i data-feather="trash"></i></button></td>
        </tr>
    `;

            tableBody.insertAdjacentHTML("beforeend", newRow);
            feather.replace();
        }

        // Hapus barang dari keranjang
        document.addEventListener("click", function(e) {
            if (e.target.closest(".btn-remove")) {
                e.target.closest("tr").remove();
                hitungTotalKeseluruhan();
            }
        });

        // Hitung subtotal per barang
        function hitungSubtotal(input) {
            const row = input.closest('tr');
            const hargaJual = new Number(row.querySelector('[name*="[harga_jual]"]').value.replace(/\./g, '').replace(',',
                '.')) || 0;
            const jumlah = new Number(input.value) || 0;
            const subtotal = hargaJual * jumlah;

            // Perbarui tampilan subtotal
            row.querySelector('.subtotal').textContent =
                `${Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal)}`;

            // Hitung ulang total keseluruhan
            hitungTotalKeseluruhan();
        }

        // Hitung total keseluruhan dari semua barang
        function hitungTotalKeseluruhan() {
            let totalKeseluruhan = 0;
            document.querySelectorAll('#keranjang-belanja .subtotal').forEach(subtotal => {
                totalKeseluruhan += parseFloat(subtotal.textContent.replace(/[^0-9,-]+/g, '').replace(',', '.')) ||
                    0;
            });

            document.getElementById('total_keseluruhan').textContent =
                `${Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalKeseluruhan)}`;

            hitungKembalian();
        }

        // Hitung kembalian dari total bayar - total keseluruhan
        function hitungKembalian() {
            const totalBayar = parseFloat(document.getElementById('total_bayar').value.replace(/[^0-9,-]+/g, '').replace(
                ',', '.')) || 0;
            const totalKeseluruhan = parseFloat(document.getElementById('total_keseluruhan').textContent.replace(
                /[^0-9,-]+/g, '').replace(',', '.')) || 0;
            const kembalian = totalBayar - totalKeseluruhan;

            document.getElementById('kembalian').textContent =
                `${Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(kembalian)}`;
        }

        document.querySelector("form").addEventListener("submit", function(e) {
            document.getElementById("total_bayar").removeAttribute("name");
        });

        $(document).ready(function() {
            $(".btn-detail").off("click").on("click", function() {
                let id = $(this).data("id");
                console.log(id);

                $.ajax({
                    url: `/pembelian/detail/${id}`,
                    method: "GET",
                    success: function(response) {
                        $("#modal-kode").text(response.kode ?? "-");
                        $("#modal-user").text(response.user.name ?? "-");
                        $("#modal-pemasok").text(response.pemasok.nama ?? "-");
                        $("#modal-total").text(new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(response.total) ??
                            "-");
                        $("#modal-tanggal_terima").text(response.tanggal_terima ?? "-");
                        $("#modal-tanggal_masuk").text(response.tanggal_masuk ?? "-");
                        $("#modal-keterangan").text(response.keterangan ?? "-");

                        let tbody = $("#modal-detail-table tbody");
                        tbody.empty();

                        if (response.detail_pembelian && response.detail_pembelian.length > 0) {
                            response.detail_pembelian.forEach(detail => {
                                let hargaBeli = detail.harga_beli ?
                                    `${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(detail.harga_beli)}` :
                                    "Rp -";
                                let hargaJual = detail.harga_jual ?
                                    `${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(detail.harga_jual)}` :
                                    "Rp -";

                                let row = `
                            <tr>
                                <td>${detail.kode ?? "-"}</td>
                                <td>${detail.kode_barang ?? "-"}</td>
                                <td>${detail.barang.nama ?? "-"}</td>
                                <td>${detail.jumlah ?? "-"}</td>
                                <td>${hargaBeli}</td>
                                <td>${hargaJual}</td>
                            </tr>`;
                                tbody.append(row);
                            });
                        } else {
                            tbody.append(
                                `<tr><td colspan="6" class="text-center">Tidak ada detail penjualan</td></tr>`
                            );
                        }

                        $("#modalDetail").modal("show");
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

        // SweetAlert
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('.delete-form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // DataTable
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
                            text: feather.icons['plus'].toSvg({
                                class: 'me-50 font-small-4'
                            }) + 'Tambah Transaksi',
                            className: 'create-new btn btn-primary',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#modalForm',
                            },
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary');
                                $(node).click(function() {
                                    setTimeout(function() {
                                        $('#kode').focus();
                                    }, 500);
                                });
                            }
                        },
                        {
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
                                        columns: [0, 1, 2, 3]
                                    } // Menyesuaikan kolom yang diekspor
                                },
                                {
                                    extend: 'csv',
                                    text: feather.icons['file-text'].toSvg({
                                        class: 'font-small-4 me-50'
                                    }) + 'Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]
                                    }
                                },
                                {
                                    extend: 'excel',
                                    text: feather.icons['file'].toSvg({
                                        class: 'font-small-4 me-50'
                                    }) + 'Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: feather.icons['clipboard'].toSvg({
                                        class: 'font-small-4 me-50'
                                    }) + 'Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]
                                    }
                                },
                                {
                                    extend: 'copy',
                                    text: feather.icons['copy'].toSvg({
                                        class: 'font-small-4 me-50'
                                    }) + 'Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]
                                    }
                                }
                            ]
                        }
                    ],
                    responsive: true,
                    language: {
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });

                $('div.head-label').html('<h6 class="mb-0"></h6>');
            }
        });

        $(document).ready(function() {
            $('.form-validate').validate({
                rules: {
                    kode: {
                        required: true,
                    },
                    nama: {
                        required: true,
                        minlength: 3
                    },
                    harga_beli: {
                        required: true,
                    },
                    harga_jual: {
                        required: true,
                    },
                    jumlah: {
                        required: true,
                    },
                },
                messages: {
                    kode: {
                        required: "Kode Barang harus diisi.",
                    },

                    nama: {
                        required: "Nama Barang harus diisi.",
                        minlength: "Nama Barang minimal 3 karakter.",
                    },
                    harga_beli: {
                        required: "Harga Beli Barang harus diisi.",
                    },
                    harga_jual: {
                        required: "Harga Jual Barang harus diisi.",
                    },
                    jumlah: {
                        required: "Jumlah harus diisi.",
                    },
                },
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".mb-1").append(error);
                    element.addClass("is-invalid");
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                    $(element).addClass("is-valid");
                },
            });
        });
    </script>
    <!-- END: Page JS-->
@endpush
