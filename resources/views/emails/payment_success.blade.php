<x-mail::message>
# Subscription Successful 🎉  
<sub>(Transaction ID: <b>{{ $paymentTransaction->transaction_id }}</b>)</sub>

Hello **{{ $paymentTransaction->user->name }}**,

Your subscription has been successfully activated! 🎊

## Transaction Details:
- **Transaction ID:** {{ $paymentTransaction->transaction_id }}
- **Amount Paid:** ₹{{ $paymentTransaction->amount }}
- **Payment Method:** {{ $paymentTransaction->payment_method ?? 'Not Provided' }}
- **Payment Date:** {{ \Carbon\Carbon::parse($paymentTransaction->created_at)->format('d M, Y') }}

## Items Purchased:
<x-mail::panel>
@if (!empty($paymentTransaction->items))
@foreach ($paymentTransaction->items as $item)
- **Farm ID:** {{ $item['farm_id'] ?? 'N/A' }}
- **Farm Name:** {{ $item['farm_name'] ?? 'N/A' }}
- **Item Name:** {{ $item['item_name'] ?? 'N/A' }}
- **Quantity:** {{ $item['quantity'] ?? 'N/A' }}
- **Amount:** ₹{{ $item['amount'] ?? 'N/A' }}
---
@endforeach
@else
No items found.
@endif
</x-mail::panel>

<x-mail::button :url="url('/')">
Visit our website
</x-mail::button>

If you have any questions, feel free to contact us at <br>
**{{ $setting->phone_number ?? 'Support Contact' }}**.

Thanks,  
**{{ config('app.name') }}**
</x-mail::message>
