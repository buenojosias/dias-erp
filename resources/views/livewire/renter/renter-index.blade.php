<div>
    <x-slot name="header">
        <h2>Locadores</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('renters.create') }}" primary label="Novo locador" />
    </div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Empresa</th>
                        <th class="text-left">Contato</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($renters as $renter)
                        <tr>
                            <td>
                                <a href="{{ route('renters.show', $renter) }}">{{ $renter->company_name }}</a>
                            </td>
                            <td>{{ $renter->contact->whatsapp ?? $renter->contact->phone }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('renters.edit', $renter) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $renters->links() }}
        </div>
    </div>
</div>
