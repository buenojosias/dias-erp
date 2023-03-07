<div>
    <x-slot name="header">
        <h2>Detalhes da compra</h2>
    </x-slot>
    @dump($purchase->toArray())
    <div class="card mb-6">
        <div class="card-header">
            <h3 class="card-title">Informações da compra</h3>
        </div>
        <div class="card-body display">
            {{-- <div class="sm:col-span-2">
                <h4>Data</h4>
                <h5>{{ $proposal->date->format('d/m/Y') }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Cliente</h4>
                <h5>{{ $client->company_name }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Valor</h4>
                <h5>R$ {{ $proposal->amount / 100 }}</h5>
            </div>
            <div>
                <h4>Status</h4>
                <h5>{{ $proposal->status }}</h5>
            </div>
            <div class="sm:col-span-6">
                <h4>Observações</h4>
                <p class="text-sm">{{ $proposal->note }}</p>
            </div> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Parcelas</h3>
        </div>
    </div>

</div>
