<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenda = Agenda::latest()->paginate(10);
        return view('superadmin.agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'waktu' => 'required',
            'tanggal' => 'required|date',
            'acara' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'pj_agenda' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Agenda::create($request->all());

        return redirect()->route('superadmin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('superadmin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'waktu' => 'required',
            'tanggal' => 'required|date',
            'acara' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'pj_agenda' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $agenda->update($request->all());

        return redirect()->route('superadmin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('superadmin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}
