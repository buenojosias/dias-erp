<div>
    <x-slot name="header">
        <h2>Fornecedor: {{ $supplier->company_name }}</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações do fornecedor</h3>
        </div>
        <div class="card-body display">
            <div class="sm:col-span-3">
                <h4>Razão social</h4>
                <h5>{{ $supplier->company_name }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Nome fantasia</h4>
                <h5>{{ $supplier->fantasy_name }}</h5>
            </div>
            <div>
                <h4>CNPJ</h4>
                <h5>{{ $supplier->cnpj }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Endereço</h4>
                <h5>{{ $address->street_name }}, {{ $address->number }}</h5>
            </div>
            <div>
                <h4>Complemento</h4>
                <h5>{{ $address->complement }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Bairro</h4>
                <h5>{{ $address->district }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Cidade/UF</h4>
                <h5>{{ $address->city }}/{{ $address->state }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Representante</h4>
                <h5>{{ $contact->representative }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Telefone</h4>
                <h5>{{ $contact->phone }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>WhatsApp</h4>
                <h5>{{ $contact->whatsapp }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>E-mail</h4>
                <h5>{{ $contact->email }}</h5>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Compras</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Contrato</th>
                        <th class="text-left">Cliente</th>
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
