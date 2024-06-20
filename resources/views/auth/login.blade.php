<x-app-layout>
    <div class="container">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="">
                <form method="POST" action="{{ route(app()->getLocale() . '.login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="uk-input" placeholder="Логин" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="uk-input" placeholder="Пароль" type="password"
                            name="password" required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between gap-4 mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has(app()->getLocale() . '.password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route(app()->getLocale() . '.password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-between gap-4 mt-4">

                        @if (Route::has(app()->getLocale() . '.register'))
                            <a href="{{ route(app()->getLocale() . '.register') }}">
                                <x-secondary-button class="uk-button uk-button-secondary">
                                    {{ __('Register') }}
                                </x-secondary-button>
                            </a>
                        @endif

                        <x-primary-button class="uk-button uk-button-primary">
                            {{ __('Log in') }}
                        </x-primary-button>

                    </div>
                </form>
            </div>
            <div class="">
                <p>Вы можете выполнить вход используя
                    аккаунт:</p>
                <ul class="flex gap-2.5 m-0 p-0">
                    <li>
                        <a class="block w-12 h-12 rounded" href="{{ route('auth.facebook') }}">
                            <svg class="block w-12 h-12" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="73 0 267 266.9"
                                enable-background="new 73 0 267 266.9" xml:space="preserve">
                                <path id="Blue_1_" fill="#157DC3"
                                    d="M321.1,262.3c7.9,0,14.2-6.4,14.2-14.2V18.8c0-7.9-6.4-14.2-14.2-14.2H91.8 C84,4.6,77.6,11,77.6,18.8v229.3c0,7.9,6.4,14.2,14.2,14.2H321.1z" />
                                <path id="f" fill="#FFFFFF"
                                    d="M255.4,262.3v-99.8h33.5l5-38.9h-38.5V98.8c0-11.3,3.1-18.9,19.3-18.9l20.6,0V45 c-3.6-0.5-15.8-1.5-30-1.5c-29.7,0-50,18.1-50,51.4v28.7h-33.6v38.9h33.6v99.8H255.4z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="block w-12 h-12 rounded" href="{{ route('auth.google') }}">
                            <svg class="block w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                                <path d="M1 1h22v22H1z" fill="none" />
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a class="block w-12 h-12 rounded" href="{{ route('auth.vkontakte') }}">
                            <svg class="block w-12 h-12" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M 179.92864,32.000013 L 844.07135,32.000013 C 925.76732,32.000013 991.99999,98.230361 991.99999,179.92865 L 991.99999,844.07135 C 991.99999,925.76732 925.76732,991.99998 844.07135,991.99998 L 179.92864,991.99998 C 98.230355,991.99998 32.000006,925.76732 32.000006,844.07135 L 32.000006,179.92865 C 32.000006,98.230361 98.230355,32.000013 179.92864,32.000013"
                                    id="path2438" style="fill:#4c75a3;fill-opacity:1;fill-rule:evenodd;stroke:none" />
                                <path
                                    d="M 503.94561,704.02937 L 543.21464,704.02937 C 543.21464,704.02937 555.07355,702.72226 561.13718,696.19824 C 566.71036,690.20169 566.53222,678.94892 566.53222,678.94892 C 566.53222,678.94892 565.76414,626.25707 590.21533,618.49765 C 614.32875,610.84928 645.28544,669.422 678.09524,691.94606 C 702.90734,708.98485 721.76221,705.25552 721.76221,705.25552 L 809.501,704.02937 C 809.501,704.02937 855.39584,701.19767 833.63292,665.11199 C 831.85154,662.16461 820.95504,638.41904 768.39506,589.63234 C 713.37584,538.56917 720.75122,546.83061 787.0209,458.5042 C 827.37958,404.71345 843.51149,371.87589 838.47041,357.81224 C 833.66762,344.41255 803.98103,347.95218 803.98103,347.95218 L 705.19537,348.56294 C 705.19537,348.56294 697.86626,347.56583 692.43883,350.81395 C 687.12938,353.99036 683.72163,361.41201 683.72163,361.41201 C 683.72163,361.41201 668.08018,403.03386 647.23571,438.43707 C 603.24717,513.13013 585.65546,517.08387 578.46516,512.4384 C 561.73637,501.6275 565.91683,469.01666 565.91683,445.84252 C 565.91683,373.45368 576.89662,343.272 544.53564,335.45938 C 533.79877,332.86828 525.88898,331.15399 498.42564,330.87406 C 463.17512,330.51547 433.3474,330.98279 416.45436,339.25811 C 405.21547,344.76189 396.54454,357.02334 401.82853,357.72895 C 408.35949,358.59882 423.14264,361.71971 430.98071,372.38486 C 441.10682,386.16164 440.75286,417.08826 440.75286,417.08826 C 440.75286,417.08826 446.57126,502.30072 427.16809,512.88259 C 413.85401,520.14229 395.58676,505.32213 356.36862,437.55563 C 336.27835,402.84415 321.10422,364.47044 321.10422,364.47044 C 321.10422,364.47044 318.18229,357.30096 312.96308,353.46289 C 306.6334,348.81279 297.78896,347.33911 297.78896,347.33911 L 203.91254,347.95218 C 203.91254,347.95218 189.8234,348.34547 184.64583,354.47388 C 180.03969,359.92907 184.27802,371.19804 184.27802,371.19804 C 184.27802,371.19804 257.76808,543.14061 340.9886,629.78975 C 417.30341,709.24396 503.94561,704.02937 503.94561,704.02937"
                                    id="path2442" style="fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none" />
                            </svg>
                        </a>
                    </li>
                    {{-- <li>
                        <a class="block w-12 h-12 rounded flex items-center justify-center" href="#">
                            <svg class="block w-10 h-10" viewBox="0 0 814 1000">
                                <path
                                    d="M788.1 340.9c-5.8 4.5-108.2 62.2-108.2 190.5 0 148.4 130.3 200.9 134.2 202.2-.6 3.2-20.7 71.9-68.7 141.9-42.8 61.6-87.5 123.1-155.5 123.1s-85.5-39.5-164-39.5c-76.5 0-103.7 40.8-165.9 40.8s-105.6-57-155.5-127C46.7 790.7 0 663 0 541.8c0-194.4 126.4-297.5 250.8-297.5 66.1 0 121.2 43.4 162.7 43.4 39.5 0 101.1-46 176.3-46 28.5 0 130.9 2.6 198.3 99.2zm-234-181.5c31.1-36.9 53.1-88.1 53.1-139.3 0-7.1-.6-14.3-1.9-20.1-50.6 1.9-110.8 33.7-147.1 75.8-28.5 32.4-55.1 83.6-55.1 135.5 0 7.8 1.3 15.6 1.9 18.1 3.2.6 8.4 1.3 13.6 1.3 45.4 0 102.5-30.4 135.5-71.3z" />
                            </svg>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
