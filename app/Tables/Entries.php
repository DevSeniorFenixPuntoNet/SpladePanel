<?php

namespace App\Tables;

use App\Models\Entry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Entries extends AbstractTable
{
    public function authorize(Request $request)
    {
        return true;
    }

    public function for()
    {
        $globalSearch = \Spatie\QueryBuilder\AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                \Illuminate\Support\Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('license_plate', 'LIKE', "%{$value}%")
                        ->orWhere('entry_time', 'LIKE', "%{$value}%")
                        ->orWhere('entry_status', 'LIKE', "%{$value}%");

                });
            });
        });

        return QueryBuilder::for(Entry::class)
            ->defaultSort('-created_at')
            ->allowedSorts(['entry_time', 'license_plate', 'entry_status', 'make', 'model', 'color', 'vehicle_type', 'entry_time', 'parking_spot_number', 'entry_status', 'driver_name', 'driver_phone', 'rate_type', 'current_rate', 'notes'])
            ->allowedFilters(['entry_time', 'license_plate', 'entry_status', 'make', 'model', 'color', 'vehicle_type', 'entry_time', 'parking_spot_number', 'entry_status', 'driver_name', 'driver_phone', 'rate_type', 'current_rate', 'notes', $globalSearch])
            ->paginate()
            ->withQueryString();
    }

    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id','images', 'entry_time', 'license_plate', 'entry_status', 'make', 'model', 'color', 'vehicle_type', 'entry_time', 'parking_spot_number', 'entry_status', 'driver_name', 'driver_phone', 'rate_type', 'current_rate', 'notes'])
            ->column('images', __('main.entry_time'))
            ->column('entry_time', __('main.entry_time'), sortable: true, searchable: true)
            ->column('license_plate', __('main.license_plate'), sortable: true, searchable: true)
            ->column('entry_status', __('main.entry_status'), sortable: true, searchable: true)
            ->column('make', __('main.make'), sortable: true, searchable: true)
            ->column('model', __('main.model'), sortable: true, searchable: true)
            ->column('color', __('main.color'), sortable: true, searchable: true)
            ->column('vehicle_type', __('main.vehicle_type'), sortable: true, searchable: true)
            ->column('entry_time', __('main.entry_time'), sortable: true, searchable: true)
            ->column('parking_spot_number', __('main.parking_spot_number'), sortable: true, searchable: true)
            ->column('entry_status', __('main.entry_status'), sortable: true, searchable: true)
            ->column('driver_name', __('main.driver_name'), sortable: true, searchable: true)
            ->column('driver_phone', __('main.driver_phone'), sortable: true, searchable: true)
            ->column('rate_type', __('main.rate_type'), sortable: true, searchable: true)
            ->column('current_rate', __('main.current_rate'), sortable: true, searchable: true)
            ->column('notes', __('main.notes'), sortable: true, searchable: true)
            ->column('created_at', __('main.created_at'), sortable: true, searchable: true)
            ->column('actions', __('main.action'));

    }
}
