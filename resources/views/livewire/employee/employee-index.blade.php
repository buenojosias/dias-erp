<div>
    <x-slot name="header">
        <h2>Funcionários</h2>
    </x-slot>
    <div class="main-actions">
        <x-button href="{{ route('employees.create') }}" primary label="Novo funcionário" />
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
                        <th class="text-left">Cargo</th>
                        <th class="text-left">Contato</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>
                                <a href="{{ route('employees.show', $employee) }}">{{ $employee->name }}</a>
                            </td>
                            <td>{{ $employee->role }}</td>
                            <td>{{ $employee->contact->whatsapp ?? $employee->contact->phone }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button href="{{ route('employees.edit', $employee) }}" flat icon="pencil" class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $employees->links() }}
        </div>
    </div>
</div>
