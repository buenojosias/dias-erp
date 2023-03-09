<div>
    <x-slot name="header">
        <h2>Detalhes da compra</h2>
    </x-slot>
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações da compra</h3>
        </div>
        <div class="card-body display">
            <div>
                <h4>Data</h4>
                <h5>{{ $purchase->date->format('d/m/Y') }}</h5>
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
                <h4>Fornecedor</h4>
                <h5>{{ $supplier->company_name }}</h5>
            </div>
            <div>
                <h4>Valor total</h4>
                <h5>R$ {{ $purchase->formated_amount }}</h5>
            </div>
            <div>
                <h4>Método de pagamento</h4>
                <h5>{{ $purchase->payment_method }}</h5>
            </div>
            @if ($purchase->payment_method === 'Parcelado')
                <div>
                    <h4>Parcelas</h4>
                    <h5>{{ $purchase->installments->count() }}</h5>
                </div>
            @endif
            <div class="sm:col-span-6">
                <h4>Produtos</h4>
                <p class="text-sm">{{ $purchase->products }}</p>
            </div>
            <div class="sm:col-span-6">
                <h4>Observações</h4>
                <p class="text-sm">{{ $purchase->note }}</p>
            </div>
        </div>
    </div>
    @if ($purchase->payment_method === 'Parcelado')
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
                                <td>{{ $installment->expiration_date->format('d/m/Y') }}</td>
                                <td>R$ {{ $installment->formated_amount }}</td>
                                <td>{{ $installment->payment_date ? $installment->payment_date->format('d/m/Y') : '' }}</td>
                                <td>{{ $installment->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
