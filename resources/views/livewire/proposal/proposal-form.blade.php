<div>
    <x-slot name="header">
        <h2>{{ $action === 'edit' ? 'Editar' : 'Novo' }} orçamento</h2>
    </x-slot>
    <x-errors class="mb-5" />
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card">
        <form wire:submit.prevent="submit">
            <div class="card-body form grid-cols-3">
                <div>
                    <x-datetime-picker label="Data" wire:model.defer="date" without-time required />
                </div>
                <div class="col-span-2">
                    <x-native-select label="Cliente" wire:model.defer="client_id" required>
                        <option value="">Selecione</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div>
                    <x-inputs.currency label="Valor" prefix="R$ " thousands="." decimal="," wire:model.defer="amount" required />
                </div>
                <div>
                    <x-native-select label="Status" wire:model.defer="status" required>
                        <option value="">Selecione</option>
                        <option value="Aguardando">Aguardando</option>
                        <option value="Em negociação">Em negociação</option>
                        <option value="Aceito">Aceito</option>
                        <option value="Recusado">Recusado</option>
                    </x-native-select>
                </div>
                <div class="col-span-3">
                    <x-textarea wire:model.defer="note" label="Observações" />
                </div>
            </div>
            <div class="card-footer">
                <x-button primary type="submit" primary label="Salvar" />
            </div>
        </form>
    </div>
</div>
