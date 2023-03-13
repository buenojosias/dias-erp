<div>
    <x-slot name="header">
        <h2>Tributos</h2>
    </x-slot>
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Título</th>
                        <th class="text-left">Obra</th>
                        <th class="text-left">Cliente</th>
                        <th class="text-left">Valor</th>
                        <th class="text-left">Parcelas</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tributes as $tribute)
                        <tr>
                            <td>
                                <a href="{{ route('tributes.show', $tribute) }}">{{ $tribute->date->format('d/m/Y') }}</a>
                            </td>
                            <td>
                                <a href="{{ route('tributes.show', $tribute) }}">{{ $tribute->title->title }}</a>
                            </td>
                            <td>
                                <a href="{{ route('services.show', $tribute->service) }}">{{ $tribute->service->contract_number }}</a>
                            </td>
                            <td>
                                <a href="{{ route('clients.show', $tribute->service->client) }}">{{ $tribute->service->client->company_name }}</a>
                            </td>
                            <td>R$ {{ $tribute->formated_amount }}</td>
                            <td>{{ $tribute->installments_count }}</td>
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
            {{ $tributes->links() }}
        </div>
    </div>
</div>
