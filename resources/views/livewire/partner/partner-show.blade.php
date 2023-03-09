<div>
    <x-slot name="header">
        <h2>Prestador de serviços: {{ $partner->company_name }}</h2>
    </x-slot>
    <div class="main-actions">
        <x-primary-button>Novo pagamento</x-primary-button>
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
                                <a href="#">{{ $payment->date->format('d/m/Y') }}</a>
                                {{-- <a href="{{ route('payments.show', $payment) }}">{{ $payment->date->format('d/m/Y') }}</a> --}}
                            </td>
                            <td>
                                <a href="{{ route('services.show', $payment->service) }}">{{ $payment->service->contract_number }}</a>
                            </td>
                            <td>
                                <a href="{{ route('clients.show', $payment->service->client) }}">{{ $payment->service->client->company_name }}</a>
                            </td>
                            <td>R$ {{ $payment->formated_amount }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <button class="hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                    <button class="hover:text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
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
</div>
