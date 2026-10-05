<x-guest-layout>
	<div class="container prose mb-20 mt-3 max-w-5xl px-4 sm:px-6 lg:px-8">
		<x-page-header :title="__('messages.grievance_title')" />

		<p class="mb-4 leading-relaxed text-gray-700">
			{{ __('messages.grievance_description') }}
		</p>

		<div class="border-t border-gray-300 pt-4">
			<h2 class="text-xl font-semibold">{{ __('messages.grievance_officer') }}</h2>
			<p class="text-gray-700">
				<strong>{{ __('messages.company_name') }}</strong><br>
				<strong>{{ __('messages.address') }}</strong><br>
				<strong>{{ __('messages.email') }}:</strong>
				<a class="text-blue-600 hover:underline" href="mailto:info.kisansat@gmail.com">info.kisansat@gmail.com</a>
			</p>
		</div>

		<div class="mt-8">
			<a class="btn btn-outline btn-primary rounded-lg px-6 py-2" href="{{ route('home') }}">
				{{ __('messages.back_to_home') }}
			</a>
		</div>
	</div>
</x-guest-layout>
