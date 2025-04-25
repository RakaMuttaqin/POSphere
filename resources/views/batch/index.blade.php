@extends('layouts.app')
@push('title')
    Batch
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
                        <li class="breadcrumb-item"><a href="">Master Data</a>
                        </li>
                        <li class="breadcrumb-item active">Batch</li>
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
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Kode Batch</th>
                                <th>Barang</th>
                                <th>Tanggal Masuk</th>
                                <th>Stok</th>
                                <th>Tanggal Expired</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>{{ $item->tanggal_produksi }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->tanggal_expired }}</td>
                                    {{-- <td> --}}
                                    {{-- <button class="btn btn-sm edit-btn btn-primary" data-id="{{ $item->kode }}"
                                            data-kode_barang="{{ $item->kode_barang }}"
                                            data-tanggal_produksi="{{ $item->tanggal_produksi }}"
                                            data-stok="{{ $item->stok }}"
                                            data-tanggal_expired="{{ $item->tanggal_expired }}" data-bs-toggle="modal"
                                            data-bs-target="#modalForm">
                                            <i data-feather="edit"></i>
                                        </button> --}}

                                    {{-- <form action="{{ route('batch.destroy', $item->kode) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form> --}}
                                    {{-- </td> --}}
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic table -->

    {{-- @include('batch.modal') --}}
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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                customClass: {
                    confirmButton: 'btn btn-primary'
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

        // Edit
        $(document).ready(function() {
            // Event listener untuk tombol edit
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let kode_barang = $(this).data('kode_barang');
                let tanggal_produksi = $(this).data('tanggal_produksi');
                let stok = $(this).data('stok');
                let tanggal_expired = $(this).data('tanggal_expired');

                $('#formMethod').val('PUT');
                $('.form-validate').attr('action', `/batch/edit/${id}`);
                $('#modalFormTitle').text('Edit batch');
            });

            // Reset modal ketika ditutup
            $('#modalForm').on('hidden.bs.modal', function() {
                $('#kode_barang').val('').trigger('change');
                $('#tanggal_produksi').val('');
                $('#stok').val('');
                $('#tanggal_expired').val('');

                $('#formMethod').val('POST');
                $('.form-validate').attr('action', "{{ route('batch.store') }}");
                $('#modalFormTitle').text('Tambah Data');
            });
        });

        $(document).ready(function() {
            'use strict';

            var dt_basic_table = $('.datatables-basic');

            if (dt_basic_table.length) {
                dt_basic_table.DataTable({
                    paging: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50, 75, 100],
                    ordering: true,
                    columnDefs: [{
                        targets: 0,
                        orderable: false,
                        visible: false,
                    }, {
                        targets: -1,
                        orderable: false
                    }],
                    order: [
                        [1, 'asc']
                    ],
                    dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>>' +
                        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                        't' +
                        '<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [
                        // {
                        //     text: feather.icons['plus'].toSvg({
                        //         class: 'me-50 font-small-4'
                        //     }) + 'Tambah batch',
                        //     className: 'create-new btn btn-primary',
                        //     attr: {
                        //         'data-bs-toggle': 'modal',
                        //         'data-bs-target': '#modalForm',
                        //     },
                        //     init: function(api, node, config) {
                        //         $(node).removeClass('btn-secondary');
                        //         $(node).click(function() {
                        //             setTimeout(function() {
                        //                 $('#barcode').focus();
                        //             }, 500);
                        //         });
                        //     }
                        // },
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
                                        columns: [1, 2, 3, 4, 5]
                                    }
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
                    kode_barang: {
                        required: true
                    },
                    tanggal_produksi: {
                        required: true,
                        date: true
                    },
                    stok: {
                        required: true,
                        number: true
                    },
                    tanggal_expired: {
                        required: true,
                        date: true
                    },
                },
                messages: {
                    kode_barang: {
                        required: "Batch harus diisi."
                    },
                    tanggal_produksi: {
                        required: "Tanggal produksi harus diisi.",
                        date: "Tanggal produksi harus berupa tanggal."
                    },
                    stok: {
                        required: "Stok harus diisi.",
                        number: "Stok harus berupa angka."
                    },
                    tanggal_expired: {
                        required: "Tanggal expired harus diisi.",
                        date: "Tanggal expired harus berupa tanggal."
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
