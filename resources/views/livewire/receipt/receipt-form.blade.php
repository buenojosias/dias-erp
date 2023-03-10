<div class="card">
    <form wire:submit.prevent="submit">
        <div class="card-header">
            <h3 class="card-title">Registrar recebimento</h3>
        </div>
        <div class="card-body form grid-cols-2">
            <div>
                <x-datetime-picker label="Data" wire:model.defer="date" :max="now()" without-time required />
            </div>
            <div>
                <x-inputs.currency label="Valor" prefix="R$ " thousands="." decimal="," wire:model.defer="amount" required />
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
