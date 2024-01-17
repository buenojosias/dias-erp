<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }} / Compras</h2>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Compras realizadas</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
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
                                {{ $purchase->supplier->company_name }}
                            </td>
                            <td>R$ {{ $purchase->formated_amount }}</td>
                            <td>{{ $purchase->payment_method }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('purchases.edit', $purchase) }}" icon="pencil" sm flat />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
