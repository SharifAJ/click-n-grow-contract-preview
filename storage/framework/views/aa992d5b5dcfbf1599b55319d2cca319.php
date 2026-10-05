<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'phoneNumber' => env('SUPPORT_NUMBER'),
    'message' => "Hello, I am interested in learning more about the KisanSAT app and how it can help me in farming. Please share details about its features, benefits, and how I can use it for my crops. Thank you!\n\nनमस्ते, मैं किसानसैट ऐप के बारे में और अधिक जानने में रुचि रखता हूं और यह जानना चाहता हूं कि यह खेती में मेरी कैसे मदद कर सकता है। कृपया इसकी विशेषताओं, लाभों और मैं इसे अपनी फसलों के लिए कैसे उपयोग कर सकता हूं, इसके बारे में विवरण साझा करें। धन्यवाद!",
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'phoneNumber' => env('SUPPORT_NUMBER'),
    'message' => "Hello, I am interested in learning more about the KisanSAT app and how it can help me in farming. Please share details about its features, benefits, and how I can use it for my crops. Thank you!\n\nनमस्ते, मैं किसानसैट ऐप के बारे में और अधिक जानने में रुचि रखता हूं और यह जानना चाहता हूं कि यह खेती में मेरी कैसे मदद कर सकता है। कृपया इसकी विशेषताओं, लाभों और मैं इसे अपनी फसलों के लिए कैसे उपयोग कर सकता हूं, इसके बारे में विवरण साझा करें। धन्यवाद!",
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
	// Format the phone number and message for WhatsApp URL
	$formattedMessage = rawurlencode($message);
	$whatsappWebUrl = "https://web.whatsapp.com/send?phone={$phoneNumber}&text={$formattedMessage}";
	$whatsappMobileUrl = "https://api.whatsapp.com/send?phone={$phoneNumber}&text={$formattedMessage}";
?>

<div class="fixed bottom-4 right-4 z-50">
	<a
		class="animate-float btn btn-success flex h-14 w-14 items-center justify-center rounded-full p-0 shadow-lg transition-colors hover:bg-green-600"
		href="#" onclick="redirectToWhatsApp('<?php echo e($whatsappWebUrl); ?>', '<?php echo e($whatsappMobileUrl); ?>')">
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
<script>
	function redirectToWhatsApp(webUrl, mobileUrl) {
		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			window.location.href = mobileUrl;
		} else {
			window.location.href = webUrl;
		}
	}
</script>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views/components/whats-app-button.blade.php ENDPATH**/ ?>