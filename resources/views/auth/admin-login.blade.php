<x-guest-layout>
	<div class="flex min-h-[80vh] items-center justify-center">
		<div class="card mb-16 mt-8 w-full max-w-lg bg-base-100 p-8 pt-4 shadow-xl lg:max-w-2xl">

			{{-- <img class="mx-auto h-24 w-24 object-contain" src="{{ asset('images/kisansat-logo.png') }}" alt="Logo"> --}}
			<h1 class="mx-auto mb-10 text-center text-3xl">{{ __('Admin Login') }}</h1>
			<!-- Session Status -->
			<x-auth-session-status class="mb-4" :status="session('status')" />

			<form method="POST" action="{{ route('admin.login') }}">
				@csrf

				<!-- Email Address -->
				<div class="form-control w-full">
					<x-input-label for="email" :value="__('Email')" />
					<div class="relative">
						<i class="fa fa-envelope absolute left-3 top-1/2 -translate-y-1/2 transform"></i>
						<x-text-input class="w-full pl-10" id="email" name="email" type="email" :value="old('email')" required
							autofocus autocomplete="username" placeholder="Enter you email address" />
					</div>
					<x-input-error class="mt-2" :messages="$errors->get('email')" />
				</div>

				<!-- Password -->
				<div class="form-control mt-4 w-full">
					<x-input-label for="password" :value="__('Password')" />
					<div class="relative">
						<i class="fa fa-lock absolute left-3 top-1/2 -translate-y-1/2 transform"></i>
						<x-text-input class="w-full pl-10" id="password" name="password" type="password" required
							autocomplete="current-password" placeholder="Enter your password" />
					</div>
					<x-input-error class="mt-2" :messages="$errors->get('password')" />
				</div>

				<!-- Remember Me -->
				{{-- <div class="form-control mt-4">
					<label class="label cursor-pointer">
						<span class="label-text text-sm text-gray-600">{{ __('Remember me') }}</span>
						<input class="checkbox-primary checkbox" id="remember_me" name="remember" type="checkbox" />
					</label>
				</div> --}}

				<div class="flex items-center justify-between">
					<x-primary-button class="mt-3 w-full">
						{{ __('Sign in') }}
					</x-primary-button>
				</div>
			</form>
		</div>
	</div>
</x-guest-layout>
