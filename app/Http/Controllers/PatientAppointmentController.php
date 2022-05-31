<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PatientAppointmentController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $paymentStatus = getAllPaymentStatus();
        $paymentGateway = getPaymentGateway();

        return view('patients.appointments.index', compact('paymentStatus', 'paymentGateway'));
    }
}
