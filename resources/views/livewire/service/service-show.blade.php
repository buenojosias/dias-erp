<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }}</h2>
    </x-slot>
    @if (session('success'))
        <x-alert label="{{ session('success') }}" flag="success" />
    @endif
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Informações da obra</h3>
        </div>
        <div class="card-body display">
            <div>
                <h4>Contrato nº</h4>
                <h5>{{ $service->contract_number }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Título</h4>
                <h5>{{ $service->title }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Cliente</h4>
                <h5>{{ $service->client->company_name }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Data de início</h4>
                <h5>{{ $service->start_date->format('d/m/Y') }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Prazo para conclusão</h4>
                <h5>{{ $service->end_date->format('d/m/Y') }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Situação</h4>
                <h5>{{ $service->status }}</h5>
            </div>
            <div class="sm:col-span-2">
                <h4>Valor acordado</h4>
                <h5>R$ {{ $service->formated_amount }}</h5>
            </div>
            <div>
                <h4>Parcelas</h4>
                <h5>{{ $service->installments }}</h5>
            </div>
            <div class="sm:col-span-6">
                <h4>Observações</h4>
                <p class="text-sm">{{ $service->note }}</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Resumo financeiro</h3>
        </div>
        <div class="card-list">
            <ul>
                <li>
                    <div>Valor contratado</div>
                    <div class="text-right">R$ {{ $service->formated_amount }}</div>
                </li>
                <a href="{{ route('services.purchases', $service) }}">
                    <div>Compras efetuadas</div>
                    <div class="text-right">R$ {{ number_format($purchases/100,2,",",".") }}</div>
                </a>
                <a href="{{ route('services.rents', $service) }}">
                    <div>Locações</div>
                    <div class="text-right">R$ {{ number_format($rents/100,2,",",".") }}</div>
                </a>
                <a href="{{ route('services.payments', $service) }}">
                    <div>Pagamentos realizados</div>
                    <div class="text-right">R$ {{ number_format($payments/100,2,",",".") }}</div>
                </a>
                <a href="{{ route('services.tributes', $service) }}">
                    <div>Tributos</div>
                    <div class="text-right">R$ {{ number_format($tributes/100,2,",",".") }}</div>
                </a>
                <li class="font-semibold">
                    <div>Total de despesas</div>
                    <div class="text-right">R$ {{ number_format($expenses/100,2,",",".") }}</div>
                </li>
                <a href="{{ route('services.receipts', $service) }}" class="font-semibold">
                    <div>Valores recebidos</div>
                    <div class="text-right">R$ {{ number_format($receipts/100,2,",",".") }}</div>
                </a>
                <li>
                    <div>Lucro líquido previsto</div>
                    <div class="text-right">R$ {{ number_format($prevProfit/100,2,",",".") }}</div>
                </li>
                <li class="font-semibold">
                    <div>Lucro líquido atual</div>
                    <div class="text-right {{ $realProfit < 0 ? 'text-red-600' : '' }}">R$ {{ number_format($realProfit/100,2,",",".") }}</div>
                </li>
            </ul>
        </div>
    </div>
</div>
