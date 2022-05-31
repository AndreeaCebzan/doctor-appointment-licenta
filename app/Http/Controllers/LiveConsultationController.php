<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\LiveConsultationRequest;
use App\Models\Doctor;
use App\Models\LiveConsultation;
use App\Models\Patient;
use App\Models\User;
use App\DataTables\LiveConsultationDataTable;
use App\Repositories\LiveConsultationRepository;
use App\Repositories\ZoomRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LiveConsultationController extends AppBaseController
{
    /** @var LiveConsultationRepository */
    private $liveConsultationRepository;

    /**
     * LiveConsultationController constructor.
     * @param  LiveConsultationRepository  $liveConsultationRepository
     */
    public function __construct(
        LiveConsultationRepository $liveConsultationRepository
    ) {
        $this->liveConsultationRepository = $liveConsultationRepository;
    }

    /**
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $doctors = Doctor::with('user')->get()->where('user.status', '=', User::ACTIVE)->pluck('user.full_name',
            'id')->sort();
        $patients = Patient::with('user')->get()->where('user.status', '=', User::ACTIVE)->pluck('user.full_name',
            'id')->sort();
        $type = LiveConsultation::STATUS_TYPE;
        $status = LiveConsultation::status;

        return view('live_consultations.index', compact('doctors', 'patients', 'type', 'status'));
    }

    /**
     * @param  LiveConsultationRequest  $request
     *
     *
     * @return JsonResponse
     */
    public function store(LiveConsultationRequest $request)
    {
        try {
            $this->liveConsultationRepository->store($request->all());

            $this->liveConsultationRepository->createNotification($request->all());

            return $this->sendSuccess('Live Consultation saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     *
     *
     * @return JsonResponse
     */
    public function show(LiveConsultation $liveConsultation)
    {
        $data['liveConsultation'] = LiveConsultation::with([
            'user', 'patient.user', 'doctor.user',
        ])->find($liveConsultation->id);

        return $this->sendResponse($data, 'Live Consultation retrieved successfully.');
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     *
     *
     * @return JsonResponse
     */
    public function edit(LiveConsultation $liveConsultation)
    {
        return $this->sendResponse($liveConsultation, 'Live Consultation retrieved successfully.');
    }

    /**
     * @param  LiveConsultationRequest  $request
     * @param  LiveConsultation  $liveConsultation
     *
     *
     * @return JsonResponse
     */
    public function update(LiveConsultationRequest $request, LiveConsultation $liveConsultation)
    {
        try {
            $this->liveConsultationRepository->edit($request->all(), $liveConsultation);

            return $this->sendSuccess('Live Consultation updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     *
     *
     * @return JsonResponse
     */
    public function destroy(LiveConsultation $liveConsultation)
    {
        try {
            $liveConsultation->delete();

            return $this->sendSuccess('Live Consultation deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  Request  $request
     *
     *
     * @return JsonResponse
     */
    public function getChangeStatus(Request $request)
    {
        $liveConsultation = LiveConsultation::findOrFail($request->get('id'));
        $status = null;

        if ($request->get('statusId') == LiveConsultation::STATUS_AWAITED) {
            $status = LiveConsultation::STATUS_AWAITED;
        } elseif ($request->get('statusId') == LiveConsultation::STATUS_CANCELLED) {
            $status = LiveConsultation::STATUS_CANCELLED;
        } else {
            $status = LiveConsultation::STATUS_FINISHED;
        }

        $liveConsultation->update([
            'status' => $status,
        ]);

        return $this->sendsuccess('Status changed successfully.');
    }

    public function getLiveStatus(LiveConsultation $liveConsultation)
    {
        $data['liveConsultation'] = LiveConsultation::with('user')->find($liveConsultation->id);
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveConsultation->created_by]);

        $data['zoomLiveData'] = $zoomRepo->get($liveConsultation->meeting_id,
            ['meeting_owner' => $liveConsultation->created_by]);

        return $this->sendResponse($data, 'Live Status retrieved successfully.');
    }
}
