<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\FooterAdv;
use App\Models\FooterInfo;
use App\Models\Offer;
use App\Models\Order;
use App\Models\PropertyValue;
use App\Observers\CategoryObserver;
use App\Observers\FeedbackObserver;
use App\Observers\FooterAdvObserver;
use App\Observers\FooterInfoObserver;
use App\Observers\OfferObserver;
use App\Observers\OrderObserver;
use App\Observers\PropertyValueObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class => [
            'SocialiteProviders\\Mailru\\MailruExtendSocialite@handle',
            'SocialiteProviders\\Apple\\AppleExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        PropertyValue::observe(PropertyValueObserver::class);
        FooterInfo::observe(FooterInfoObserver::class);
        FooterAdv::observe(FooterAdvObserver::class);
        Category::observe(CategoryObserver::class);
        Order::observe(OrderObserver::class);
        Feedback::observe(FeedbackObserver::class);
        Offer::observe(OfferObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
