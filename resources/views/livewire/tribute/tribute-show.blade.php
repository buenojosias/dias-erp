<div>
    <x-slot name="header">
        <h2>Detalhes do tributo</h2>
    </x-slot>
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações do tributo</h3>
        </div>
        <div class="card-body display">
            <div class="sm:col-span-2">
                <h4>Data de emissão</h4>
                <h5>{{ $tribute->date->format('d/m/Y') }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Tributo</h4>
                <h5>{{ $tribute->title->title }} ({{ $tribute->title->type }})</h5>
            </div>
            <div>
                <h4>Valor</h4>
                <h5>R$ {{ $tribute->formated_amount }}</h5>
            </div>
            <div>
                <h4>Parcelas</h4>
                <h5>{{ $tribute->installments->count() }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Obra</h4>
                <h5>{{ $service->title }} ({{ $service->contract_number }})</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Cliente</h4>
                <h5>{{ $service->client->company_name }}</h5>
            </div>
            <div class="sm:col-span-6">
                <h4>Observações</h4>
                <p class="text-sm">{{ $tribute->note }}</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Parcelas</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead class="text-left">
                    <th>Vencimento</th>
                    <th>Valor</th>
                    <th>Data pagamento</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($installments as $installment)
                        <tr>
                            <td>{{ $installment->expiration_date ? $installment->expiration_date->format('d/m/Y') : 'Não informado' }}</td>
                            <td>R$ {{ $installment->formated_amount }}</td>
                            <td>{{ $installment->payment_date ? $installment->payment_date->format('d/m/Y') : '' }}
                            </td>
                            <td>{{ $installment->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
