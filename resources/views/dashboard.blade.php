@php($user = auth()->user())

@if($user?->is_admin)
    <script>
        window.location.href = '{{ route('admin.dashboard') }}';
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <div>
                    <p class="text-sm text-slate-500">Welcome back</p>
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                        {{ $user?->name ?? 'Dashboard' }}
                    </h2>
                </div>
                <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-amber-100 text-amber-700">
                    {{ ucfirst($user?->user_type ?? 'member') }} account
                </span>
            </div>
        </x-slot>

        <div class="py-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                {{-- Profile completion + quick actions --}}
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Onboarding checklist</p>
                                <h3 class="text-lg font-semibold text-slate-900">Complete your company profile</h3>
                                <p class="text-sm text-slate-500 mt-1">Add business details so prospects can trust your listings.</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-slate-900">20%</p>
                                <p class="text-xs text-slate-400">profile complete</p>
                            </div>
                        </div>
                        <div class="mt-4 h-2 w-full bg-slate-100 rounded-full">
                            <div class="h-2 rounded-full bg-gradient-to-r from-amber-400 to-orange-500" style="width:20%"></div>
                        </div>
                        <div class="mt-5">
                            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-amber-500 hover:bg-amber-600 rounded-lg shadow">
                                Finish profile
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-base font-semibold text-slate-900">Quick actions</h3>
                        <div class="space-y-3">
                            <button class="w-full inline-flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 rounded-lg text-sm font-medium text-slate-700">
                                Update contact info
                                <span class="text-slate-400">→</span>
                            </button>
                            <button class="w-full inline-flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 rounded-lg text-sm font-medium text-slate-700">
                                Invite teammates
                                <span class="text-slate-400">→</span>
                            </button>
                            <button class="w-full inline-flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 rounded-lg text-sm font-medium text-slate-700">
                                Contact support
                                <span class="text-slate-400">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Shared stats placeholder --}}
                <div class="grid gap-4 md:grid-cols-3">
                    <div class="bg-white rounded-2xl shadow p-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500">Leads this week</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                        <p class="text-xs text-slate-400 mt-1">Connect your offerings to start receiving leads</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500">Messages</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                        <p class="text-xs text-slate-400 mt-1">We’ll surface buyer inquiries here</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500">Profile views</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                        <p class="text-xs text-slate-400 mt-1">Complete your profile to improve visibility</p>
                    </div>
                </div>

                {{-- Role specific sections --}}
                @if($user?->isManufacturer())
                    <div class="bg-white rounded-2xl shadow p-6 space-y-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Manufacturer workspace</p>
                                <h3 class="text-xl font-semibold text-slate-900">Build trust with installers & distributors</h3>
                            </div>
                            <a href="#" class="text-sm font-semibold text-amber-600">Add product</a>
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Product catalogue</h4>
                                <p class="text-sm text-slate-500 mt-1">List your panels, batteries or inverters so buyers can shortlist you.</p>
                                <button class="mt-3 text-sm font-semibold text-amber-600">Add first product →</button>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Partner requests</h4>
                                <p class="text-sm text-slate-500 mt-1">Track installation partners requesting distribution rights.</p>
                                <button class="mt-3 text-sm font-semibold text-amber-600">Manage requests →</button>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Specs & certifications</h4>
                                <p class="text-sm text-slate-500 mt-1">Upload BIS / IEC certificates to boost credibility.</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Marketplace visibility</h4>
                                <p class="text-sm text-slate-500 mt-1">Publish educational content to appear on comparison pages.</p>
                            </div>
                        </div>
                    </div>
                @elseif($user?->isDistributor())
                    <div class="bg-white rounded-2xl shadow p-6 space-y-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Distributor workspace</p>
                                <h3 class="text-xl font-semibold text-slate-900">Showcase services & win projects</h3>
                            </div>
                            <a href="#" class="text-sm font-semibold text-amber-600">Add service</a>
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Service offerings</h4>
                                <p class="text-sm text-slate-500 mt-1">List EPC, O&M or installation specialities with coverage areas.</p>
                                <button class="mt-3 text-sm font-semibold text-amber-600">Add service →</button>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Lead inbox</h4>
                                <p class="text-sm text-slate-500 mt-1">We’ll route verified homeowner or C&I leads here.</p>
                                <button class="mt-3 text-sm font-semibold text-amber-600">View pipeline →</button>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Manufacturer network</h4>
                                <p class="text-sm text-slate-500 mt-1">Request partnerships with OEMs for preferred pricing.</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <h4 class="font-semibold text-slate-900">Project portfolio</h4>
                                <p class="text-sm text-slate-500 mt-1">Share completed installs to stand out in comparisons.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow p-6">
                        <h3 class="text-xl font-semibold text-slate-900">General member workspace</h3>
                        <p class="text-sm text-slate-500 mt-2">Upgrade your profile to manufacturer or distributor to unlock more tools.</p>
                    </div>
                @endif

                {{-- Activity + resources --}}
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-wide text-slate-500">Activity feed</p>
                                <h3 class="text-xl font-semibold text-slate-900">Latest updates</h3>
                            </div>
                            <button class="text-sm font-semibold text-amber-600">View all</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="mt-1 w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-semibold">01</div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Complete your company overview</p>
                                    <p class="text-xs text-slate-500">Add address, certifications and a short bio so buyers can verify you.</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="mt-1 w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-semibold">02</div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Connect your WhatsApp or support line</p>
                                    <p class="text-xs text-slate-500">We’ll route verified leads directly to your team.</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="mt-1 w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-semibold">03</div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Publish a success story</p>
                                    <p class="text-xs text-slate-500">Feature your latest install or product milestone on comparison pages.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <p class="text-sm uppercase tracking-wide text-slate-500">Need help?</p>
                        <h3 class="text-xl font-semibold text-slate-900">Partner success desk</h3>
                        <p class="text-sm text-slate-500">Our team can help with profile setup, verification and lead curation.</p>
                        <div class="space-y-2 text-sm text-slate-600">
                            <p><span class="font-semibold text-slate-900">Email:</span> support@solarreviews.in</p>
                            <p><span class="font-semibold text-slate-900">Phone:</span> +91-98765-43210</p>
                            <p><span class="font-semibold text-slate-900">Hours:</span> Mon–Sat, 9am–7pm IST</p>
                        </div>
                        <button class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-slate-900 rounded-lg hover:bg-slate-800">Open support ticket</button>
                    </div>
                </div>

                {{-- Learning resources --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div>
                            <p class="text-sm uppercase tracking-wide text-slate-500">Learn & grow</p>
                            <h3 class="text-xl font-semibold text-slate-900">Recommended playbooks</h3>
                            <p class="text-sm text-slate-500">Short guides curated for {{ $user?->isManufacturer() ? 'manufacturers' : ($user?->isDistributor() ? 'service providers' : 'members') }}.</p>
                        </div>
                        <a href="#" class="text-sm font-semibold text-amber-600">See resource library →</a>
                    </div>
                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <article class="p-4 border border-slate-100 rounded-xl hover:border-amber-200">
                            <p class="text-xs uppercase tracking-wide text-amber-500">Playbook</p>
                            <h4 class="text-base font-semibold text-slate-900 mt-1">Designing tiered pricing for installers</h4>
                            <p class="text-sm text-slate-500 mt-2">Offer slabs that reward reliable partners without hurting margins.</p>
                            <button class="mt-3 text-sm font-semibold text-amber-600">Read guide →</button>
                        </article>
                        <article class="p-4 border border-slate-100 rounded-xl hover:border-amber-200">
                            <p class="text-xs uppercase tracking-wide text-blue-500">Checklist</p>
                            <h4 class="text-base font-semibold text-slate-900 mt-1">What to include in project case studies</h4>
                            <p class="text-sm text-slate-500 mt-2">Capture KPIs, client quotes and site photos to build trust.</p>
                            <button class="mt-3 text-sm font-semibold text-amber-600">Download PDF →</button>
                        </article>
                        <article class="p-4 border border-slate-100 rounded-xl hover:border-amber-200">
                            <p class="text-xs uppercase tracking-wide text-emerald-500">Webinar</p>
                            <h4 class="text-base font-semibold text-slate-900 mt-1">Navigating incentive schemes in 2025</h4>
                            <p class="text-sm text-slate-500 mt-2">Learn how MNRE and state programs impact battery & inverter demand.</p>
                            <button class="mt-3 text-sm font-semibold text-amber-600">Register →</button>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
