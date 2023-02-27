<?php


namespace App\Http\Controllers\Admin;

class LocationsDestroyController extends BaseController
{
    public function __invoke($location_id)
    {
        $data = $this->service->locationEdit($location_id);
        if (sizeof($data['groupings']) != 0) {
            foreach($data['groupings'] as $group){
                $this->service->locationDestroy($group->ID);
            }
        }
        $this->service->locationDestroy($location_id);
        session()->put('type', 'success');
        session()->flash('flashmessage', 'Объект удален');
        if ($data['location'][0]->PARENT_ID != 0) {
            return redirect()->route('locations.edit', $data['location'][0]->PARENT_ID);
        } else {
            return redirect()->route('locations.create');
        }
    }
}
