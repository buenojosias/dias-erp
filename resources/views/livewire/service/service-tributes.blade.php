<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }} / Tributos</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    @if (session('error'))
        <x-alert label="{{ session('error') }}" flag="error" />
    @endif
    <div class="main-actions">
        <x-button wire:click="openTributeModal" label="Novo tributo" primary />
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tributos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left">Data</th>
                        <th class="text-left">Título</th>
                        <th class="text-left">Valor</th>
                        <th class="text-left">Parcelas</th>
                        <th class="relative py-3.5 px-4">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tributes as $tribute)
                        <tr>
                            <td>
                                <a
                                    href="{{ route('tributes.show', $tribute) }}">{{ $tribute->date->format('d/m/Y') }}</a>
                            </td>
                            <td> {{ $tribute->title->title }} </td>
                            <td>R$ {{ $tribute->formated_amount }}</td>
                            <td>{{ $tribute->installments_count }}</td>
                            <td width="1%">
                                <div class="actions">
                                    <button class="hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                    <button class="hover:text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($tributeModal)
        <x-modal wire:model.defer="tributeModal" max-width="sm">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lançar tributo</h3>
                </div>
                <x-errors class="mb-4" />
                <form wire:submit.prevent="submit">
                    <div class="card-body form grid-cols-2">
                        <div class="col-span-2">
                            <x-native-select label="Tributo" wire:model="form.title_id" required>
                                <option value="">Selecione</option>
                                @foreach ($titles as $title)
                                    <option value="{{ $title->id }}">{{ $title->title }} ({{ $title->type }})
                                    </option>
                                @endforeach
                            </x-native-select>
                        </div>
                        <div>
                            <x-datetime-picker label="Data de emissão" wire:model.defer="form.date" without-time
                                required />
                        </div>
                        <div>
                            <x-inputs.currency label="Valor" prefix="R$ " thousands="." decimal=","
                                wire:model.defer="form.amount" required />
                        </div>
                        <div>
                            <x-input type="number" label="Parcelas" wire:model.defer="form.installments_count" min="1" required />
                        </div>
                        <div class="col-span-2">
                            <x-textarea wire:model.defer="form.note" label="Observação" rows="2" />
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
