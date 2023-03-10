<div class="card">
    <form wire:submit.prevent="submit">
        <div class="card-header">
            <h3 class="card-title">Registrar pagamento</h3>
        </div>
        <div class="card-body form grid-cols-2">
            <div class="col-span-2">
                <x-native-select wire:model.defer="service_id" label="Obra/Cliente" required>
                    <option value="">Selecione</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->title }} ({{ $service->client->company_name }})
                        </option>
                    @endforeach
                </x-native-select>
            </div>
            <div>
                <x-datetime-picker label="Data" wire:model.defer="date" :max="now()" without-time required />
            </div>
            <div>
                <x-inputs.currency label="Valor" prefix="R$ " thousands="." decimal="," wire:model.defer="amount"
                    required />
            </div>
            <div class="col-span-2">
                <x-textarea wire:model.defer="note" rows="2" label="Observações" />
            </div>
        </div>
        <div class="card-footer">
            <x-button primary type="submit" primary label="Salvar" />
        </div>
    </form>
</div>
