@extends('layouts.app')
@push('title')
    - Absensi Kerja
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
                        <li class="breadcrumb-item"><a href="">Absensi</a>
                        </li>
                        <li class="breadcrumb-item active">Absensi Kerja Karyawan</li>
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
                    <div class="card-header border-bottom p-1 d-flex justify-content-between">
                        <button class="btn btn-primary create-new" data-bs-toggle="modal" data-bs-target="#modalForm"
                            id="tambahData">
                            <i data-feather="plus" class="me-50 font-small-4"></i> Tambah Absensi
                        </button>
                        <div class="btn-group">
                            <button class="btn btn-success import-new" data-bs-toggle="modal" data-bs-target="#modalImport">
                                <i data-feather="upload" class="me-50 font-small-4"></i> Import
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='{{ route('absensi-kerja.formatImport') }}'">
                                <i data-feather="download" class="me-50 font-small-4"></i> Format
                                Import</button>
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="download" class="me-50 font-small-4"></i> Ekspor
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('absensi-kerja.exportExcel') }}">Export
                                        Excel</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('absensi-kerja.exportPDF') }}">Export
                                        PDF</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal Masuk</th>
                                <th>Waktu Masuk</th>
                                <th>Status</th>
                                <th>Waktu Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->karyawan_id }}</td>
                                    <td>{{ $item->tanggal_masuk }}</td>
                                    <td>{{ $item->waktu_masuk }}</td>
                                    <td>
                                        <select class="form-select form-control update-status-select" name="status"
                                            data-id="{{ $item->id }}">
                                            <option value="masuk" {{ $item->status == 'masuk' ? 'selected' : '' }}>Masuk
                                            </option>
                                            <option value="sakit" {{ $item->status == 'sakit' ? 'selected' : '' }}>Sakit
                                            </option>
                                            <option value="cuti" {{ $item->status == 'cuti' ? 'selected' : '' }}>Cuti
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        @if ($item->waktu_selesai_kerja == '00:00:00' && $item->status == 'masuk')
                                            <button class="btn btn-sm btn-success selesai-btn"
                                                data-id="{{ $item->id }}">
                                                Selesai
                                            </button>
                                        @else
                                            {{ $item->waktu_selesai_kerja }}
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm edit-btn btn-primary" data-id="{{ $item->id }}"
                                            data-karyawan_id="{{ $item->karyawan_id }}"
                                            data-tanggal_masuk="{{ $item->tanggal_masuk }}" data-bs-toggle="modal"
                                            data-bs-target="#modalForm">
                                            <i data-feather="edit"></i>
                                        </button>

                                        <form action="{{ route('absensi-kerja.destroy', $item->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
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

    @include('absensi_kerja.modal')
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
                title: 'Gagal',
                text: @json(session('error')),
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
        </script>
    @endif

    <script>
        $(document).on('click', '.selesai-btn', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/absensi-kerja/edit-selesai/' + id,
                method: 'PATCH',
                data: {
                    status: 'selesai',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
            });
        })

        $(document).on('change', '.update-status-select', function() {
            var id = $(this).data('id');
            var status = $(this).val();

            $.ajax({
                url: '/absensi-kerja/edit-status/' + id,
                method: 'PATCH',
                data: {
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    location.reload();
                }
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

        // Edit
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                // Get data attributes from the clicked button
                let id = $(this).data('id');
                let karyawan_id = $(this).data('karyawan_id');
                let tanggal_masuk = $(this).data('tanggal_masuk');

                // Set values in the modal form fields
                $('#karyawan_id').val(karyawan_id).trigger('change').focus();
                $('#tanggal_masuk').val(tanggal_masuk).focus();

                // Update the form action URL with the correct item ID for update
                $('.form-validate').attr('action', `/absensi-kerja/edit/${id}`);
                $('#formMethod').val('PATCH');

                // Hide #status when the edit modal is opened
                $('#status').closest('.mb-1').hide();

                // Change the modal title to "Edit Absensi"
                $('#modalFormTitle').text('Edit Absensi');
            });

            // Reset the form when the modal is closed
            $('#modalForm').on('hidden.bs.modal', function() {
                // Clear form inputs
                $('#karyawan_id').val('');
                $('#tanggal_masuk').val('');
                $('#waktu_masuk').val('');
                $('#waktu_selesai_kerja').val('');

                // Reset form action for adding new data
                $('.form-validate').attr('action', "{{ route('absensi-kerja.store') }}");
                $('#formMethod').val('POST');

                // Reset modal title to "Tambah Data"
                $('#modalFormTitle').text('Tambah Data');
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
                    ],
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                        't' +
                        '<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [],
                    responsive: true,
                    language: {
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });
            }
        });

        $(document).ready(function() {
            $('.form-validate').validate({
                rules: {
                    karyawan_id: {
                        required: true,
                    },
                    tanggal_masuk: {
                        required: true
                    }
                },
                messages: {
                    karyawan_id: {
                        required: "Nama Karyawan harus diisi.",
                        minlength: "Nama Karyawan minimal 3 karakter.",
                    },
                    tanggal_masuk: {
                        required: "Tanggal Masuk harus diisi.",
                    }
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
