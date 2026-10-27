<aside
    class="fixed left-0 top-0 z-[9999] flex h-screen w-72 flex-col overflow-y-hidden bg-gray-700 transition-all duration-300 ease-in-out lg:static"
    :class="sidebarToggle ? 'translate-x-0 w-72' : '-translate-x-full w-0 lg:w-0'"> {{-- @click.outside="sidebarToggle = false" --}}
    <!-- SIDEBAR HEADER -->
    <div class="mb-4 flex items-center justify-between gap-2 px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}">
            @if (!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo)))
                <img class="w-20" src="{{ asset('storage/' . $setting->application_logo) }}" alt="KisanSAT Logo">
            @else
                <img class="w-20" src="{{ asset('images/kisansat-logo.png') }}" alt="KisanSAT Logo">
            @endif
        </a>

        <button class="block px-2 py-1 shadow-sm lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <i class="fa-solid fa-arrow-left text-2xl text-white"></i>
        </button>
    </div>
    <!-- Menu -->
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <ul>
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="fa-solid fa-tachometer-alt" text="Dashboard" />
            <x-sidebar-link :href="route('admin.blogs.index')" :active="request()->routeIs('admin.blogs.*')" icon="fa-solid fa-newspaper" text="Blog Posts" />
            <x-sidebar-link :href="route('admin.gallery.index')" :active="request()->routeIs('admin.gallery.*')" icon="fa-solid fa-images" text="Image Gallery" />
            {{--
            <x-sidebar-link :href="route('farmer.index')" :active="request()->routeIs('farmer.*')" icon="fa-solid fa-users" text="Farmers" />
            <x-sidebar-link :href="route('subscription.index')" :active="request()->routeIs('subscription.index')" icon="fa-solid fa-money-check-alt"
                text="Subscriptions" />

            <x-sidebar-link :href="route('addfarm.index')" :active="request()->routeIs('addfarm.index')" icon="fa-solid fa-seedling" text="Farms" />
            <x-sidebar-link :href="route('logs.index')" :active="request()->routeIs('logs.index')" icon="fa-solid fa-file-alt" text="API Logs" />
            <x-sidebar-link :href="route('monitoring.index')" :active="request()->routeIs('monitoring.index')" icon="fa-solid fa-file-alt"
                text="Farm Monitoring API Logs" />
            <x-sidebar-link :href="route('contact-us.index')" :active="request()->routeIs('contact-us.index')" icon="fa-solid fa-address-book" text="ContactUs" />
            --}}


                <x-sidebar-submenu-link title="Contract Farming" icon="fa-solid fa-seedling">
                   <x-sidebar-link :href="route('contract_farming.crops.index')" :active="request()->routeIs('contract_farming.crops.index')" icon="fa-solid fa-seedling" text="Crop details" />
                   <x-sidebar-link :href="route('contract_farming.enquiry.index')" :active="request()->routeIs('contract_farming.enquiry.index')" icon="fa-solid fa-plus" text="Enquiry Form details" />
               </x-sidebar-submenu-link>


            {{-- <x-sidebar-link :href="route('servicemaster.index')" :active="request()->routeIs('servicemaster.index')" icon="fa-solid fa-file-alt" text="Service Master" />
			<x-sidebar-link :href="route('packagemaster.index')" :active="request()->routeIs('packagemaster.index')" icon="fa-solid fa-file-alt" text="Package Master" /> --}}

            <!-- Collapsible Submenu -->
            <x-sidebar-submenu-link title="Settings" icon="fa-solid fa-cogs">
                {{-- <x-sidebar-link :href="route('servicemaster.index')" :active="request()->routeIs('servicemaster.index')" icon="fa-solid fa-file-alt" text="Services" /> --}}
                <x-sidebar-link :href="route('setting.index')" :active="request()->routeIs('setting.index')" icon="fa-solid fa-cog" text="General Setting" />
            </x-sidebar-submenu-link>




            {{-- <li class="whitespace-nowrap">
				<button class="z-50 mt-5 w-full bg-gray-600 px-5 py-3 text-left text-white" id="sidebarToggle1">
					<i class="fa fa-chevron-left me-5 text-xl transition-all duration-500"></i>
					<span class="menu-text text-md">Collapse</span>
				</button>
			</li> --}}
        </ul>
    </div>
</aside>
