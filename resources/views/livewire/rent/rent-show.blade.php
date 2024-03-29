<div>
    <x-slot name="header">
        <h2>Detalhes da locação</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações da locação</h3>
        </div>
        <div class="card-body display">
            <div>
                <h4>Data</h4>
                <h5>{{ $rent->date->format('d/m/Y') }}</h5>
            </div>
            <div class="sm:col-span-5">
                <h4>Obra</h4>
                <h5>{{ $service->title }} ({{ $service->contract_number }})</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Cliente</h4>
                <h5>{{ $service->client->company_name }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Locador</h4>
                <h5>{{ $renter->company_name }}</h5>
            </div>
            <div>
                <h4>Valor</h4>
                <h5>R$ {{ $rent->formated_amount }}</h5>
            </div>
            <div class="sm:col-span-6">
                <h4>Item(ns)</h4>
                <p class="text-sm">{{ $rent->item }}</p>
            </div>
            <div class="sm:col-span-6">
                <h4>Observações</h4>
                <p class="text-sm">{{ $rent->note }}</p>
            </div>
        </div>
    </div>
</div>
