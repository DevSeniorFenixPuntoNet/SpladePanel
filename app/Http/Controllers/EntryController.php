<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Tables\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Metadata\Uses;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FileUploads\HandleSpladeFileUploads;
use Spatie\Permission\Models\Role;
use App\Tables\Entries;

class EntryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = [
            'Automóvil' => 'Automóvil',
            'Camioneta' => 'Camioneta',
            'Motocicleta' => 'Motocicleta',
            // Agrega más opciones según sea necesario
        ];
        $entryStatusOptions = [
            'En tránsito' => 'En tránsito',
            'Estacionado' => 'Estacionado',
            // Agrega más opciones según sea necesario
        ];

        $rateTypeOptions = [
            'Por hora' => 'Por hora',
            'Por día' => 'Por día',
            // Agrega más opciones según sea necesario
        ];

        return view('entrys.index', [
            'entries' => Entries::class,
            'roles' => Role::pluck('name', 'id')->toArray(),
            'vehicleTypes' => $vehicleTypes,
            'entryStatusOptions' => $entryStatusOptions,
            'rateTypeOptions' => $rateTypeOptions,
        ]);
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
        $request->validate([
            'license_plate' => 'required|string',
            'make' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'vehicle_type' => 'required|string',
            'entry_time' => 'required',
            'parking_spot_number' => 'nullable|integer',
            'entry_status' => 'string',
            'driver_name' => 'nullable|string',
            'driver_phone' => 'nullable|string',
            'rate_type' => 'string',
            'current_rate' => 'numeric',
            'notes' => 'nullable|string',
            'images'  => 'required|image'
        ]);

        $images = $request->file('images');
        $name = $images->hashName();
        Storage::put("public/images", $images);


        $entry = new Entry;
        $entry->fill($request->all());
        $entry->save();

        Toast::title(__('main.user_created'))->autoDismiss(3);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entry $entry)
    {
        return view('entrys.edit',compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
