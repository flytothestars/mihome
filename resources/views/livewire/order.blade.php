  <div>
      <h1 class="text-2xl font-bold mb-6">Оформление товара</h1>
      @if ($cart->items()->count() < 1)
          <p>Ваша корзина пуста</p>
      @else
          <div class="flex flex-col lg:flex-row gap-4">
              <div class="grow">
                  <div class="border-t py-6">
                      <h3 class="flex gap-2 items-center font-normal text-lg mb-4">
                          <span
                              class="border rounded-full h-6 w-6 flex items-center justify-center text-sm @if ($step > 1) bg-green-500 text-white border-green-500 @endif">
                              @if ($step > 1)
                                  <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path d="M1 7.5L5 11.5L14 1" stroke="currentColor" />
                                  </svg>
                              @else
                                  <span>1</span>
                              @endif
                          </span>
                          <span
                              @if ($step > 1) wire:click.prevent="setStep(1)"  class="cursor-pointer" @endif>Товары
                              в корзине</span>
                      </h3>
                      @if ($step === 1)
                          @include('livewire.order._cart')
                      @endif
                  </div>
                  <div class="border-t py-6">
                      <h3
                          class="flex gap-2 items-center font-normal text-lg mb-4 @if ($step < 2) text-gray-125 @endif">
                          <span
                              class="border rounded-full h-6 w-6 flex items-center justify-center text-sm @if ($step > 2) bg-green-500 text-white border-green-500 @endif">
                              @if ($step > 2)
                                  <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path d="M1 7.5L5 11.5L14 1" stroke="currentColor" />
                                  </svg>
                              @else
                                  <span>2</span>
                              @endif
                          </span>
                          <span
                              @if ($step > 2) wire:click.prevent="setStep(2)"  class="cursor-pointer" @endif>Контактные
                              данные</span>
                      </h3>
                      @if ($step === 2)
                          @include('livewire.order._contacts')
                      @endif
                  </div>
                  <div class="border-t py-6">
                      <h3
                          class="flex gap-2 items-center font-normal text-lg mb-4 @if ($step < 3) text-gray-125 @endif">
                          <span
                              class="border rounded-full h-6 w-6 flex items-center justify-center text-sm @if ($step > 3) bg-green-500 text-white border-green-500 @endif">
                              @if ($step > 3)
                                  <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path d="M1 7.5L5 11.5L14 1" stroke="currentColor" />
                                  </svg>
                              @else
                                  <span>3</span>
                              @endif
                          </span>
                          <span
                              @if ($step > 3) wire:click.prevent="setStep(3)"  class="cursor-pointer" @endif>Способ
                              получения</span>
                      </h3>
                      @if ($step === 3)
                          @include('livewire.order._delivery')
                      @endif
                  </div>
                  <form action="#" id="payment-form" wire:submit.prevent="submit" method="POST"
                      class="border-t py-6">
                      <h3
                          class="flex gap-2 items-center font-normal text-lg mb-4 @if ($step < 4) text-gray-125 @endif">
                          <span class="border rounded-full h-6 w-6 flex items-center justify-center text-sm">
                              <span>4</span>
                          </span>
                          <span>Способ оплаты</span>
                      </h3>
                      @if ($step === 4)
                          @include('livewire.order._payment')
                      @endif
                      @if ($paymentMethod && $step === 4)
                          <div class="">
                              <x-success-button
                                  class="w-full lg:max-w-[20rem] justify-center"><span>Оплатить</span></x-success-button>
                          </div>
                      @endif
                  </form>
              </div>
              <div class="w-full lg:max-w-[20rem] shrink-0">
                  <div class="mb-6 bg-white shadow">
                      <div class="p-4 lg:p-6 @if ($paymentMethod) rounded-t-lg @else rounded-lg @endif">
                          <h4>Итого</h4>
                          <div class="space-y-2.5">
                              <div class="flex items-center justify-between">
                                  <span>Сумма</span>
                                  <span>{{ number_format($cart->sum, 0, '.', ' ') }} ₸</span>
                              </div>
                              @if ($deliveryMethod->price)
                                  <div class="flex items-center justify-between">
                                      <span>Доставка</span>
                                      <span>{{ number_format($deliveryMethod->price, 0, '.', ' ') }} ₸</span>
                                  </div>
                              @endif
                              @if ($discount)
                                  <div class="flex items-center justify-between">
                                      <span>Скидка</span>
                                      <span>{{ number_format($discount, 0, '.', ' ') }} ₸</span>
                                  </div>
                              @endif
                              @if ($couponSum)
                                  <div class="flex items-center justify-between">
                                      <span>Промокод</span>
                                      <span>{{ number_format($couponSum, 0, '.', ' ') }} ₸</span>
                                  </div>
                              @endif
                          </div>
                          <hr />
                          <div class="flex items-center justify-between">
                              <span>К оплате</span>
                              <span class="text-lg font-bold">{{ number_format($total, 0, '.', ' ') }} ₸</span>
                          </div>
                      </div>
                      @if ($paymentMethod && $step === 4)
                          <div>
                              <x-success-button form="payment-form"
                                  class="w-full rounded-t-none justify-center"><span>Оплатить</span></x-success-button>
                          </div>
                      @endif
                  </div>
                  <div>
                      <svg class="w-5 h-5 inline mr-1" viewBox="0 0 20 20" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10 1.5C5.30558 1.5 1.5 5.30558 1.5 10C1.5 10.8792 1.68549 11.7724 1.94779 12.5928L1.9518 12.6053C2.25685 13.5593 2.49075 14.2908 2.6443 14.8515C2.79499 15.4018 2.88682 15.8488 2.86848 16.2098C2.8552 16.4712 2.84169 16.5675 2.7826 16.8225C2.70408 17.1612 2.54622 17.4918 2.32589 17.8677C2.21523 18.0564 2.08358 18.2651 1.93068 18.5H10C14.6944 18.5 18.5 14.6944 18.5 10C18.5 5.30558 14.6944 1.5 10 1.5ZM0.587777 18.7169C0.53241 18.7974 0.5 18.8949 0.5 19C0.5 19.2761 0.723858 19.5 1 19.5H10C15.2467 19.5 19.5 15.2467 19.5 10C19.5 4.75329 15.2467 0.5 10 0.5C4.75329 0.5 0.5 4.75329 0.5 10C0.5 11.0136 0.712593 12.0132 0.995294 12.8973C1.30515 13.8664 1.53252 14.5778 1.67981 15.1156C1.83061 15.6663 1.87914 15.9745 1.86977 16.159C1.85948 16.3615 1.85419 16.3993 1.80842 16.5967C1.76359 16.7901 1.66441 17.0187 1.46319 17.3619C1.26209 17.705 0.979811 18.1289 0.587777 18.7169ZM11 6C11 6.55228 10.5523 7 10 7C9.44771 7 9 6.55228 9 6C9 5.44772 9.44771 5 10 5C10.5523 5 11 5.44772 11 6ZM10.5 9C10.5 8.72386 10.2761 8.5 10 8.5C9.72386 8.5 9.5 8.72386 9.5 9V14C9.5 14.2761 9.72386 14.5 10 14.5C10.2761 14.5 10.5 14.2761 10.5 14V9Z"
                              fill="#22282F" />
                      </svg>
                      <span>Вы также можете оформить заказ через <a href="#"
                              class="text-green-400 underline hover:no-underline">форму обратной связи</a></span>
                  </div>
              </div>
          </div>
      @endif
  </div>
