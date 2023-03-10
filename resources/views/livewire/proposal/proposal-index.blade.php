<div>
    <x-slot name="header">
        <h2>Orçamentos</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('proposals.create') }}" primary label="Novo orçamento" />
    </div>
    <div class="card">
        <div class="card-header">filtros</div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Cliente</th>
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
                                <a href="{{ route('proposals.show', $proposal) }}">{{ $proposal->date->format('d/m/Y') }}</a>
                            </td>
                            <td>
                                <a href="{{ route('clients.show', $proposal->client) }}">{{ $proposal->client->company_name }}</a>
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
        <div class="card-pagination">
            {{ $proposals->links() }}
        </div>
    </div>
</div>
