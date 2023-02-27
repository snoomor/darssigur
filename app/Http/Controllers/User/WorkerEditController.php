<?php


namespace App\Http\Controllers\User;

class WorkerEditController extends BaseController
{
    public function __invoke($worker_id)
    {
        $worker = $this->service->objectInfo($worker_id);
        $worker = $worker[0];
        $photo = '';
        if ($this->service->ifPhoto($worker_id)) {
            $photo = $this->service->workerGetPhoto($worker_id);
            $photo = $photo[0];
        }
        return view('user.worker_edit', compact('worker', 'photo'));
    }
}
