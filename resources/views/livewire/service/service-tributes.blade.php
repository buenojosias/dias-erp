<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }} / Tributos</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tributos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Título</th>
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
                            <td> {{ $tribute->title->title }} </td>
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
    </div>
</div>
