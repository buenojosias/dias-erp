<div>
    <x-slot name="header">
        <h2>{{ $action === 'edit' ? 'Editar' : 'Nova' }} obra</h2>
    </x-slot>
    <x-errors class="mb-5" />
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card">
        <form wire:submit.prevent="submit">
            <div class="card-body form grid-cols-5">
                <div>
                    <x-input wire:model.defer="contract_number" label="Contrato nº" />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="title" label="Título da obra" required />
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
                    <x-datetime-picker label="Data de início" wire:model.defer="start_date" without-time required />
                </div>
                <div>
                    <x-datetime-picker label="Prazo para conclusão" wire:model.defer="end_date" without-time />
                </div>
                <div>
                    <x-native-select label="Situação" wire:model.defer="status" required>
                        <option value="">Selecione</option>
                        <option value="Aguardando">Aguardando</option>
                        <option value="Em execução">Em execução</option>
                        <option value="Interrompida">Interrompida</option>
                        <option value="Concluída">Concluída</option>
                        <option value="Atrasada">Atrasada</option>
                    </x-native-select>
                </div>
                <div>
                    <x-inputs.currency label="Valor acordado" prefix="R$ " thousands="." decimal="," wire:model.defer="amount" required />
                </div>
                <div>
                    <x-input type="number" wire:model.defer="installments" label="Parcelas" min="1" required />
                </div>
                <div class="col-span-5">
                    <x-textarea wire:model.defer="note" label="Observações" />
                </div>
            </div>
            <div class="card-footer">
                <x-button primary type="submit" primary label="Salvar" />
            </div>
        </form>
    </div>
</div>
