<div>
    <x-slot name="header">
        <h2>Obras</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('services.create') }}" primary label="Nova obra" />
    </div>
    <div class="card">
        <div class="card-header">
            FILTROS
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Contrato</th>
                        <th class="text-left">Cliente</th>
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
                            <td>
                                <a href="{{ route('clients.show', $service->client) }}">{{ $service->client->company_name }}</a>
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
        <div class="card-pagination">
            {{ $services->links() }}
        </div>
    </div>
</div>
