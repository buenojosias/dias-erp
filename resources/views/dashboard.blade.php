<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="px-2 sm:px-0">
        <div class="infobox-wrapper">
            <div class="infobox">
                <div class="inner">
                    <p>Obras em execução</p>
                    <h3>{{ $services->where('end_date', '>=', date('Y-m-d'))->count() }}</h3>
                </div>
            </div>

            <div class="infobox">
                <div class="inner">
                    <p>Parcelas vencidas</p>
                    <h3>{{ $expiredInstallments->count() }}</h3>
                </div>
            </div>

            <div class="infobox">
                <div class="inner">
                    <p>Parcelas vencendo hoje</p>
                    <h3>{{ $expiringInstallments }}</h3>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Orçamentos pendentes
                </h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @foreach ($proposals as $proposal)
                            <tr>
                                <td>
                                    <a href="{{ route('proposals.show', $proposal) }}">{{ $proposal->date->format('d/m/Y') }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('clients.show', $proposal->client) }}">{{ $proposal->client->company_name }}</a>
                                </td>
                                <td>R$ {{ $proposal->formated_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
