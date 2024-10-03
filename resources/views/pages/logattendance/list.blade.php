<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Hadir') }}
    </x-slot>
    <x-splade-table :for="$logattendances">
        <x-splade-cell information as="$logattendance">
            @switch($logattendance->information)
                @case('V')
                    Hadir
                    @break
    
                @case('S')
                    Sakit
                    @break
    
                @case('I')
                    Ijin
                    @break
    
                @case('A')
                    Alpha
                    @break
    
                @default
                    {{ $logattendance->information }}
            @endswitch
        </x-splade-cell>
    </x-splade-table>
</x-app-layout>
