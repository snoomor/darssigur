<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LocationsUpdateRequest;

class LocationsUpdateController extends BaseController
{
    public function __invoke(LocationsUpdateRequest $request, $location_id)
    {
        $data = $request->validated();
        $this->service->locationUpdate($data, $location_id);
        $location = $this->service->locationInfo($location_id);
        session()->put('type', 'success');
        session()->flash('flashmessage', 'Изменения сохранены');
        if ($location[0]->PARENT_ID != 0) {
            return redirect()->route('locations.edit', $location[0]->PARENT_ID);
        } else {
            return redirect()->route('locations.create');
        }
    }
}
