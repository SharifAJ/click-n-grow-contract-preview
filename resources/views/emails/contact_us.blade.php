<x-mail::message>
    # You have received a new message from a user.

    User Details 
    Name: {{ $contactData['name'] }}
    Email: {{ $contactData['email'] }}
    Mobile: {{ $contactData['mobile'] ?? 'N/A' }}
    Address: {{ $contactData['address'] ?? 'N/A' }}

    Message
    {{ $contactData['message'] }}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
