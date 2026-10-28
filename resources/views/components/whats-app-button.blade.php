@props([
    'phoneNumber' => env('SUPPORT_NUMBER'),
    'message' => "Hello, I am interested in learning more about the KisanSAT app and how it can help me in farming. Please share details about its features, benefits, and how I can use it for my crops. Thank you!\n\nनमस्ते, मैं किसानसैट ऐप के बारे में और अधिक जानने में रुचि रखता हूं और यह जानना चाहता हूं कि यह खेती में मेरी कैसे मदद कर सकता है। कृपया इसकी विशेषताओं, लाभों और मैं इसे अपनी फसलों के लिए कैसे उपयोग कर सकता हूं, इसके बारे में विवरण साझा करें। धन्यवाद!",
])

@php
	// Format the phone number and message for WhatsApp URL
	$formattedMessage = rawurlencode($message);
	$whatsappUrl = "https://wa.me/{$phoneNumber}?text={$formattedMessage}";
@endphp

<div class="fixed bottom-4 right-4 z-50">
	<a
		class="animate-float btn btn-success flex h-14 w-14 items-center justify-center rounded-full p-0 shadow-lg transition-colors hover:bg-green-600"
		href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Chat with Click-N-Grow on WhatsApp" title="Chat with Click-N-Grow on WhatsApp">
		<i class="fab fa-whatsapp text-3xl text-white"></i>
	</a>
</div>

<style>
	@keyframes float {

		0%,
		100% {
			transform: translateY(0);
		}

		50% {
			transform: translateY(-5px);
			/* Adjust this value for more/less movement */
		}
	}

	.animate-float {
		animation: float 2s ease-in-out infinite;
		/* Adjust duration for faster/slower animation */
	}
</style>
