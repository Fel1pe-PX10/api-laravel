<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoicesFilter;
use App\Models\Invoce;

use App\Http\Controllers\Controller;

use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;

use App\Http\Requests\V1\BulkStoreInvoceRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request);
        
        if(count($queryItems) > 0){
            $invoces = Invoce::where($queryItems)->paginate();
            return new InvoiceCollection($invoces->appends($request->query()));
        }

        return new InvoiceCollection(Invoce::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function bulkStore(BulkStoreInvoceRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });

        Invoce::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoce $invoce)
    {
        return new InvoiceResource($invoce);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoce $invoce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoce $invoce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoce $invoce)
    {
        //
    }
}
