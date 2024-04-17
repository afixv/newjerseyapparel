<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('portfolio.index', [
            'portfolios' => Portfolio::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1028',
        ]);

        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'), $imageName);

        Portfolio::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
        ]);

        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        return view('portfolio.show', [
            'portfolio' => $portfolio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.edit', [
            'portfolio' => $portfolio
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1028',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $portfolio->update([
                'gambar' => $imageName,
            ]);
        }

        $portfolio->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio deleted successfully.');
    }
}
