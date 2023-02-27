<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\LocationsStoreRequest;

class LocationsStoreController extends BaseController
{
    public function __invoke(LocationsStoreRequest $request, $parent_loc)
    {
        $data = $request->validated();
        $data['parent_loc'] = $parent_loc;
        $this->service->locationsStore($data);
        session()->put('type', 'success');
        session()->flash('flashmessage', 'Локация добавлена!');
        if ($parent_loc != 0) {
            return redirect()->route('locations.edit', $parent_loc);
        } else {
            return redirect()->route('locations.create');
        }
        
    }
}

