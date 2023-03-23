<div>
    <x-slot name="header">
        <h2>{{ $action === 'edit' ? 'Editar' : 'Novo' }} locador</h2>
    </x-slot>
    <x-errors class="mb-5" />
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card">
        <form wire:submit.prevent="submit">
            <div class="card-body form sm:grid-cols-5">
                <div class="col-span-2">
                    <x-input wire:model.defer="company_name" label="Razão social" required />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="fantasy_name" label="Nome fantasia" required />
                </div>
                <div class="col-span-2">
                    <x-inputs.maskable wire:model.defer="cnpj"
                        label="CNPJ"
                        mask="##.###.###/####-##" required />
                </div>
            </div>
            <div class="card-body form sm:grid-cols-6">
                <div class="col-span-3">
                    <x-input wire:model.defer="street_name" label="Endereço" required />
                </div>
                <div>
                    <x-input wire:model.defer="number" label="Número" required />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="complement" label="Complemento" />
                </div>
                <div>
                    <x-inputs.maskable wire:model.defer="zip_code" label="CEP" mask="#####-###"
                        emitFormatted="true" />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="district" label="Bairro" required />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="city" label="Cidade" required />
                </div>
                <div>
                    <x-input wire:model.defer="state" label="UF" maxlength="2" required />
                </div>
            </div>
            <div class="card-body form sm:grid-cols-4">
                <div class="col-span-2">
                    <x-inputs.maskable wire:model.defer="phone" label="Telefone"
                        mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                </div>
                <div class="col-span-2">
                    <x-inputs.maskable wire:model.defer="whatsapp" label="WhatsApp"
                        mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="representative" label="Representante" required />
                </div>
                <div class="col-span-2">
                    <x-input type="email" wire:model.defer="email" label="E-mail" />
                </div>
            </div>
            <div class="card-footer">
                <x-button primary type="submit" primary label="Salvar" />
            </div>
        </form>
    </div>
</div>
