<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Proposal;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $services = Service::where('status', 'Em execução')->get();
        $delayingServices = $services->where('end_date', '<', date('Y-m-d'));
        $proposals = Proposal::where('status', 'Aguardando')->get();

        $expiringInstallments = Installment::where('status', 'Pendente')->whereDate('expiration_date', date('Y-m-d'))->count();
        $expiredInstallments = Installment::whereIn('status', ['Pendente','Atrasada'])->whereDate('expiration_date', '<', date('Y-m-d'))->get();
        $delayingInstallments = $expiredInstallments->where('status', 'Pendente')->where('expiration_date', '<', date('Y-m-d'));

        foreach ($delayingInstallments as $di) {
            $di->update(['status' => 'Atrasada']);
        }
        foreach ($delayingServices as $ds) {
            $ds->update(['status' => 'Atrasada']);
        }

        // dd($expiredInstallments->toArray());
        return view('dashboard', compact(['services', 'expiringInstallments', 'expiredInstallments', 'proposals']));
    }
}
