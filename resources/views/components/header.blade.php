<header>
	<nav class="bg-white shadow-md" x-data="{ open: false }">
		<!-- Primary Navigation Menu -->
		<div class="mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex h-16 justify-between">
				<div class="shadow-2 flex flex-grow items-center justify-between px-4 py-4 md:px-6 2xl:px-11">
					<div class="flex items-center gap-2 sm:gap-4">
						<button class="z-99999 border-stroke block rounded-sm border bg-white px-2 py-1 shadow-sm"
							@click.stop="sidebarToggle = !sidebarToggle">
							<i class="fa-solid fa-bars"></i>
						</button>
						<a class="block flex-shrink-0 lg:hidden" href="{{ route('home') }}">
							@if (!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo)))
								<img class="w-[50px]" src="{{ asset('storage/' . $setting->application_logo) }}" alt="KisanSAT Logo" />
							@else
								<img class="w-[50px]" src="{{ asset('images/kisansat-logo.png') }}" alt="KisanSAT Logo" />
							@endif
						</a>
					</div>
				</div>
				<!-- top Navigation Links -->
				{{-- <div class="hidden items-center space-x-8 sm:-my-px sm:ms-10 sm:flex">
					<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
						{{ __('Dashboard') }}
					</x-nav-link>
				</div> --}}
				{{-- </div> --}}

				<!-- Settings Dropdown -->
				<div class="hidden sm:ms-6 sm:flex sm:items-center">
					<x-dropdown align="right" width="48">
						<x-slot name="trigger">
							<button class="btn btn-ghost text-gray-700">
								{{-- <div>{{ Auth::user()->name }}</div> --}}
								Admin
								<div class="ms-1">
									<i class="fa-solid fa-chevron-down"></i>
								</div>
							</button>
						</x-slot>

						<x-slot name="content">
							{{-- <x-dropdown-link :href="route('profile.edit')">
								{{ __('Profile') }}
							</x-dropdown-link> --}}

							<!-- Authentication -->
							<form method="POST" action="{{ route('admin.logout') }}">
								@csrf

								<x-dropdown-link :href="route('admin.logout')"
									onclick="event.preventDefault();
                                                this.closest('form').submit();">
									{{ __('Log Out') }}
								</x-dropdown-link>
							</form>
						</x-slot>
					</x-dropdown>
				</div>

				<!-- Hamburger -->
				{{-- <div class="-me-2 flex items-center sm:hidden">
				<button
					class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
					@click="open = ! open">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path class="inline-flex" :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						<path class="hidden" :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div> --}}
			</div>
		</div>

		<!-- Responsive Navigation Menu -->
		{{-- <div class="hidden sm:hidden" :class="{ 'block': open, 'hidden': !open }">
		<div class="space-y-1 pb-3 pt-2">
			<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
				{{ __('Dashboard') }}
			</x-responsive-nav-link>
		</div>

		<!-- Responsive Settings Options -->
		<div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
			<div class="px-4">
				<div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
				<div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
			</div>

			<div class="mt-3 space-y-1">
				<x-responsive-nav-link :href="route('profile.edit')">
					{{ __('Profile') }}
				</x-responsive-nav-link>

				<!-- Authentication -->
				<form method="POST" action="{{ route('logout') }}">
					@csrf

					<x-responsive-nav-link :href="route('logout')"
						onclick="event.preventDefault();
                                        this.closest('form').submit();">
						{{ __('Log Out') }}
					</x-responsive-nav-link>
				</form>
			</div>
		</div>
	</div> --}}
	</nav>

	<!-- Page Heading -->
	@isset($header)
		<div class="container mx-auto py-6">
			{{ $header }}
		</div>
	@endisset

</header>
