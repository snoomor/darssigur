<?php


namespace App\Http\Controllers\User;

use App\Http\Requests\User\WorkerStoreRequest;
use Illuminate\Support\Facades\File;
use App\Actions\PhotoCompressionAction;

class WorkerStoreController extends BaseController
{
    public function __invoke(WorkerStoreRequest $request, PhotoCompressionAction $action)
    {
        $data = $request->validated();
        $data['parent_loc'] = session('guest_loc_id');
        $new_id = $this->service->workerStore($data);
        $data['new_id'] = $new_id;
        $this->service->workerCodeStore($data);
        $this->service->workerAddRule($data);
        if (isset($data['image'])) {
            $data = $action->handle($data['new_id'], $data);

            if (isset($data['compression_error'])) {
                session()->put('type', 'warning');
                session()->flash('flashmessage', 'Произошла ошибка при загрузке фото. Загрузите другое фото или уменьшите размер этого фото до 350КБ.');
                return redirect()->route('worker.edit', $data['new_id']);
            } 
            $this->service->workerPhoto($data);
            File::delete('storage/uploads/' . session('guest_loc_id') . $data['new_id'] . '.jpg');
        }

        session()->put('type', 'success');
        session()->flash('flashmessage', 'Профиль успешно создан!');
        return redirect()->route('worker.create');
    }
}
