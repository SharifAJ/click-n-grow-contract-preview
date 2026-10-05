<x-guest-layout>
	<div class="flex min-h-[80vh] items-center justify-center">
		<div class="card mb-16 mt-8 w-full max-w-lg bg-base-100 p-8 pt-4 shadow-xl lg:max-w-2xl">
			{{-- <img class="mx-auto h-24 w-24 object-contain" src="{{ asset('images/e.png') }}" alt="Logo"> --}}
			<h1 class="mx-auto mb-10 text-center text-3xl">{{ __('Registration') }}</h1>
			<form method="POST" action="{{ route('register') }}">
				@csrf

				<!-- Name -->
				<div class="form-control">
					<x-input-label for="name" :value="__('Name')" />
					<div class="relative">
						<x-text-input class="w-full pl-10" id="name" name="name" type="text" :value="old('name')" required autofocus
							autocomplete="name" placeholder="Enter your name" />
						<i class="fa fa-user absolute left-3 top-1/2 -translate-y-1/2 transform"></i>
					</div>
					<x-input-error class="mt-2" :messages="$errors->get('name')" />
				</div>

				<!-- Email Address -->
				<div class="form-control mt-4">
					<x-input-label for="email" :value="__('Email')" />
					<div class="relative">
						<x-text-input class="w-full pl-10" id="email" name="email" type="email" :value="old('email')" required
							autocomplete="username" placeholder="Enter you email" />
						<i class="fa fa-envelope absolute left-3 top-1/2 -translate-y-1/2 transform"></i>
					</div>
					<x-input-error class="mt-2" :messages="$errors->get('email')" />
				</div>

				<!-- Password -->
				<div class="form-control mt-4">
					<x-input-label for="password" :value="__('Password')" />
					<div class="relative">
						<x-text-input class="w-full pl-10" id="password" name="password" type="password" required
							autocomplete="new-password" placeholder="Enter your password"/>
						<i class="fa fa-lock absolute left-3 top-1/2 -translate-y-1/2 transform"></i>
					</div>
					<x-input-error class="mt-2" :messages="$errors->get('password')" />
				</div>

				<!-- Confirm Password -->
				<div class="form-control mt-4">
					<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
					<div class="relative">
						<x-text-input class="w-full pl-10" id="password_confirmation" name="password_confirmation" type="password"
							required autocomplete="new-password" placeholder="Re-enter the same password"/>
						<i class="fa fa-lock absolute left-3 top-1/2 -translate-y-1/2 transform"></i>
					</div>
					<x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
				</div>

				<div class="mt-4 flex items-center justify-end">
					<x-link href="{{ route('login') }}">
						{{ __('Already registered?') }}
					</x-link>

					<x-primary-button class="btn btn-primary ms-4">
						{{ __('Register') }}
					</x-primary-button>
				</div>
			</form>
		</div>
	</div>
</x-guest-layout>
