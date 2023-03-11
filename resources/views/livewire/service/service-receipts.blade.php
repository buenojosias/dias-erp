<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }} / Recebimentos</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    <div class="main-actions">
        <x-button wire:click="openReceiptModal" label="Registrar recebimento" primary />
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Valores recebidos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Valor</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                        <tr>
                            <td>{{ $receipt->date->format('d/m/Y') }}</td>
                            <td>R$ {{ $receipt->formated_amount }}</td>
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
    @if ($receiptModal)
        <x-modal wire:model.defer="receiptModal">
            @livewire('receipt.receipt-form', ['service' => $service])
        </x-modal>
    @endif
</div>
