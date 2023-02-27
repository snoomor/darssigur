<?php


namespace App\Http\Controllers\User;

class WorkerCreateController extends BaseController
{
    public function __invoke()
    {
        $data = [];
        $location_id = auth()->user()->locations;
        $location = $this->service->objectInfo($location_id);
        $workers_array[] = $this->service->userInfo($location_id);
        $location = $location[0];

        foreach ($workers_array as $workers) {
            foreach ($workers as $worker) {
                $data[] = $worker;
            }
        }
        return view('user.worker_create', compact('data', 'location'));
    }
}