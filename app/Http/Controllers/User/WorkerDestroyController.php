<?php


namespace App\Http\Controllers\User;

class WorkerDestroyController extends BaseController
{
    public function __invoke($worker)
    {
        $this->service->workerDestroy($worker);
        session()->put('type', 'success');
        session()->flash('flashmessage', 'Профиль удален');
        return redirect()->route('worker.create');
    }
}
