<?php

namespace App\Services;

use App\Events\DeleteCard;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Events\SaveCard;
use App\Models\User;
use App\Services\ProjectService;

class CardService
{
    /**
     * Method to validate card data.
     *
     * @param  array  $card
     *
     * @return void
     */
    private function validate(array $card): void
    {
        $Validator = Validator::make($card, config('voyager-shop.validation.cards'));

        if ($Validator->fails()) {
            dd($Validator->messages()->toArray());
            throw new \Exception("Card validation fails.", 1);
        }
    }

    /**
     * Method to save cards to the given user.
     *
     * @param string $string_id
     * @param string $brand
     * @param string $last_four
     * @param ?string $name
     *
     * @return \App\Models\Card
     */
    public function saveCard(string $stripe_id, string $brand, string $last_four, $name = null): Card
    {
        $User = User::find(Auth::id());

        // get current project
        $ProjectService = new ProjectService();
        $Project = $ProjectService->getCurrentProject();

        // create default name
        if (!$name) {
            $name = $User->name . ' ' . $brand;
        }

        // validate card
        $this->validate([
            'name' => $name,
            'brand' => $brand,
            'last_four' => $last_four,
            'stripe_id' => $stripe_id
        ]);

        // update or create card model
        $Card = $User->cards()->updateOrCreate([
            'stripe_id' => $stripe_id
        ], [
            'name' => $name,
            'brand' => $brand,
            'last_four' => $last_four,
            'project_id' => $Project->id,
        ]);

        // fire event
        event(new SaveCard($Card));

        // return card
        return $Card;
    }

    /**
     * Method to get all cards of the given user.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserCards(): Collection
    {
        return Auth::user()->cards;
    }

    /**
     * Remove the delete card by stripe_id.
     *
     * @param  string    $stripe_id
     *
     * @return \Illuminate\Support\Collection
     */
    public function deleteCard(string $stripe_id): Collection
    {
        // get current user
        $User = User::find(Auth::id());

        // get ccard
        $Card = $User->cards()
            ->where('stripe_id', $stripe_id)
            ->firstOrFail();

        // fire event
        event(new DeleteCard($Card));

        // delete ccard
        $Card->delete();

        // return list of current cards
        return $User->cards;
    }
}
