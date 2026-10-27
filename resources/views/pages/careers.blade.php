<x-guest-layout brand="click-n-grow">
    <section class="bg-emerald-950 px-5 py-16 text-white sm:py-20">
        <div class="mx-auto max-w-6xl">
            <p class="mb-3 font-bold uppercase tracking-[.18em] text-lime-300">Careers at Click-N-Grow</p>
            <h1 class="max-w-4xl text-4xl font-extrabold leading-tight sm:text-6xl">Join Our Team</h1>
            <p class="mt-6 max-w-3xl text-lg leading-relaxed text-emerald-50">Ready to grow your career while making a real impact on agriculture? Join our dynamic team of passionate professionals, explore exciting opportunities across diverse agricultural sectors, and help us build a greener, smarter, and more prosperous future. Your growth journey starts here—apply today and grow with us!</p>
            <a href="#current-openings" class="mt-8 inline-flex rounded-lg bg-lime-400 px-6 py-3 font-bold text-emerald-950 hover:bg-lime-300">Explore Openings</a>
        </div>
    </section>
    <section class="px-5 py-12 sm:py-16">
        <div class="mx-auto grid max-w-6xl gap-8 md:grid-cols-[1.1fr_.9fr]">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-emerald-700">Grow with purpose</p>
                <h2 class="mt-2 text-3xl font-extrabold text-emerald-950">Build a stronger agricultural ecosystem</h2>
                <p class="mt-4 leading-relaxed text-slate-700">At Click-N-Grow Agroventures Pvt. Ltd., our mission is to build a sustainable and technology-driven agricultural ecosystem that empowers farmers and connects quality agricultural produce to markets. We offer exciting career opportunities across medicinal plant cultivation, contract farming, agri-tech, e-commerce, and herbal trading and exports.</p>
                <p class="mt-4 leading-relaxed text-slate-700">We foster a collaborative, growth-oriented work culture that encourages innovation, learning, teamwork, and meaningful contributions to Indian agriculture.</p>
            </div>
            <div class="rounded-2xl bg-emerald-50 p-6 sm:p-8"><h2 class="text-2xl font-bold text-emerald-950">A collaborative team</h2><p class="mt-3 leading-relaxed text-slate-700">Work across farming, technology, markets, and operations with people who care about practical solutions and long-term impact.</p><a href="#apply" class="mt-5 inline-flex font-bold text-emerald-800 hover:underline">Apply to join us <span class="ml-2" aria-hidden="true">→</span></a></div>
        </div>
    </section>
    <section id="current-openings" class="bg-stone-50 px-5 py-12 sm:py-16">
        <div class="mx-auto max-w-6xl">
            <p class="text-sm font-bold uppercase tracking-widest text-emerald-700">Find your opportunity</p><h2 class="mt-2 text-3xl font-extrabold text-emerald-950">Current Openings</h2>
            <div class="mt-6 overflow-x-auto rounded-xl border border-emerald-100 bg-white shadow-sm"><table class="w-full min-w-[640px] border-collapse text-left">
                <thead class="bg-emerald-900 text-white"><tr><th class="px-5 py-4">Department</th><th class="px-5 py-4">Potential job roles</th></tr></thead>
                <tbody class="divide-y divide-emerald-100 text-slate-700">
                    @foreach ([['Medicinal Plant Contract Farming', 'Agronomist, Agriculture Officer, Field Executive'], ['Farmer Relations', 'Project Coordinator'], ['KisanSAT Agri-Tech', 'Agritech Specialist, App Support'], ['eKisanZone E-commerce', 'E-commerce Executive, Digital Manager'], ['Herbal Trading & Exports', 'Export Executive, Sourcing Manager, Quality Control Executive'], ['Marketing & Business Development', 'Sales Executive, Digital Marketing Executive, Business Development Manager'], ['Operations & Administration', 'Accounts Executive, HR Executive, Operations Coordinator'], ['Training and Internship', 'Agriculture Intern']] as [$department, $roles])
                        <tr><th scope="row" class="px-5 py-4 font-semibold text-emerald-950">{{ $department }}</th><td class="px-5 py-4">{{ $roles }}</td></tr>
                    @endforeach
                </tbody>
            </table></div>
        </div>
    </section>
    <section id="apply" class="px-5 py-12 sm:py-16">
        <div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[.7fr_1.3fr]">
            <div><p class="text-sm font-bold uppercase tracking-widest text-emerald-700">Apply now</p><h2 class="mt-2 text-3xl font-extrabold text-emerald-950">Start your growth journey</h2><p class="mt-4 leading-relaxed text-slate-700">Share your details and resume with our recruitment team. We accept PDF, DOC, and DOCX files up to 5 MB.</p><p class="mt-5 rounded-xl bg-emerald-50 p-4 text-sm leading-relaxed text-emerald-950">We respect the privacy of all applicants. Your information and resume will be used solely for recruitment and related communication, handled securely, and accessible only to authorized personnel. By submitting an application, you consent to the collection and processing of your information in accordance with our <a class="font-semibold underline" href="{{ route('privacy-policy') }}">Privacy Policy</a>.</p></div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
                @if (session('status'))<div role="status" class="mb-5 rounded-lg bg-green-50 p-4 font-semibold text-green-800">{{ session('status') }}</div>@endif
                @if ($errors->any())<div role="alert" class="mb-5 rounded-lg bg-red-50 p-4 text-sm text-red-800">Please review the required fields and your resume file.</div>@endif
                <form method="POST" action="{{ route('careers.store') }}" enctype="multipart/form-data" class="grid gap-5 sm:grid-cols-2">
                    @csrf
                    <label class="text-sm font-semibold text-slate-700">Full name *<input name="full_name" value="{{ old('full_name') }}" required autocomplete="name" class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700">Mobile number *<input name="mobile_number" value="{{ old('mobile_number') }}" required type="tel" autocomplete="tel" class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700">Email address *<input name="email" value="{{ old('email') }}" required type="email" autocomplete="email" class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700">Current city and state *<input name="city_state" value="{{ old('city_state') }}" required autocomplete="address-level2" class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700 sm:col-span-2">Position applied for *<select name="position" required class="mt-1 block w-full rounded-lg border-slate-300"><option value="">Select a role</option>@foreach (['Agronomist', 'Agriculture Officer', 'Field Executive', 'Project Coordinator', 'Agritech Specialist', 'App Support', 'E-commerce Executive', 'Digital Manager', 'Export Executive', 'Sourcing Manager', 'Quality Control Executive', 'Sales Executive', 'Digital Marketing Executive', 'Business Development Manager', 'Accounts Executive', 'HR Executive', 'Operations Coordinator', 'Agriculture Intern'] as $position)<option value="{{ $position }}" @selected(old('position') === $position)>{{ $position }}</option>@endforeach</select></label>
                    <label class="text-sm font-semibold text-slate-700">Highest qualification *<input name="highest_qualification" value="{{ old('highest_qualification') }}" required class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700">Specialization / degree *<input name="specialization" value="{{ old('specialization') }}" required class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700">Total work experience<input name="work_experience" value="{{ old('work_experience') }}" placeholder="For example, 2 years" class="mt-1 block w-full rounded-lg border-slate-300" /></label>
                    <label class="text-sm font-semibold text-slate-700">Resume / CV *<input name="resume" required type="file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="mt-1 block w-full rounded-lg border border-slate-300 p-2 text-sm" /><span class="mt-1 block text-xs font-normal text-slate-500">PDF, DOC, or DOCX; maximum 5 MB.</span></label>
                    <label class="flex items-start gap-3 text-sm text-slate-700 sm:col-span-2"><input name="privacy_consent" value="1" required type="checkbox" @checked(old('privacy_consent')) class="mt-1 rounded border-slate-300 text-emerald-700" /><span>I have read the Privacy Policy and consent to the use of my information for recruitment and related communication. *</span></label>
                    <button type="submit" class="rounded-lg bg-emerald-800 px-6 py-3 font-bold text-white hover:bg-emerald-900 sm:col-span-2 sm:justify-self-start">Submit Application</button>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
