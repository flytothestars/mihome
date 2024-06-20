<x-app-layout>
    <div class="container">
        <div class="flex gap-8">
            <div class="w-full lg:max-w-[20rem] shrink-0 text-zinc-800">
                @include('profile.partials._aside', [
                    'active' => 'password',
                ])
            </div>
            <div class="grow">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>


</x-app-layout>
