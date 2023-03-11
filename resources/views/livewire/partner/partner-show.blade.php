<div>
    <x-slot name="header">
        <h2>Prestador de serviços: {{ $partner->company_name }}</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    <div class="main-actions">
        <x-button wire:click="openPaymentModal" label="Registrar pagamento" primary />
    </div>
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações do prestador de serviços</h3>
        </div>
        <div class="card-body display">
            <div class="sm:col-span-3">
                <h4>{{ $partner->person_type === 'PF' ? 'Nome' : 'Razão social' }}</h4>
                <h5>{{ $partner->company_name }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>{{ $partner->person_type === 'PJ' ? 'Nome fantasia' : '' }}</h4>
                <h5>{{ $partner->fantasy_name }}</h5>
            </div>
            <div>
                <h4>{{ $partner->person_type === 'PF' ? 'CPF' : 'CNPJ' }}</h4>
                <h5>{{ $partner->document_number }}</h5>
            </div>
            <div class="sm:col-span-3">
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
            @if ($partner->person_type === 'PJ')
                <div class="sm:col-span-3">
                    <h4>Representante</h4>
                    <h5>{{ $contact->representative }}</h5>
                </div>
            @endif
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
            <h3 class="card-title">Pagamentos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Obra</th>
                        <th class="text-left">Cliente</th>
                        <th class="text-left">Valor</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>
                                {{ $payment->date->format('d/m/Y') }}
                                {{-- <a href="{{ route('payments.show', $payment) }}">{{ $payment->date->format('d/m/Y') }}</a> --}}
                            </td>
                            <td>
                                <a
                                    href="{{ route('services.show', $payment->service) }}">{{ $payment->service->contract_number }}</a>
                            </td>
                            <td>
                                <a
                                    href="{{ route('clients.show', $payment->service->client) }}">{{ $payment->service->client->company_name }}</a>
                            </td>
                            <td>R$ {{ $payment->formated_amount }}</td>
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
            {{ $payments->links() }}
        </div>
    </div>
    @if ($paymentModal)
        <x-modal wire:model.defer="paymentModal">
            @livewire('payment.payment-form', ['model' => $partner])
        </x-modal>
    @endif
</div>
