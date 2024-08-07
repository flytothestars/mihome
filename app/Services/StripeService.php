<?php

namespace App\Services;

use App\Models\User;
use Stripe\PaymentIntent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\Payment;
use App\Models\Currency;
use App\Events\ChargeUser;
use App\Services\CardService;
use App\Services\ProjectService;
use App\Events\SavePaymentMethod;
use App\Events\RemovePaymentMethod;

class StripeService
{
    private $key;
    private $secret;
    private $user;

    public function __construct()
    {
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
        $this->user = Auth::user();
    }

    /**
     * Method to save a payment method to the current user.
     *
     * @param  string $stripe_id
     * @param  string $brand
     * @param  string $last_four
     * @param  ?string $name
     *
     * @return \App\Models\Card
     */
    public function savePaymentMethod(string $stripe_id, string $brand, string $last_four, string $name = null): Card
    {
        // save the card to database
        $CardService = new CardService();
        $Card = $CardService->saveCard($stripe_id, $brand, $last_four, $name);

        // create user as stripe user
        $this->user->createOrGetStripeCustomer();

        // save payment method to stripe
        $this->user->updateDefaultPaymentMethod($stripe_id);

        // dispatch event
        event(new SavePaymentMethod($Card));

        // return card
        return $Card;
    }

    /**
     * Remove given payment method from user.
     *
     * @param  string    $stripe_id
     *
     * @return \Illuminate\Support\Collection
     */
    public function removePaymentMethod(string $stripe_id): Collection
    {
        $CardService = new CardService();
        $Cards = $CardService->deleteCard($stripe_id);

        // delete payment method from stripe
        $this->user->removePaymentMethod($stripe_id);

        // dispatch event
        event(new RemovePaymentMethod($stripe_id));

        // return cards
        return $Cards;
    }

    /**
     * Charge the user for a given amount.
     *
     * @param  string $description
     * @param  int    $amount
     * @param  ?string $stripe_id
     *
     * @return \Stripe\PaymentIntent
     */
    public function charge(string $description, int $amount, string $stripe_id = null, string $currency = null): Payment
    {
        // if no payment method is given, we take the default one
        if (!$stripe_id) {
            $stripe_id = $this->user->defaultPaymentMethod()->id;
        }

        // set options
        $options = [
            'currency' => $currency ?? config('voyager-shop.currency', 'usd')
        ];

        // charge the user using Billable trait
        $PaymentIntent = $this->user->charge($amount, $stripe_id, $options)
            ->asStripePaymentIntent();

        // get current project
        $ProjectService = new ProjectService();
        $Project = $ProjectService->getCurrentProject();

        // get current user
        $User = Auth::user();

        // get currency
        $Currency = Currency::where('code', $options['currency'])->firstOrFail();

        // create payment
        $Payment = Payment::create([
            'amount' => $amount,
            'payment_method' => $PaymentIntent->payment_method_types[0] ?? null,
            'stripe_id' => $PaymentIntent->id,
            'state' => $PaymentIntent->status,
            'project_id' => $Project->id,
            'user_id' => $User->id ?? null,
            'currency_id' => $Currency->id,
        ]);

        // dispatch event
        event(new ChargeUser($this->user, $description, $PaymentIntent, $Payment));

        // return the payment intent
        return $Payment;
    }
}
