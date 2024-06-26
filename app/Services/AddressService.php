<?php

/*
|--------------------------------------------------------------------------
| AddressService
|--------------------------------------------------------------------------
|
| Service to handle all sorts of operations on the address.
|
*/

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;
use App\Services\ProjectService;
use App\Events\UpdateOrCreateAddress;
use App\GraphQL\Mutations\DeleteAddress;

class AddressService
{
    /**
     * Validate a given address.
     *
     * @param  array  $address
     *
     * @return bool
     */
    public function validate(array $address): bool
    {
        $validator = Validator::make($address, config('voyager-shop.validation.address'));

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    /**
     * Update or create an address.
     *
     * @param  array  $address
     *
     * @return \App\Models\Address
     */
    public function updateOrCreate(array $address): Address
    {
        // validate address
        if (!$this->validate($address)) {
            throw new \Exception("Address Validation Error", 1);
        }

        // get current user
        $User = Auth::user();

        // get current project
        $ProjectService = new ProjectService();
        $Project = $ProjectService->getCurrentProject();

        // trigger event
        event(new UpdateOrCreateAddress($User, $Project, $address));

        // update address if we have an id
        if (isset($address['id'])) {
            $Address = Address::findOrFail($address['id']);
            $Address->update([
                'name' => $address['name'],
                'street' => $address['street'],
                'zip' => $address['zip'],
                config('voyager-shop.foreign_keys.user') => $User->id,
                config('voyager-shop.foreign_keys.project') => $Project->id,
            ]);
            return $Address;
        }

        // create address
        return Address::create([
            'name' => $address['name'],
            'street' => $address['street'],
            'zip' => $address['zip'],
            config('voyager-shop.foreign_keys.user') => $User->id,
            config('voyager-shop.foreign_keys.project') => $Project->id,
        ]);
    }

    /**
     * Method to delete an address from the user profile.
     * @param  int    $id
     * @return \Illuminate\Support\Collection
     */
    public function deleteAddress(int $id): Collection
    {
        // get the user
        $User = Auth::user();

        // throw error when user is not authenticated
        if (!$User) {
            throw new \Exception("Unauthenticated.", 1);
        }

        // get address to delete
        $Address = $User->addresses()->findOrFail($id);

        // fire event
        event(new DeleteAddress($Address));

        // delete address
        $Address->delete();

        // return the current list of addresses
        return $User->addresses;
    }
}
