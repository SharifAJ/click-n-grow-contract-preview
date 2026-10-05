<x-guest-layout>
	<div class="flex min-h-[80vh] items-center justify-center">
		<div class="card mb-16 mt-8 w-full max-w-lg bg-base-100 p-8 pt-4 shadow-xl lg:max-w-2xl">
			{{-- <img class="mx-auto h-24 w-24 object-contain" src="{{ asset('images/kisansat-logo.png') }}" alt="Logo"> --}}
			<h1 class="mx-auto mb-10 text-center text-3xl">{{ __('Registration') }}</h1>
			<div class="mb-4 text-sm text-gray-600 ">
				{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
			</div>

			<form method="POST" action="{{ route('password.confirm') }}">
				@csrf

				<!-- Password -->
				<div>
					<x-input-label for="password" :value="__('Password')" />

					<x-text-input class="block w-full" id="password" name="password" type="password" required
						autocomplete="current-password" />

					<x-input-error class="mt-2" :messages="$errors->get('password')" />
				</div>

				<div class="mt-4 flex justify-end">
					<x-primary-button>
						{{ __('Confirm') }}
					</x-primary-button>
				</div>
			</form>
		</div>
	</div>
</x-guest-layout>
