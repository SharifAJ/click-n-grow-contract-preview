<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Career Applications</h2></x-slot>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="overflow-x-auto rounded-lg bg-white p-5 shadow">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead><tr class="border-b text-gray-600"><th class="p-3">Applicant</th><th class="p-3">Contact</th><th class="p-3">Position</th><th class="p-3">Qualification</th><th class="p-3">Experience</th><th class="p-3">Resume</th><th class="p-3">Submitted</th></tr></thead>
                <tbody class="divide-y">
                    @forelse ($applications as $application)
                        <tr><td class="p-3 font-semibold">{{ $application->full_name }}<span class="block font-normal text-gray-500">{{ $application->city_state }}</span></td><td class="p-3">{{ $application->mobile_number }}<span class="block">{{ $application->email }}</span></td><td class="p-3">{{ $application->position }}</td><td class="p-3">{{ $application->highest_qualification }}<span class="block">{{ $application->specialization }}</span></td><td class="p-3">{{ $application->work_experience ?: '—' }}</td><td class="p-3"><a class="font-semibold text-emerald-700 underline" href="{{ route('admin.careers.resume', $application) }}">Download resume</a></td><td class="p-3">{{ $application->created_at->format('d M Y') }}</td></tr>
                    @empty
                        <tr><td colspan="7" class="p-8 text-center text-gray-500">No applications have been submitted.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">{{ $applications->links() }}</div>
        </div>
    </div>
</x-app-layout>
