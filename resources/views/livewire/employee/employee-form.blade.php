<div>
    <x-slot name="header">
        <h2>{{ $action === 'edit' ? 'Editar' : 'Novo' }} funcionário</h2>
    </x-slot>
    <x-errors class="mb-5" />
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="card">
        <form wire:submit.prevent="submit">
            <div class="card-body form sm:grid-cols-4">
                <div class="sm:col-span-3">
                    <x-input wire:model.defer="name" label="Nome" required />
                </div>
                <div>
                    <x-input type="date" wire:model.defer="birthday" label="Data de nascimento" required />
                </div>
                <div>
                    <x-inputs.maskable wire:model.defer="cpf"
                        label="CPF"
                        mask="###.###.###-##" required />
                </div>
                <div>
                    <x-input wire:model.defer="rg" label="RG" />
                </div>
                <div class="col-span-2">
                    <x-input wire:model.defer="role" label="Profissão" required />
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
            <div class="card-body form sm:grid-cols-3">
                <div>
                    <x-inputs.maskable wire:model.defer="phone" label="Telefone"
                        mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                </div>
                <div>
                    <x-inputs.maskable wire:model.defer="whatsapp" label="WhatsApp"
                        mask="['(##) ####-####', '(##) #####-####']" emitFormatted="true" />
                </div>
                <div>
                    <x-input type="email" wire:model.defer="email" label="E-mail" />
                </div>
            </div>
            <div class="card-footer">
                <x-button primary type="submit" primary label="Salvar" />
            </div>
        </form>
    </div>
</div>
