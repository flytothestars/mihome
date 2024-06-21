<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\CartItem;
use App\Models\City;
use App\Models\Coupon;
use App\Models\DeliveryMethod;
use App\Models\Order as ModelsOrder;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use App\Jobs\SendMailClientJob;
use App\Jobs\SendMailAdminJob;

#[On('refresh-the-order')]
class Order extends Component
{
    public $step = 1;
    public $name = '';
    public $lastname = '';
    public $email = '';
    public $phone = '';
    public $city_id = 1;
    public $address = '';
    public $coupon = '';
    public $couponSum = 0;
    public $appliedCoupon = null;
    public $discount = 0;
    public $total = 0;
    public $delivery_method_id = 0;
    public $payment_method_id = 0;
    public $deliveryMethodAddress = false;
    public $deliveryMethod = null;
    public $paymentMethod = null;
    public $cart = null;
    public $order = null;

    protected $rules = [
        'name' => 'required|min:2',
        'lastname' => 'min:2',
        'email' => 'email',
        'phone' => 'required|regex:/^\+7 \([0-9]{3}\)\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$/i',
    ];

    public function __construct()
    {
        $this->dispatch('refresh-the-cart');
        $this->cart = ModelsCart::where('fuser_id', Auth::check() ? Auth::id() : Session::getId())->first();
        if (!$this->cart) $this->cart = ModelsCart::create([
            'fuser_id' => Auth::check() ? Auth::id() : Session::getId()
        ]);
    }

    public function remove($item)
    {
        $item = CartItem::findOrFail($item);
        $item->delete();
    }

    public function subtract($item)
    {
        $item = CartItem::findOrFail($item);
        --$item->quantity;
        if ($item->quantity) $item->save();
        else return;
    }

    public function setStep($step)
    {
        $this->step = $step;
    }

    public function setCity()
    {
        $this->deliveryMethod = null;
        $this->delivery_method_id = 0;
    }

    public function next()
    {
        ++$this->step;
    }

    public function submitContacts()
    {
        $this->validate();
        $this->step = 3;
    }

    public function submitDelivery($id = 0)
    {
        if ($id) $this->deliveryMethod = DeliveryMethod::findOrFail($id);
        else $this->step = 4;
    }

    public function submitCoupon()
    {
        $cart = $this->cart;

        Validator::make([
            'coupon' => $this->coupon
        ], [
            'coupon' => [
                'required',
                Rule::exists('coupons', 'code')->where(function (Builder $query) use ($cart) {
                    return $query->where('start', '<=', now())
                        ->where('finish', '>=', now())
                        ->where('minorder', '<=', $cart->sum)
                        ->where(function (Builder $query) {
                            $query->where('type', 'permanent')->orWhereNull('used');
                        });
                }),
            ],
        ], [
            'coupon.required' => 'Введите купон',
            'coupon.exists' => 'Купон не найден',
        ])->validate();

        $this->appliedCoupon = Coupon::where('code', $this->coupon)
            ->where('start', '<=', now())
            ->where('finish', '>=', now())
            ->where('minorder', '<=', $cart->sum)
            ->where(function (EloquentBuilder $query) {
                $query->where('type', 'permanent')->orWhereNull('used');
            })->first();
    }

    public function submit()
    {
        $cart = $this->cart;
        $this->paymentMethod = PaymentMethod::find($this->payment_method_id);
        
        DB::beginTransaction();

        try {
            $this->order = ModelsOrder::create([
                'sum' => $cart->sum,
                'delivery_method_id' => $this->deliveryMethod->id,
                'delivery_price' => $this->deliveryMethod->price,
                'city_id' => $this->city_id,
                'address' => $this->address,
                'payment_method_id' => $this->paymentMethod->id,
                'coupon_code' => $this->coupon,
                'coupon_discount' => $this->couponSum,
                'discount' => $this->discount,
                'name' => $this->name,
                'lastname' => $this->lastname,
                'phone' => $this->phone,
                'email' => $this->email,
            ]);
            foreach ($cart->items as $item) {
                $this->order->items()->create([
                    'price' => $item->offer->price,
                    'quantity' => $item->quantity,
                    'offer_id' => $item->offer->id,
                ]);
            }
        } catch (\Throwable $e) {
            dump($e->getMessage());
            DB::rollBack();
        } finally {
        }
        DB::commit();
        
        
        //Sending message on mail
        SendMailClientJob::dispatch($cart,$this->order);
        $admins = User::where('role_id', 1)->get();
        foreach($admins as $admin)
        {
            SendMailAdminJob::dispatch($cart,$this->order, $admin);
        }

        if ($this->order) {

            $this->cart->delete();

            if ($this->order->paymentMethod->acquiring) {
                return redirect()->route('ru.pay', [
                    'token' => $this->order->token
                ]);
            } else {
                return redirect()->route('ru.home');
            }
        }
    }

    public function add($item)
    {
        $item = CartItem::findOrFail($item);
        ++$item->quantity;
        if ($item->offer->in_stock >= $item->quantity) $item->save();
        else return;
    }

    public function setPaymentMethod($id)
    {
        $this->paymentMethod = PaymentMethod::find($id);
    }

    public function render()
    {
        $city = City::find($this->city_id ?: 1);

        $deliviries = DeliveryMethod::whereHas('cities', function ($query) use ($city) {
            $query->where('id', $city->id);
        })->get();

        if (!$this->deliveryMethod) {
            $this->deliveryMethod = $deliviries[0];
            $this->delivery_method_id = $this->deliveryMethod->id;
        }

        if ($this->appliedCoupon) {
            $this->couponSum = 0;
            foreach ($this->cart->items as $item) {
                $product = $item->offer->product;
                if ($product) {
                    if ($this->appliedCoupon->product_id && $this->appliedCoupon->product_id === $product->id) {
                        if ($this->appliedCoupon->sum) {
                            $this->couponSum += $this->appliedCoupon->sum;
                        } elseif ($this->appliedCoupon->percent) {
                            $this->couponSum += ($item->offer->price * $this->appliedCoupon->percent / 100);
                        }
                    } elseif ($this->appliedCoupon->category_id && $product->category) {
                        $catArray = [$product->category->id];
                        foreach ($product->category->ancestors as $cat) $catArray[] = $cat->id;
                        if (in_array($this->appliedCoupon->category_id, $catArray)) {
                            if ($this->appliedCoupon->sum) {
                                $this->couponSum += $this->appliedCoupon->sum;
                            } elseif ($this->appliedCoupon->percent) {
                                $this->couponSum += ($item->offer->price * $this->appliedCoupon->percent / 100);
                            }
                        }
                    }
                }
            }
            if (!$this->appliedCoupon->product_id && !$this->appliedCoupon->category_id) {
                if ($this->appliedCoupon->sum) {
                    $this->couponSum += $this->appliedCoupon->sum;
                } elseif ($this->appliedCoupon->percent) {
                    $this->couponSum += ($this->cart->sum * $this->appliedCoupon->percent / 100);
                }
            }
        }

        if ($this->paymentMethod) {
            $this->discount = $this->paymentMethod->discount ? ($this->cart->sum * (int)setting('shop.discount') / 100) : 0;
        }

        $this->total = $this->cart->sum - $this->discount - $this->couponSum + $this->deliveryMethod->price;

        return view('livewire.order', [
            'deliveries' => $deliviries,
            'cities' => City::all(),
            'city' => $city,
        ]);
    }
}
