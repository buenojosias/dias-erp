<div>
    <x-slot name="header">
        <h2>Cliente: {{ $client->company_name }}</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações do cliente</h3>
        </div>
        <div class="card-body display">
            <div>
                <h4>{{ $client->person_type === 'PF' ? 'CPF' : 'CNPJ' }}</h4>
                <h5>{{ $client->formated_document_number }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>{{ $client->person_type === 'PF' ? 'Nome' : 'Razão social' }}</h4>
                <h5>{{ $client->company_name }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>{{ $client->person_type === 'PJ' ? 'Nome fantasia' : '' }}</h4>
                <h5>{{ $client->fantasy_name }}</h5>
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
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Obras</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th class="text-left">Contrato</th>
                        <th class="text-left">Início</th>
                        <th class="text-left">Prazo</th>
                        <th class="text-left">Valor</th>
                        <th class="text-left">Status</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>
                                <a href="{{ route('services.show', $service) }}">{{ $service->contract_number }}</a>
                            </td>
                            <td>{{ $service->start_date->format('d/m/Y') }}</td>
                            <td>{{ $service->end_date->format('d/m/Y') }}</td>
                            <td>R$ {{ $service->formated_amount }}</td>
                            <td>{{ $service->status }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('services.edit', $service) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Orçamentos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Valor</th>
                        <th class="text-left">Status</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposals as $proposal)
                        <tr>
                            <td>
                                <a
                                    href="{{ route('proposals.show', $proposal) }}">{{ $proposal->date->format('d/m/Y') }}</a>
                            </td>
                            <td>R$ {{ $proposal->formated_amount }}</td>
                            <td>{{ $proposal->status }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('proposals.edit', $proposal) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
