<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['batch'] = Batch::with('barang')->get();
        return view('batch.index')->with($data);
    }

    public function store(StoreBatchRequest $request)
    {
        //
    }

    public function show(Batch $batch)
    {
        //
    }

    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        //
    }

    public function destroy(Batch $batch)
    {
        //
    }
}
