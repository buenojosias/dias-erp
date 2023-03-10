<div>
    <x-slot name="header">
        <h2>Clientes</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('clients.create') }}" primary label="Novo cliente" />
    </div>
    <div class="card">
        <div class="card-header">
            FILTROS
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Contato</th>
                        <th>Obras</th>
                        <th class="relative py-3.5 px-4" width="1%">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>
                                <a href="{{ route('clients.show', $client) }}">{{ $client->company_name }}</a>
                            </td>
                            <td>{{ $client->contact->whatsapp ?? $client->contact->phone }}</td>
                            <td class="text-center">{{ $client->services_count }}</td>
                            <td>
                                <div class="actions">
                                    <x-button href="{{ route('clients.edit', $client) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $clients->links() }}
        </div>
    </div>
</div>
