<div>
    <x-slot name="header">
        <h2>Parcelas pendentes</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead class="text-left">
                    <th>Vencimento</th>
                    <th>Compra</th>
                    <th>Obra</th>
                    <th>Valor</th>
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
                            <td>
                                <a href="{{ route('purchases.show', $installment->purchase) }}">
                                    {{ $installment->purchase->id }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('services.show', $installment->purchase->service) }}">
                                    {{ $installment->purchase->service->contract_number }}
                                </a>
                            </td>
                            <td>R$ {{ $installment->formated_amount }}</td>
                            <td>
                                @if ($installment->status === 'Atrasada')
                                    <x-badge negative outline label="{{ $installment->status }}" />
                                @elseif ($installment->status === 'Pendente')
                                    <x-badge secondary outline label="{{ $installment->status }}" />
                                @endif
                            </td>
                            <td width="1%">
                                <div class="actions">
                                    <x-button wire:click="openInstallmentModal({{ $installment }})" flat icon="pencil"
                                        class="-my-2" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-pagination">
            {{ $installments->links() }}
        </div>
    </div>
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
