<x-app-layout>
    {{-- @dd($users, $users); --}}

    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farmer Subscriptions')" />

    {{-- TODO: Either add this classes in app layout or use daisyUI default classes --}}




    <div class="  mt-5">
        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">
            <div class="mb-14 w-full p-7" x-data="{
                openTab: 1,
                activeClasses: 'text-primary border-primary',
                inactiveClasses: 'border-transparent',
            }">
                <div class="border-stroke dark:border-strokedark mb-6 flex flex-wrap gap-5 border-b sm:gap-10">
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 1" :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Admin Subscriptions
                    </a>
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses">
                        Mobile Subscriptions
                    </a>
                </div>


                <div class="w-full">
                    <div class="bg-white" x-show="openTab === 1">
                        <div class="text-end">
                            <a href="{{ route('subscription.create') }}" class="btn btn-success text-white">
                                New Farmer Subscription
                            </a>
                        </div>

                        <table id="Admins_Table" class="table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Total Subscriptions</th>
                                    <th>Total Amount</th>
                                    {{-- <th>Payments By</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptionsData as $index => $subscription)
                                    @php
                                        $totalAmount = 0;

                                        foreach ($subscription->farms as $farm) {
                                            foreach ($farm->subscriptions as $farmSubscription) {
                                                if ($farmSubscription->payment_status === 'completed') {
                                                    $totalAmount += $farmSubscription->amount;
                                                }
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $subscription->name ?? 'N/A' }}</td>
                                        <td>{{ $subscription->mobile ?? 'N/A' }}</td>
                                        <td>{{ $subscription->email ?? 'N/A' }}</td>
                                        <td x-data="{ loading: false, userData: null }">
                                            <button class="btn btn-ghost text-secondary underline"
                                                @click="
                                                loading = true;
                                                userData = {{ json_encode($subscription) }};
                                                $dispatch('open-modal', 'admin_subscriptions_modal_{{ $subscription->id }}');
                                                loading = false;
                                            ">
                                                {{ $subscription->total_subscriptions_count }}
                                            </button>

                                            <x-modal maxWidth="7xl"
                                                name="admin_subscriptions_modal_{{ $subscription->id }}" focusable>
                                                <div class="p-4 overflow-x-auto">
                                                    <h3 class="text-lg font-bold">Subscription Details</h3>
                                                    <table
                                                        class="table mt-4 w-full border-collapse border border-gray-300">
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th class="border p-2">#</th>
                                                                <th class="border p-2">Subscription ID</th>
                                                                <th class="border p-2">Farm ID</th>
                                                                <th class="border p-2">Farm Name</th>
                                                                <th class="border p-2">Farm Area</th>
                                                                <th class="border p-2">Crop Type</th>
                                                                <th class="border p-2">Subscription Type</th>
                                                                <th class="border p-2">Subscription Name</th>
                                                                <th class="border p-2">Subscription Duration</th>
                                                                <th class="border p-2">Amount</th>
                                                                <th class="border p-2">Start Date</th>
                                                                <th class="border p-2">End Date</th>
                                                                <th class="border p-2">Payment Status</th>
                                                                <th class="border p-2">Subscription Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template x-if="userData">
                                                                <template
                                                                    x-for="(user, index) in userData.farms.flatMap(farm => 
                                                                    farm.subscriptions.map(sub => ({...sub, farm})))"
                                                                    :key="user.id">
                                                                    <tr>
                                                                        <td class="border p-2" x-text="index + 1"></td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscription_code ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.farm.farm_id"></td>
                                                                        <td class="border p-2" x-text="user.farm.name">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.farm.area ? Math.floor(parseFloat(user.farm.area) * 10) / 10 : '0.0'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="user.farm.croptype"></td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                                        ? 'Package' 
                                                                                        : 'Premium Services'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.name ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.duration_labels ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.amount ?? 'N/A'"></td>
                                                                        <td class="border p-2"
                                                                            x-text="user.starts_at 
                                                                                ? new Date(user.starts_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.expires_at 
                                                                                ? new Date(user.expires_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>



                                                                        <td class="border p-2"
                                                                            x-text="user.payment_status 
                                                                                        ? user.payment_status.charAt(0).toUpperCase() + user.payment_status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.status 
                                                                                        ? user.status.charAt(0).toUpperCase() + user.status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>

                                                            {{-- <template x-if="userData">
                                                                <template x-for="farm in userData.farms" :key="farm.id">
                                                                    <template x-for="(subscription) in farm.subscriptions" :key="subscription.id">
                                                                        <tr>
                                                                            <td class="border p-2" x-text="subscription.id"></td> <!-- Increment globally -->
                                                            
                                                                            <td class="border p-2" x-text="subscription.subscription_code ?? 'N/A'"></td>
                                                            
                                                                            <td class="border p-2" x-text="farm.farm_id"></td>
                                                                            <td class="border p-2" x-text="farm.name"></td>
                                                                            <td class="border p-2" x-text="farm.croptype"></td>
                                                            
                                                                            <td class="border p-2"
                                                                                x-text="subscription.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                                        ? 'Package' 
                                                                                        : 'Premium Services'">
                                                                            </td>
                                                            
                                                                            <td class="border p-2" x-text="subscription.subscribable?.name ?? 'N/A'"></td>
                                                                            <td class="border p-2" x-text="subscription.subscribable?.duration_labels ?? 'N/A'"></td>
                                                            
                                                                            <td class="border p-2" x-text="subscription.amount ?? 'N/A'"></td>
                                                                            <td class="border p-2"
                                                                                x-text="subscription.starts_at 
                                                                                        ? subscription.starts_at.split(' ')[0].split('-').reverse().join('-') 
                                                                                        : 'N/A'">
                                                                            </td>
                                                                            <td class="border p-2"
                                                                                x-text="subscription.expires_at 
                                                                                        ? subscription.expires_at.split(' ')[0].split('-').reverse().join('-') 
                                                                                        : 'N/A'">
                                                                            </td>
                                                            
                                                                            <td class="border p-2"
                                                                                x-text="subscription.payment_status 
                                                                                        ? subscription.payment_status.charAt(0).toUpperCase() + subscription.payment_status.slice(1) 
                                                                                        : 'N/A'">
                                                                            </td>
                                                                            <td class="border p-2"
                                                                                x-text="subscription.status 
                                                                                        ? subscription.status.charAt(0).toUpperCase() + subscription.status.slice(1) 
                                                                                        : 'N/A'">
                                                                            </td>
                                                                        </tr>
                                                                    </template>
                                                                </template>
                                                            </template> --}}

                                                            {{-- <template x-if="userData">

                                                                <template x-for="(farm, index) in userData.farms"
                                                                    :key="farm.id">

                                                                    <div x-init="console.log(userData)">

                                                                    </div>
                                                                    <tr>
                                                                        <td class="border p-2" x-text="index + 1">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions.length ? farm.subscriptions[0].subscription_code : 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2" x-text="farm.farm_id">
                                                                        </td>
                                                                        <td class="border p-2" x-text="farm.name">
                                                                        </td>
                                                                        <td class="border p-2" x-text="farm.croptype">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                            ? 'Package' 
                                                                            : 'Premium Services'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions[0].subscribable?.name ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions[0].subscribable?.duration_labels ?? 'N/A'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.amount ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.starts_at ? farm.subscriptions[0].starts_at.split(' ')[0].split('-').reverse().join('-') : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.expires_at ? farm.subscriptions[0].expires_at.split(' ')[0].split('-').reverse().join('-') : 'N/A'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.payment_status 
                                                                            ? farm.subscriptions[0].payment_status.charAt(0).toUpperCase() + farm.subscriptions[0].payment_status.slice(1) 
                                                                            : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.status 
                                                                            ? farm.subscriptions[0].status.charAt(0).toUpperCase() + farm.subscriptions[0].status.slice(1) 
                                                                            : 'N/A'">
                                                                        </td>


                                                                    </tr>
                                                                </template>
                                                            </template> --}}


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </x-modal>
                                        </td>

                                        <td>{{  number_format($totalAmount, 2)   }}</td>
                                        {{-- <td>{{ ucfirst($paymendata->gateway_name) ?? 'N/A' }}</td> --}}

                                        <td>
                                            <a class="  items-center gap-2 text-info"
                                                href="{{ route('subscription.show', $subscription->id) }}">
                                                <i class="fas fa-eye text-2xl px-2"></i>
                                            </a>
                                            {{-- @if ($subscription->farms->subscription === 'Admin') --}}
                                            <a class="  items-center gap-2 text-warning"
                                                href="{{ route('subscription.edit', $subscription->id) }}">
                                                <i class="fas fa-edit text-2xl px-2"></i>
                                            </a>
                                            {{-- @endif --}}
                                        </td>

                                        {{-- <td class="relative">
                                            <div class="dropdown dropdown-end">
                                                <button tabindex="0" class="btn btn-sm btn-ghost">
                                                    <i class="fas fa-ellipsis-v text-lg"></i>
                                                </button>
                                                <ul tabindex="0"
                                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-36">
                                                    <li>
                                                        <a href="{{ route('subscription.show', $subscription->id) }}"
                                                            class="flex items-center gap-2 text-info">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('subscription.edit', $subscription->id) }}"
                                                            class="flex items-center gap-2 text-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="bg-white" x-show="openTab === 2">
                        {{-- <div class="text-end">
                            <a href="{{ route('subscription.create') }}" class="btn btn-success text-white">
                                Farmer Subscription
                            </a>
                        </div> --}}

                        <table id="Users_Table" class="table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Total Subscriptions</th>
                                    <th>Total Amount</th>
                                    {{-- <th>Payments By</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users_subscriptionsData as $index => $user_subscription)
                                    @php
                                        $usertotalamt = 0;
                                        foreach ($user_subscription->farms as $user_farm) {
                                            foreach ($user_farm->subscriptions as $user_farmSubscription) {
                                                if ($user_farmSubscription->payment_status === 'completed') {
                                                    $usertotalamt += $user_farmSubscription->amount;
                                                }
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user_subscription->name ?? 'N/A' }}</td>
                                        <td>{{ $user_subscription->mobile ?? 'N/A' }}</td>
                                        <td>{{ $user_subscription->email ?? 'N/A' }}</td>
                                        <td x-data="{ loading: false, userData: null }">
                                            <button class="btn btn-ghost text-secondary underline"
                                                @click="
                                                loading = true;
                                                userData = {{ json_encode($user_subscription) }};
                                                $dispatch('open-modal', 'user_subscriptions_modal_{{ $user_subscription->id }}');
                                                loading = false;
                                            ">
                                                {{ $user_subscription->total_subscriptions_count }}
                                            </button>

                                            <x-modal maxWidth="7xl"
                                                name="user_subscriptions_modal_{{ $user_subscription->id }}" focusable>
                                                <div class="p-4 overflow-x-auto">
                                                    <h3 class="text-lg font-bold">Subscription Details</h3>
                                                    <table
                                                        class="table mt-4 w-full border-collapse border border-gray-300">
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th class="border p-2">#</th>
                                                                <th class="border p-2">Subscription ID</th>
                                                                <th class="border p-2">Farm ID</th>
                                                                <th class="border p-2">Farm Name</th>
                                                                <th class="border p-2">Farm Area</th>
                                                                <th class="border p-2">Crop Type</th>
                                                                <th class="border p-2">Subscription Type</th>
                                                                <th class="border p-2">Subscription Name</th>
                                                                <th class="border p-2">Subscription Duration</th>
                                                                <th class="border p-2">Amount</th>
                                                                <th class="border p-2">Start Date</th>
                                                                <th class="border p-2">End Date</th>
                                                                <th class="border p-2">Payment Status</th>
                                                                <th class="border p-2">Subscription Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template x-if="userData">
                                                                <template
                                                                    x-for="(user, index) in userData.farms.flatMap(farm => 
                                                                    farm.subscriptions.map(sub => ({...sub, farm})))"
                                                                    :key="user.id">
                                                                    <tr>
                                                                        <td class="border p-2" x-text="index + 1">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscription_code ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.farm.farm_id"></td>
                                                                        <td class="border p-2"
                                                                            x-text="user.farm.name">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.farm.area ? Math.floor(parseFloat(user.farm.area) * 10) / 10 : '0.0'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="user.farm.croptype"></td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                                        ? 'Package' 
                                                                                        : 'Premium Services'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.name ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.duration_labels ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.amount ?? 'N/A'"></td>
                                                                        <td class="border p-2"
                                                                            x-text="user.starts_at 
                                                                                ? new Date(user.starts_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.expires_at 
                                                                                ? new Date(user.expires_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>



                                                                        <td class="border p-2"
                                                                            x-text="user.payment_status 
                                                                                        ? user.payment_status.charAt(0).toUpperCase() + user.payment_status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.status 
                                                                                        ? user.status.charAt(0).toUpperCase() + user.status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>

                                                            {{-- <template x-if="userData">
                                                                <template x-for="farm in userData.farms" :key="farm.id">
                                                                    <template x-for="(subscription) in farm.subscriptions" :key="subscription.id">
                                                                        <tr>
                                                                            <td class="border p-2" x-text="subscription.id"></td> <!-- Increment globally -->
                                                            
                                                                            <td class="border p-2" x-text="subscription.subscription_code ?? 'N/A'"></td>
                                                            
                                                                            <td class="border p-2" x-text="farm.farm_id"></td>
                                                                            <td class="border p-2" x-text="farm.name"></td>
                                                                            <td class="border p-2" x-text="farm.croptype"></td>
                                                            
                                                                            <td class="border p-2"
                                                                                x-text="subscription.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                                        ? 'Package' 
                                                                                        : 'Premium Services'">
                                                                            </td>
                                                            
                                                                            <td class="border p-2" x-text="subscription.subscribable?.name ?? 'N/A'"></td>
                                                                            <td class="border p-2" x-text="subscription.subscribable?.duration_labels ?? 'N/A'"></td>
                                                            
                                                                            <td class="border p-2" x-text="subscription.amount ?? 'N/A'"></td>
                                                                            <td class="border p-2"
                                                                                x-text="subscription.starts_at 
                                                                                        ? subscription.starts_at.split(' ')[0].split('-').reverse().join('-') 
                                                                                        : 'N/A'">
                                                                            </td>
                                                                            <td class="border p-2"
                                                                                x-text="subscription.expires_at 
                                                                                        ? subscription.expires_at.split(' ')[0].split('-').reverse().join('-') 
                                                                                        : 'N/A'">
                                                                            </td>
                                                            
                                                                            <td class="border p-2"
                                                                                x-text="subscription.payment_status 
                                                                                        ? subscription.payment_status.charAt(0).toUpperCase() + subscription.payment_status.slice(1) 
                                                                                        : 'N/A'">
                                                                            </td>
                                                                            <td class="border p-2"
                                                                                x-text="subscription.status 
                                                                                        ? subscription.status.charAt(0).toUpperCase() + subscription.status.slice(1) 
                                                                                        : 'N/A'">
                                                                            </td>
                                                                        </tr>
                                                                    </template>
                                                                </template>
                                                            </template> --}}

                                                            {{-- <template x-if="userData">

                                                                <template x-for="(farm, index) in userData.farms"
                                                                    :key="farm.id">

                                                                    <div x-init="console.log(userData)">

                                                                    </div>
                                                                    <tr>
                                                                        <td class="border p-2" x-text="index + 1">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions.length ? farm.subscriptions[0].subscription_code : 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2" x-text="farm.farm_id">
                                                                        </td>
                                                                        <td class="border p-2" x-text="farm.name">
                                                                        </td>
                                                                        <td class="border p-2" x-text="farm.croptype">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                            ? 'Package' 
                                                                            : 'Premium Services'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions[0].subscribable?.name ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions[0].subscribable?.duration_labels ?? 'N/A'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.amount ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.starts_at ? farm.subscriptions[0].starts_at.split(' ')[0].split('-').reverse().join('-') : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.expires_at ? farm.subscriptions[0].expires_at.split(' ')[0].split('-').reverse().join('-') : 'N/A'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.payment_status 
                                                                            ? farm.subscriptions[0].payment_status.charAt(0).toUpperCase() + farm.subscriptions[0].payment_status.slice(1) 
                                                                            : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="farm.subscriptions?.[0]?.status 
                                                                            ? farm.subscriptions[0].status.charAt(0).toUpperCase() + farm.subscriptions[0].status.slice(1) 
                                                                            : 'N/A'">
                                                                        </td>


                                                                    </tr>
                                                                </template>
                                                            </template> --}}


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </x-modal>
                                        </td>

                                        <td>{{   number_format($usertotalamt, 2) }}</td>
                                        {{-- <td>{{ ucfirst($user_paymendata->gateway_name) ?? 'N/A' }}</td> --}}

                                        <td>
                                            <a class="  items-center gap-2 text-info"
                                                href="{{ route('user_subscription.show', $user_subscription->id) }}">
                                                <i class="fas fa-eye text-2xl px-2"></i>
                                            </a>
                                        </td>

                                        {{-- <td class="relative">
                                            <div class="dropdown dropdown-end">
                                                <button tabindex="0" class="btn btn-sm btn-ghost">
                                                    <i class="fas fa-ellipsis-v text-lg"></i>
                                                </button>
                                                <ul tabindex="0"
                                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-36">
                                                    <li>
                                                        <a href="{{ route('subscription.show', $subscription->id) }}"
                                                            class="flex items-center gap-2 text-info">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('subscription.edit', $subscription->id) }}"
                                                            class="flex items-center gap-2 text-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>


                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        timer: 7000, // Auto close after 3 seconds
                        showConfirmButton: false
                    });
                @endif

                @if (session('error'))

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: "{{ session('error') }}",
                        showConfirmButton: true, // ✅ "OK" button enable
                        confirmButtonText: "OK" // ✅ Custom "OK" button text
                    });
                @endif

            });
        </script>




        <script>
            document.addEventListener('alpine:init', () => {
                let dt = new DataTable("#Admins_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    paging: true,
                    // scrollX: true,
                    // scrollY: "550px",
                    // scrollCollapse: false,
                    // autoWidth: false,
                    layout: {
                        topStart: {
                            buttons: [{
                                    extend: "pageLength",
                                },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Admin Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },
                                },
                                {
                                    extend: "print",
                                    text: "Print",
                                    title: "KisanSat (Admin Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    }
                                },
                            ],
                        },
                    }
                });

                // // 🔹 Fix misalignment after table is drawn
                // dt.on("draw", function() {
                //     setTimeout(function() {
                //         dt.columns.adjust().draw();
                //     }, 200);
                // });

                // // 🔹 Fix misalignment when window resizes
                // $(window).on("resize", function() {
                //     dt.columns.adjust().draw();
                // });

                // // 🔹 Force DataTable to adjust column widths correctly
                // setTimeout(() => {
                //     dt.columns.adjust().draw();
                // }, 500);
            });
            document.addEventListener('alpine:init', () => {
                let dt = new DataTable("#Users_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    paging: true,
                    layout: {
                        topStart: {
                            buttons: [{
                                    extend: "pageLength",
                                },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Mobile Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },

                                },
                                {
                                    extend: "print",
                                    text: "Print",
                                    title: "KisanSat (Mobile Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    }
                                },
                            ],
                        },
                    }
                });

                // // 🔹 Fix misalignment after table is drawn
                // dt.on("draw", function() {
                //     setTimeout(function() {
                //         dt.columns.adjust().draw();
                //     }, 200);
                // });

                // // 🔹 Fix misalignment when window resizes
                // $(window).on("resize", function() {
                //     dt.columns.adjust().draw();
                // });

                // // 🔹 Force DataTable to adjust column widths correctly
                // setTimeout(() => {
                //     dt.columns.adjust().draw();
                // }, 500);
            });
        </script>

</x-app-layout>
