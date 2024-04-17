<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('service.index', [
            'services' => Service::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->integer('harga');
            $table->integer('harga_promo')->nullable();
            $table->string('deskripsi');
            $table->string('gambar');
            $table->string('minimal_order');
            $table->string('bahan');

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1028',
            'minimal_order' => 'required',
            'bahan' => 'required',
        ]);

        $imageName = time().'.'.$request->gambar->extension();

        $request->gambar->move(public_path('images'), $imageName);

        Service::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'harga_promo' => $request->harga_promo,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
            'minimal_order' => $request->minimal_order,
            'bahan' => $request->bahan,
        ]);

        return redirect()->route('service.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('service.show', [
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('service.edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1028',
            'minimal_order' => 'required',
            'bahan' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $service->update([
                'gambar' => $imageName,
            ]);
        }

        $service->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'harga_promo' => $request->harga_promo,
            'deskripsi' => $request->deskripsi,
            'minimal_order' => $request->minimal_order,
            'bahan' => $request->bahan,
        ]);

        return redirect()->route('service.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('service.index')
            ->with('success', 'Service deleted successfully.');
    }
}
