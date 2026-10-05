<x-guest-layout>
	<div class="flex min-h-[80vh] items-center justify-center">
		<div class="card mb-16 mt-8 w-full max-w-lg bg-base-100 p-8 pt-4 shadow-xl lg:max-w-2xl">
			{{-- <img class="mx-auto h-24 w-24 object-contain" src="{{ asset('images/kisansat-logo.png') }}" alt="Logo"> --}}
			{{-- <h1 class="mx-auto mb-10 text-center text-3xl">{{ __('Registration') }}</h1> --}}
			<div class="mb-4 text-sm text-gray-600">
				{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
			</div>

			<!-- Session Status -->
			<x-auth-session-status class="mb-4" :status="session('status')" />

			<form method="POST" action="{{ route('password.email') }}">
				@csrf

				<!-- Email Address -->
				<div>
					<x-input-label for="email" :value="__('Email')" />
					<x-text-input class="block w-full" id="email" name="email" type="email" :value="old('email')" required
						autofocus />
					<x-input-error class="mt-2" :messages="$errors->get('email')" />
				</div>

				<div class="mt-4 flex items-center justify-end">
					<x-primary-button>
						{{ __('Email Password Reset Link') }}
					</x-primary-button>
				</div>
			</form>
		</div>
	</div>
</x-guest-layout>
