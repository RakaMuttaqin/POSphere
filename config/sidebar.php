<?php

return [
    [
        'title' => 'Master Data',
        'icon' => 'database',
        'roles' => ['SuperAdmin', 'Admin'],
        'items' => [
            // ['title' => 'User', 'route' => 'users.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin']],
            ['title' => 'Pemasok', 'route' => 'pemasok.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
            ['title' => 'Satuan', 'route' => 'satuan.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin']],
            ['title' => 'Jenis Barang', 'route' => 'jenis-barang.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin']],
        ],
    ],
    [
        'title' => 'Keanggotaan',
        'icon' => 'users',
        'roles' => ['SuperAdmin', 'Admin'],
        'items' => [
            ['title' => 'Jenis Member', 'route' => 'jenis-member.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin']],
            ['title' => 'Member', 'route' => 'member.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Kasir']],
        ],
    ],
    [
        'title' => 'Inventaris',
        'icon' => 'box',
        'roles' => ['SuperAdmin', 'Admin', 'Owner'],
        'items' => [
            ['title' => 'Barang', 'route' => 'barang.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Kasir']],
            ['title' => 'Batch', 'route' => 'batch.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
            // ['title' => 'Stok Masuk', 'route' => 'stok-masuk.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
            // ['title' => 'Stok Keluar', 'route' => 'stok-keluar.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
        ],
    ],
    [
        'title' => 'Transaksi',
        'icon' => 'shopping-cart',
        'roles' => ['SuperAdmin', 'Admin', 'Kasir'],
        'items' => [
            ['title' => 'Pembelian', 'route' => 'pembelian.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin']],
            ['title' => 'Penjualan', 'route' => 'penjualan.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Kasir']],
        ],
    ],
    [
        'title' => 'Pengajuan',
        'icon' => 'clipboard',
        'roles' => ['SuperAdmin', 'Admin', 'Kasir'],
        'items' => [
            ['title' => 'Pengajuan Barang', 'route' => 'pengajuan-barang.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Kasir']],
        ]
    ],
    [
        'title' => 'Laporan',
        'icon' => 'file-text',
        'roles' => ['SuperAdmin', 'Admin', 'Owner'],
        'items' => [
            ['title' => 'Laporan Penjualan', 'route' => 'laporan-penjualan.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
            // ['title' => 'Laporan Pembelian', 'route' => 'laporan-pembelian.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
            // ['title' => 'Laporan Stok Barang', 'route' => 'laporan-stok.index', 'icon' => 'circle', 'roles' => ['SuperAdmin', 'Admin', 'Owner']],
        ],
    ],
];
