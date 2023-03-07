<div>
    <x-slot name="header">
        <h2>Obra: {{ $service->contract_number }}</h2>
    </x-slot>
    <div class="card mb-6">
        <div class="card-header">
            <h3 class="card-title">Informações da obra</h3>
        </div>
        <div class="card-body display">
            <div>
                <h4>Contrato nº</h4>
                <h5>{{ $service->contract_number }}</h5>
            </div>
            <div class="sm:col-span-3">
                <h4>Cliente</h4>
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
                <h5>{{ $service->amount / 100 }}</h5>
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
                    <div class="text-right">R$ {{ $service->amount / 100 }}</div>
                </li>
                <a href="#">
                    <div>Valores recebidos</div>
                    <div class="text-right">R$ {{ $receipts / 100 }}</div>
                </a>
                <li>
                    <div>Compras efetuadas</div>
                    <div class="text-right">R$ {{ $purchases / 100 }}</div>
                </li>
                <li>
                    <div>Pagamentos realizados</div>
                    <div class="text-right">R$ {{ $payments / 100 }}</div>
                </li>
                <li>
                    <div>Tributos</div>
                    <div class="text-right">R$ {{ $tributes / 100 }}</div>
                </li>
                <li class="font-semibold">
                    <div>Lucro líquido previsto</div>
                    <div class="text-right">R$ {{ $prevProfit / 100 }}</div>
                </li>
                <li class="font-semibold">
                    <div>Lucro líquido atual</div>
                    <div class="text-right {{ $realProfit < 0 ? 'text-red-600' : '' }}">R$ {{ $realProfit / 100 }}</div>
                </li>
            </ul>
        </div>
    </div>
</div>
