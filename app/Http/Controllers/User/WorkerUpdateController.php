<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\WorkerUpdateRequest;
use Illuminate\Support\Facades\File;
use App\Actions\PhotoCompressionAction;

class WorkerUpdateController extends BaseController
{
    public function __invoke(WorkerUpdateRequest $request, PhotoCompressionAction $action, $worker_id)
    {
        $data = $request->validated();
        $data = $action->handle($worker_id, $data);

        if (isset($data['compression_error'])) {
            session()->put('type', 'warning');
            session()->flash('flashmessage', 'Произошла ошибка при загрузке фото. Загрузите другое фото или уменьшите размер этого фото до 350КБ.');
            return redirect()->route('worker.edit', $worker_id);
        }

        $this->service->workerUpdate($worker_id, $data);

        if (isset($data['image'])) {
            if ($this->service->ifPhoto($worker_id)) {
                $this->service->photoUpdate($worker_id, $data);
            } else {
                $data['new_id'] = $worker_id;
                $this->service->workerPhoto($data);
            }
        }

        if (isset($data['image'])) {
            File::delete('storage/uploads/' . session('guest_loc_id') . $worker_id . '.jpg');
        }

        session()->put('type', 'success');
        session()->flash('flashmessage', 'Изменения сохранены');

        return redirect()->route('worker.create');
    }
}
