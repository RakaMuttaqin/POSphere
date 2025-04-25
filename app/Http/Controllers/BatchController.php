<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;

class BatchController extends Controller
{
    /**
     * Menampilkan daftar data batch.
     */
    public function index()
    {
        $data['batch'] = Batch::with('barang')->get();
        return view('batch.index')->with($data);
    }

    /**
     * Menampilkan data batch yang sesuai dengan parameter yang diberikan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data['batch'] = Batch::with('barang')->when($id, function ($query, $id) {
            $query->where('id', $id);
        })->get();
        return response()->json($data);
    }
}
