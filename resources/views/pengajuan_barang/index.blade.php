@extends('layouts.app')
@push('title')
    Pengajuan Barang
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
                        <li class="breadcrumb-item"><a href="">Pengajuan Barang</a>
                        </li>
                        <li class="breadcrumb-item active">Form Pengajuan</li>
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
                            <i data-feather="plus" class="me-50 font-small-4"></i> Tambah Pengajuan
                        </button>
                        <div class="btn-group dropright">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="download" class="me-50 font-small-4"></i> Ekspor
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('pengajuan-barang.export') }}">Export
                                        Excel</a></li>
                                <li><a class="dropdown-item" href="{{ route('pengajuan-barang.exportPDF') }}">Export
                                        PDF</a></li>
                            </ul>
                        </div>
                    </div>

                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Pengajuan</th>
                                <th>Nama Pengaju</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Qty</th>
                                <th>Terpenuhi?</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuanBarang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_pengajuan }}</td>
                                    <td>{{ $item->member->nama }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->tanggal_pengajuan }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>
                                        <div class="form-check form-check-success form-switch">
                                            <input type="checkbox" {{ $item->status == '1' ? 'checked' : '' }}
                                                class="form-check-input update-status" id="customSwitch4"
                                                data-id="{{ $item->kode_pengajuan }}" />
                                            <label class="form-check-label" for="customSwitch4">
                                                {{ $item->status == '1' ? 'Terpenuhi' : 'Belum Terpenuhi' }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm edit-btn btn-primary"
                                            data-id="{{ $item->kode_pengajuan }}"
                                            data-kode_member="{{ $item->kode_member }}"
                                            data-nama_barang="{{ $item->nama_barang }}"
                                            data-tanggal_pengajuan="{{ $item->tanggal_pengajuan }}"
                                            data-qty="{{ $item->qty }}" data-status="{{ $item->status }}"
                                            data-bs-toggle="modal" data-bs-target="#modalForm">
                                            <i data-feather="edit"></i>
                                        </button>

                                        <form action="{{ route('pengajuan-barang.destroy', $item->kode_pengajuan) }}"
                                            method="POST" class="d-inline delete-form">
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

    @include('pengajuan_barang.modal')
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
        $(document).on('change', '.update-status', function() {
            var id = $(this).data('id');
            // jika checkbox di ceklis maka status akan di set 1, jika tidak maka status akan di set 0
            var status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '/pengajuan-barang/edit-status/' + id,
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

        $(document).ready(function() {
            // Search Member
            $('#kode_member').select2({
                width: 'resolve',
                dropdownAutoWidth: true,
                dropdownParent: $('#kode_member').parent(),
                placeholder: "Ketik untuk mencari Member...",
                allowClear: true,
                ajax: {
                    url: '/member/show',
                    dataType: 'json',
                    delay: 1000,
                    data: (params) => ({
                        search: params.term
                    }),
                    processResults: (data) => ({
                        results: data.map((item) => ({
                            id: item.kode,
                            text: `${item.kode} - ${item.nama}`,
                            no_hp: item.no_hp,
                            email: item.email,
                            alamat: item.alamat,
                            tanggal_bergabung: item.tanggal_bergabung,
                            kode_jenis_member: item.kode_jenis_member,
                        }))
                    })
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
                let kode_member = $(this).data('kode_member');
                let nama_barang = $(this).data('nama_barang');
                let qty = $(this).data('qty');

                // Set values in the modal form fields
                $('#kode_member').val(kode_member).trigger('select2:select');
                $('#nama_barang').val(nama_barang).focus();
                $('#qty').val(qty).focus();

                if ($('#kode_member').find("option[value='" + kode_member + "']").length === 0) {
                    let newOption = new Option(kode_member, kode_member, true, true);
                    $('#kode_member').append(newOption).trigger('change.select2');
                } else {
                    $('#kode_member').val(kode_member).trigger('change.select2');
                }

                // Update the form action URL with the correct item ID for update
                $('.form-validate').attr('action', `/pengajuan-barang/edit/${id}`);
                $('#formMethod').val('PATCH');

                // Change the modal title to "Edit pengajuan-barang"
                $('#modalFormTitle').text('Edit pengajuan-barang');
            });

            // Reset the form when the modal is closed
            $('#modalForm').on('hidden.bs.modal', function() {
                // Clear form inputs
                $('#kode_member').val('');
                $('#nama_barang').val('');
                $('#qty').val('');

                // Reset form action for adding new data
                $('.form-validate').attr('action', "{{ route('pengajuan-barang.store') }}");
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
                    kode_member: {
                        required: true,
                    },
                    kode_member: {
                        required: true,
                    },
                    nama_barang: {
                        required: true,
                        minlength: 3
                    },
                },
                messages: {
                    kode_member: {
                        required: "Nama Pengaju harus diisi.",
                    },
                    kode_member: {
                        required: "Alamat harus diisi.",
                    },
                    nama_barang: {
                        required: "Nomor Telepon  harus diisi.",
                        minlength: "Nomor Telepon  minimal 11 karakter.",
                        maxlength: "Nomor Telepon  maksimal 13 karakter."
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
                }
            });
        });
    </script>
    <!-- END: Page JS-->
@endpush
