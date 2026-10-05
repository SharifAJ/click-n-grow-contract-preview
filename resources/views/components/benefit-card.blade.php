@props([
    'backgroundImage' => asset('images/hero_placeholder_img2.webp'),
    'afterValue' => '',
    'beforeValue' => '',
    'value' => '',
    'description' => '',
])

<div class="group card h-72 w-full max-w-sm shadow-xl transition-all hover:scale-105" style="--gradient-stop-2:50%;"
	{{ $attributes }}>
	<div
		class="card-body relative flex flex-col justify-end overflow-hidden rounded-2xl bg-cover bg-center px-6 py-3 transition-all duration-500 ease-in-out group-hover:[--gradient-stop-2:100%]"
		style="background-image: linear-gradient(10deg, rgba(2,0,36,0.9) 10%, rgba(0,0,0,0) var(--gradient-stop-2)), url('{{ $backgroundImage }}');">

		<div class="card-content transition-all duration-500 ease-in-out">
			<p class="text-lg font-semibold text-white transition-all duration-500 ease-in-out">
				{{ $beforeValue }}
			</p>
			<p class="counter mt-1 text-5xl font-black text-white transition-all duration-500 ease-in-out">
				{{ $value }}
			</p>
			<p class="counter mt-1 text-lg font-semibold text-white transition-all duration-500 ease-in-out">
				{{ $afterValue }}
			</p>
		</div>

		<!-- Smoothly Slide-Up Description -->
		<p
			class="mt-3 max-h-0 overflow-hidden font-medium text-white opacity-0 transition-all duration-500 ease-in-out group-hover:max-h-[100px] group-hover:opacity-100">
			{{ $description }}
		</p>
	
	</div>
</div>
