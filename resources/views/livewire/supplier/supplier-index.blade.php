<div>
    <x-slot name="header">
        <h2>Fornecedores</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('suppliers.create') }}" primary label="Novo fornecedor" />
    </div>
    <div class="card">
        <div class="card-header">
            FILTROS
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
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>
                                <a href="{{ route('suppliers.show', $supplier) }}">{{ $supplier->company_name }}</a>
                            </td>
                            <td>{{ $supplier->contact->whatsapp ?? $supplier->contact->phone }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('suppliers.edit', $supplier) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
