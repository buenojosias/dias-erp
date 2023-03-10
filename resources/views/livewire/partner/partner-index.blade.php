<div>
    <x-slot name="header">
        <h2>Prestadores de serviços</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('partners.create') }}" primary label="Novo prestador" />
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
                        <th class="text-left">Tipo</th>
                        <th class="text-left">Contato</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($partners as $partner)
                        <tr>
                            <td>
                                <a href="{{ route('partners.show', $partner) }}">{{ $partner->company_name }}</a>
                            </td>
                            <td>{{ $partner->person_type === 'PF' ? 'Pessoa Física' : 'Pessoa Jurídica' }}</td>
                            <td>{{ $partner->contact->whatsapp ?? $partner->contact->phone }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('partners.edit', $partner) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $partners->links() }}
        </div>
    </div>
</div>
