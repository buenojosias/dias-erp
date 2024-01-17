<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }} / Pagamentos</h2>
    </x-slot>
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">Compras realizadas</h3>
        </div> --}}
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Recebedor</th>
                        <th class="text-left">Vínculo</th>
                        <th class="text-left">Valor</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>
                                <a href="#">{{ $payment->date->format('d/m/Y') }}</a>
                            </td>
                            <td>
                                @if ($payment->paymentable_type === 'App\Models\Employee')
                                    <a href="{{ route('employees.show', $payment->paymentable) }}">
                                @else
                                    <a href="{{ route('partners.show', $payment->paymentable) }}">
                                @endif
                                {{ $payment->paymentable->company_name ?? $payment->paymentable->name }}
                                </a>
                            </td>
                            <td>
                                {{ $payment->paymentable_type === 'App\Models\Employee' ? 'Funcionário(a)' : 'Prestador de serviços' }}
                            </td>
                            <td>R$ {{ $payment->formated_amount }}</td>
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
