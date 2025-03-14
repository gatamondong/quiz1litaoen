<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryModel;

class InventoryController extends Controller
{
    public function index()
    {
        $inventoryItems =  InventoryModel::all();
        return view('inventory.index', compact('inventoryItems'));
    }


    public function create()
    {
        return view('inventory.create');
    }


    public function store(Request $request)
    {
        $validated = $request ->validate([
            'name' => 'required|string|min:3',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]); InventoryModel::create($validated);

        return redirect(env('APP_URL') . '/inventory')
            ->with('success', 'Item added successfully.');
    }


    public function show(string $id)
    {
        $inventoryItem = InventoryModel::find($id);

        if(!$inventoryItem) {
            return redirect(env('APP_URL') . '/inventory')
            ->with('error', 'Item not Found.');
        }
        
        return view('inventory.edit', compact('inventoryItem'));
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        
        $inventoryItem = InventoryModel::find($id);

        if(!$inventoryItem) {
            return redirect(env('APP_URL') . './inventory')
            ->with('error', 'Item not Found.');
        }

        $inventoryItem->update($validated);

        return redirect(env('APP_URL') . '/inventory')
        ->with('success', 'Item updated Successfully.');
    }

    public function destroy(string $id)
    {
        $inventoryitem = InventoryModel::find($id);

        if(!$inventoryitem){
            return redirect(env('APP_URL') . '/inventory')
            ->with('error', 'Item not Found.');
        }

        $inventoryitem->delete();
        
        return redirect(env('APP_URL') . '/inventory')
        ->with('success', 'Item deleted Successfully.');
    }
}
