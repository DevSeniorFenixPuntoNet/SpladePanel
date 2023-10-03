@seoTitle(__('main.entrys'))

<x-dashboard-layout>
    {{-- Head --}}
    <div class="flex justify-between items-end mb-4">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ul class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <Link href="{{ route('dashboard.entrys.entrys.index') }}"
                              class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.entrys')
                        </Link>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 text-xs rtl:rotate-180"></i>
                        <a href="#"
                           class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.list')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.entrys')
            </h1>
        </div>
        <div>
            @can('create permissions')
                <x-btn-link href="#create">
                    @lang('main.add_new')
                </x-btn-link>
            @endcan
        </div>
    </div>
    {{-- Create Modal --}}
    @can('create permissions')
        <x-splade-modal name="create" max-width="5xl">
            <x-splade-form :action="route('dashboard.entrys.entrys.store')" method="POST" class="space-y-4">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    @lang('main.add_new')
                </h3>

                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <!-- Placa del vehículo -->
                    <x-splade-input name="license_plate" label="{{ __('main.license_plate') }}" required/>

                    <!-- Marca -->
                    <x-splade-input name="make" label="{{ __('main.make') }}" required/>

                    <!-- Modelo -->
                    <x-splade-input name="model" label="{{ __('main.model') }}" required/>

                    <!-- Color -->
                    <x-splade-input name="color" label="{{ __('main.color') }}" required/>

                    <!-- Tipo de vehículo -->
                    <x-splade-select name="vehicle_type" label="{{ __('main.vehicle_type') }}" :options="$vehicleTypes"
                                     required/>

                    <!-- Hora de entrada -->
                    <x-splade-input type="datetime-local" name="entry_time" label="{{ __('main.entry_time') }}"
                                    required/>

                    <!-- Número de estacionamiento -->
                    <x-splade-input name="parking_spot_number" label="{{ __('main.parking_spot_number') }}" required/>

                    <!-- Estado de entrada -->
                    <x-splade-select name="entry_status" label="{{ __('main.entry_status') }}"
                                     :options="$entryStatusOptions" required/>

                    <!-- Nombre del conductor -->
                    <x-splade-input name="driver_name" label="{{ __('main.driver_name') }}"/>

                    <!-- Número de teléfono del conductor -->
                    <x-splade-input name="driver_phone" label="{{ __('main.driver_phone') }}"/>

                    <!-- Tipo de tarifa -->
                    <x-splade-select name="rate_type" label="{{ __('main.rate_type') }}" :options="$rateTypeOptions"
                                     required/>

                    <!-- Tarifa actual -->
                    <x-splade-input type="number" name="current_rate" label="{{ __('main.current_rate') }}" required/>

                    <!-- Notas adicionales -->
                    <x-splade-textarea name="notes" label="{{ __('main.notes') }}" class="col-span-2"/>

                    <!-- imagenes -->
                    <x-splade-file required filepond preview name="images" label="{{__('main.image')}}"
                                   :show-filename="false" accept="image/png"/>

                </div>

                <x-splade-submit :label="__('main.submit')"/>
            </x-splade-form>
        </x-splade-modal>

    @endcan

    {{--     Content --}}
    <x-section-content>
        <x-splade-table :for="$entries">

            <x-splade-cell actions as="$entry">
                @can('update users')
                    <x-nav-link href="{{ route('dashboard.entrys.entrys.edit',$entry) }}">
                        @lang('main.edit')
                    </x-nav-link>
                @endcan
                    @can('delete users')
                        <x-nav-link href="{{ route('dashboard.entrys.entrys.destroy', $entry) }}" method="DELETE" confirm="{{ __('main.confirm_delete_entries') }}" confirm-text="{{ __('main.confirm_text_delete_user') }}" class="text-red-600 dark:text-red-600">
                            @lang('main.delete')
                        </x-nav-link>
                    @endcan
            </x-splade-cell>

        </x-splade-table>
    </x-section-content>
</x-dashboard-layout>
