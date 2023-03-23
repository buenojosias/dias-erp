<div>
    <x-slot name="header">
        <h2>Compras</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('purchases.create') }}" primary label="Nova compra" />
    </div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Obra</th>
                        <th class="text-left">Cliente</th>
                        <th class="text-left">Fornecedor</th>
                        <th class="text-left">Valor</th>
                        <th class="text-left">Meio de pagamento</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>
                                <a href="{{ route('purchases.show', $purchase) }}">{{ $purchase->date->format('d/m/Y') }}</a>
                            </td>
                            <td>
                                <a href="{{ route('services.show', $purchase->service) }}">{{ $purchase->service->contract_number }}</a>
                            </td>
                            <td>
                                <a href="{{ route('clients.show', $purchase->service->client) }}">{{ $purchase->service->client->company_name }}</a>
                            </td>
                            <td>
                                {{ $purchase->supplier->company_name }}
                            </td>
                            <td>R$ {{ $purchase->formated_amount }}</td>
                            <td>{{ $purchase->payment_method }}</td>
                            <td width="1%">
                                <div class="actions">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $purchases->links() }}
        </div>
    </div>
</div>
