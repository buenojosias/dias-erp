<div class="max-w-2xl mx-auto">
    <x-slot name="header">
        <h2>{{ $action === 'edit' ? 'Editar' : 'Novo' }} tributo</h2>
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
                <div class="col-span-2 flex justify-between items-end gap-2">
                    <div class="flex-1">
                        <x-native-select label="Título" wire:model.defer="title_id" required>
                            <option value="">Selecione</option>
                            @foreach ($titles as $title)
                                <option value="{{ $title->id }}">{{ $title->title }} ({{ $title->type }})</option>
                            @endforeach
                        </x-native-select>
                    </div>
                    <div class="pb-1">
                        <x-button wire:click="openTitleModal" icon="plus" />
                    </div>
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
                    <x-input type="number" wire:model.defer="installments_count" label="Parcelas" min="1"
                        required />
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
    @if ($titleModal)
        <x-modal wire:model.defer="titleModal" max-width="md">
            <div class="card w-full">
                <div class="card-header">
                    <h3 class="card-title">Adicionar título</h3>
                </div>
                <x-errors class="mb-4" />
                <form wire:submit.prevent="submitTitle">
                    <div class="card-body form">
                        <div>
                            <x-input label="Título" wire:model.defer="tform.title" min="1" required />
                        </div>
                        <div>
                            <x-native-select label="Tributo" wire:model="tform.type" required>
                                <option value="">Tipo</option>
                                <option value="Municipal">Municipal</option>
                                <option value="Estadual">Estadual</option>
                                <option value="Federal">Federal</option>
                                <option value="Sindical">Sindical</option>
                                <option value="Outro">Outro</option>
                            </x-native-select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-button type="submit" label="Salvar" primary />
                    </div>
                </form>
            </div>
        </x-modal>
    @endif
</div>
