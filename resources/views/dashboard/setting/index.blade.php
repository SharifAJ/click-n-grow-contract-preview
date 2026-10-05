<x-app-layout>
	<x-header-title :title="'General Setting'" />

	<div class="rounded-lg bg-white p-6 shadow-md">
		<h2 class="mb-4 text-xl font-semibold">Application Settings</h2>

		{{-- Alerts --}}
		@if (session('success'))
			<x-simple-alert type="success" :message="session('success')" />
		@endif

		@if (session('error'))
			<x-simple-alert type="error" :message="session('error')" />
		@endif

		<form method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
			@csrf

			<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
				<div>
					<x-input-label for="application_name" :value="__('Application Name')" required />
					<x-text-input class="block w-full" id="application_name" name="application_name" type="text"
						value="{{ old('application_name', $setting->application_name ?? '') }}" required />
					<x-input-error :messages="$errors->get('application_name')" />
				</div>

				<div>
					<x-input-label for="company_address" :value="__('Company Address')" required />
					<x-text-input class="block w-full" id="company_address" name="company_address" type="text"
						value="{{ old('company_address', $setting->company_address ?? '') }}" required />
					<x-input-error :messages="$errors->get('company_address')" />
				</div>

				<div>
					<x-input-label for="company_email" :value="__('Company Email ID')" required />
					<x-text-input class="block w-full" id="company_email" name="company_email" type="email"
						value="{{ old('company_email', $setting->company_email ?? '') }}" required />
					<x-input-error :messages="$errors->get('company_email')" />
				</div>

				<div>
					<x-input-label for="phone_number" :value="__('Phone Number')" required />
					<x-text-input class="block w-full" id="phone_number" name="phone_number" type="text"
						value="{{ old('phone_number', $setting->phone_number ?? '') }}" required />
					<x-input-error :messages="$errors->get('phone_number')" />
				</div>

				<div class="col-span-2">
					<x-input-label for="about_us" :value="__('About Us')" required />
					<textarea class="textarea textarea-bordered w-full" id="about_us" name="about_us" required>{{ old('about_us', $setting->about_us ?? '') }}</textarea>
					<x-input-error :messages="$errors->get('about_us')" />
				</div>

				<div class="col-span-2">
					<x-input-label for="application_logo" :value="__('Application Logo')" required />
					<input class="file-input file-input-bordered w-full" id="application_logo" name="application_logo"
						type="file" />
						<p class="mt-2 text-sm text-gray-500">Please upload a logo of size 500x500px and less than 2 MB.</p>
					<x-input-error :messages="$errors->get('application_logo')" />

					@if (!empty($setting->application_logo))
						<div class="mt-2">
							<img class="h-20 w-20 rounded-lg" src="{{ Storage::url($setting->application_logo) }}"
								alt="Application Logo">
						</div>
					@endif
				</div>
			</div>

			<div class="mt-6 flex justify-end gap-4">
				<a class="btn btn-neutral" href="{{ route('dashboard') }}">Cancel</a>
				<button class="btn btn-primary" type="submit">Save</button>
			</div>
		</form>
	</div>

</x-app-layout>
