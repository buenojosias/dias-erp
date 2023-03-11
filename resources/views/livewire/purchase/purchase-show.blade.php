<div>
    <x-slot name="header">
        <h2>Detalhes da compra</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações da compra</h3>
        </div>
        <div class="card-body display">
            <div>
                <h4>Data</h4>
                <h5>{{ $purchase->date->format('d/m/Y') }}</h5>
            </div>
            <div class="sm:col-span-5">
                <h4>Obra</h4>
                <h5>{{ $service->title }} ({{ $service->contract_number }})</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Cliente</h4>
                <h5>{{ $service->client->company_name }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Fornecedor</h4>
                <h5>{{ $supplier->company_name }}</h5>
            </div>
            <div>
                <h4>Valor total</h4>
                <h5>R$ {{ $purchase->formated_amount }}</h5>
            </div>
            <div>
                <h4>Método de pagamento</h4>
                <h5>{{ $purchase->payment_method }}</h5>
            </div>
            @if ($purchase->payment_method === 'Parcelado')
                <div>
                    <h4>Parcelas</h4>
                    <h5>{{ $purchase->installments->count() }}</h5>
                </div>
            @endif
            <div class="sm:col-span-6">
                <h4>Produtos</h4>
                <p class="text-sm">{{ $purchase->products }}</p>
            </div>
            <div class="sm:col-span-6">
                <h4>Observações</h4>
                <p class="text-sm">{{ $purchase->note }}</p>
            </div>
        </div>
    </div>
    @if ($purchase->payment_method === 'Parcelado')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Parcelas</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead class="text-left">
                        <th>Vencimento</th>
                        <th>Valor</th>
                        <th>Data pagamento</th>
                        <th>Status</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($installments as $installment)
                            <tr>
                                <td>{{ $installment->expiration_date ? $installment->expiration_date->format('d/m/Y') : 'Não informado' }}
                                </td>
                                <td>R$ {{ $installment->formated_amount }}</td>
                                <td>{{ $installment->payment_date ? $installment->payment_date->format('d/m/Y') : '' }}
                                </td>
                                <td>{{ $installment->status }}</td>
                                <td width="1%">
                                    <div class="actions">
                                        <x-button wire:click="openInstallmentModal({{ $installment }})" flat
                                            icon="pencil" class="-my-2" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($installmentModal)
        <x-modal wire:model.defer="installmentModal" max-width="sm">
            <div class="card">
                <form wire:submit.prevent="submit">
                    <div class="card-header">
                        <h3 class="card-title">Editar parcela</h3>
                    </div>
                    <x-errors class="mb-4" />
                    <div class="card-body form grid-cols-2">
                        <div>
                            <x-input type="number" wire:model.defer="form.number" label="Número" readonly />
                        </div>
                        <div>
                            <x-inputs.currency label="Valor" prefix="R$ " thousands="." decimal=","
                                wire:model.defer="form.amount" required />
                        </div>
                        <div>
                            <x-datetime-picker label="Data de vencimento" wire:model.defer="form.expiration_date"
                                without-time required />
                        </div>
                        <div>
                            <x-native-select label="Status" wire:model="form.status" required>
                                <option value="Pendente">Pendente</option>
                                <option value="Paga">Paga</option>
                                <option value="Atrasada">Atrasada</option>
                            </x-native-select>
                        </div>
                        @if ($form['status'] === 'Paga')
                            <div>
                                <x-datetime-picker label="Data do pagamento" wire:model.defer="form.payment_date"
                                    :max="now()" without-time required />
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <x-button type="submit" label="Salvar" primary />
                    </div>
                </form>
            </div>
        </x-modal>
    @endif
</div>
