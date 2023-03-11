<div class="max-w-2xl mx-auto">
    <x-slot name="header">
        <h2>{{ $action === 'edit' ? 'Editar' : 'Nova' }} compra</h2>
    </x-slot>
    <x-errors class="mb-5" />
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card">
        <form wire:submit.prevent="submit">
            <div class="card-body form grid-cols-3">
                <div>
                    <x-datetime-picker label="Data" wire:model.defer="date" :max="now()" without-time required />
                </div>
                <div class="col-span-2">
                    <x-native-select label="Fornecedor" wire:model.defer="supplier_id" required>
                        <option value="">Selecione</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->fantasy_name }}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div class="col-span-3">
                    <x-native-select label="Obra" wire:model.defer="service_id" required>
                        <option value="">Selecione</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->title }}
                                ({{ $service->client->fantasy_name ?? $service->client->company_name }})
                            </option>
                        @endforeach
                    </x-native-select>
                </div>
                <div>
                    <x-inputs.currency label="Valor total" prefix="R$ " thousands="." decimal=","
                        wire:model.defer="amount" required />
                </div>
                <div>
                    <x-native-select label="Método de pagamento" wire:model="payment_method" required>
                        <option value="">Selecione</option>
                        <option value="À vista">À vista</option>
                        <option value="Parcelado">Parcelado</option>
                    </x-native-select>
                </div>
                @if ($payment_method == 'Parcelado')
                    <div>
                        <x-input type="number" wire:model.defer="installments_count" label="Parcelas" min="1" />
                    </div>
                @endif
                <div class="col-span-3">
                    <x-textarea wire:model.defer="products" label="Produtos" />
                </div>
                <div class="col-span-3">
                    <x-textarea wire:model.defer="note" label="Observações" rows="2" />
                </div>
            </div>
            <div class="card-footer">
                <x-button primary type="submit" primary label="Salvar" />
            </div>
        </form>
    </div>
</div>
