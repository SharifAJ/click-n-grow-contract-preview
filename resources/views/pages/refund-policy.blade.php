<x-guest-layout>
    <div class="container prose mb-20 mt-3 max-w-5xl px-4 sm:px-6 lg:px-8">
        <x-page-header :title="__('messages.refund_policy_title')" />

        <h2 class="text-xl font-semibold">{{ __('messages.refund_policy_title') }}</h2>
        <p class="text-justify">{!! __('messages.refund_policy_intro') !!}</p>

        <h3 class="mt-6 text-lg font-semibold">{{ __('messages.refund_policy_refunds_title') }}</h3>
        <ol class="list-decimal space-y-2 pl-5" type="1">
            @foreach (__('messages.refund_policy_refunds_list') as $item)
                <li>{!! $item !!}</li>
            @endforeach
        </ol>

        <h3 class="mt-6 text-lg font-semibold">{{ __('messages.refund_policy_late_title') }}</h3>
        <ol class="list-decimal space-y-2 pl-5" type="1">
            @foreach (__('messages.refund_policy_late_list') as $item)
                <li>{!! $item !!}</li>
            @endforeach
        </ol>

        <h3 class="mt-6 text-lg font-semibold">{{ __('messages.refund_policy_law_title') }}</h3>
        <ol class="list-decimal space-y-2 pl-5" type="1">
            @foreach (__('messages.refund_policy_law_list') as $item)
                <li>{!! $item !!}</li>
            @endforeach
        </ol>
    </div>
</x-guest-layout>
