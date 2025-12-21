@php
    $labelClass = 'block text-sm font-semibold text-slate-700 mb-1';
    $supplierProductCategories = [
        'Solar Panels',
        'Inverters',
        'Structures',
        'Batteries',
        'Cables',
        'Switchgear',
        'Other Solar Components',
    ];

    $supplierCommitments = [
        'MOQ Requirements (tick)',
        'Warranty Terms (tick)',
        'After-Sales & Support Availability (tick)',
    ];
@endphp

<section class="bg-white rounded-2xl shadow p-6 space-y-8">
    <div class="flex flex-col gap-2">
        <p class="text-sm text-slate-500">Supplier / Manufacturer Onboarding</p>
        <h3 class="text-2xl font-semibold text-slate-900">Share your EPC capabilities</h3>
        <p class="text-sm text-slate-500">Provide detailed company data so installers and distributors can evaluate you faster.</p>
    </div>

    @if (session('status') === 'supplier-profile-submitted')
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            Supplier profile submitted successfully. Our team will review it shortly.
        </div>
    @endif

    <form method="POST" action="{{ route('dashboard.supplier-profile.store') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf

        {{-- Company Information --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">1. Company Information</h4>
                <p class="text-sm text-slate-500">Tell us about your registered entity.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Company Name*</label>
                    <input type="text" name="company_name" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Registered Business Name*</label>
                    <input type="text" name="registered_name" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Business Type*</label>
                    <select name="business_type" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                        <option value="">Select</option>
                        <option>Manufacturer</option>
                        <option>Trader</option>
                        <option>Service Provider</option>
                        <option>OEM</option>
                        <option>Others</option>
                    </select>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Year of Establishment</label>
                    <input type="number" name="year_of_establishment" min="1950" max="{{ now()->year }}" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Registered Address*</label>
                    <textarea name="registered_address" rows="2" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Corporate Address (if different)*</label>
                    <textarea name="corporate_address" rows="2" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">GST Number*</label>
                    <input type="text" name="gst_number" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">PAN Number</label>
                    <input type="text" name="pan_number" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">CIN / Company Registration Number</label>
                    <input type="text" name="cin_number" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div class="space-y-3">
                    <label class="{{ $labelClass }}">ISO Certifications (Yes/No, upload certificates)*</label>
                    <div class="flex gap-4">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input type="radio" name="iso_certified" value="yes" required class="text-amber-500 border-slate-300">
                            Yes
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input type="radio" name="iso_certified" value="no" required class="text-amber-500 border-slate-300">
                            No
                        </label>
                    </div>
                    <input type="file" name="iso_certificates" accept=".pdf,.png,.jpg" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div class="space-y-3">
                    <label class="{{ $labelClass }}">MSME Registration (Yes/No, upload certificate)</label>
                    <div class="flex gap-4">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input type="radio" name="msme_registered" value="yes" class="text-amber-500 border-slate-300">
                            Yes
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input type="radio" name="msme_registered" value="no" class="text-amber-500 border-slate-300">
                            No
                        </label>
                    </div>
                    <input type="file" name="msme_certificate" accept=".pdf,.png,.jpg" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Contact Details --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">2. Contact Details</h4>
                <p class="text-sm text-slate-500">Primary and alternate points of contact.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Primary Contact Person*</label>
                    <input type="text" name="primary_contact" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Designation*</label>
                    <input type="text" name="primary_designation" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Mobile Number*</label>
                    <input type="tel" name="primary_mobile" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Email Address*</label>
                    <input type="email" name="primary_email" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Alternate Contact Person*</label>
                    <input type="text" name="alternate_contact" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Alternate Mobile Number*</label>
                    <input type="tel" name="alternate_mobile" required class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Website URL</label>
                    <input type="url" name="website_url" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Product / Service Category --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">3. Product / Service Category</h4>
                <p class="text-sm text-slate-500">Select relevant offerings and upload catalogues.</p>
            </div>
            <div class="grid gap-5">
                <div>
                    <label class="{{ $labelClass }}">Type of Products Offered</label>
                    <textarea name="product_types" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    @foreach($supplierProductCategories as $category)
                        <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-700 hover:border-amber-400">
                            <input type="checkbox" name="product_categories[]" value="{{ $category }}" class="text-amber-500 border-slate-300">
                            {{ $category }}
                        </label>
                    @endforeach
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="{{ $labelClass }}">Upload Product Catalogue (pdf)</label>
                        <input type="file" name="product_catalogue" accept=".pdf" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="{{ $labelClass }}">Key Brands Represented</label>
                        <input type="text" name="key_brands" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-3">
                    @foreach($supplierCommitments as $commitment)
                        <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-700 hover:border-amber-400">
                            <input type="checkbox" name="supplier_commitments[]" value="{{ $commitment }}" class="text-amber-500 border-slate-300">
                            {{ $commitment }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Commercial Information --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">4. Commercial Information</h4>
                <p class="text-sm text-slate-500">Explain your commercial policies.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Payment Terms</label>
                    <textarea name="payment_terms" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Lead Time & Delivery Terms</label>
                    <textarea name="lead_time" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Logistics Capabilities</label>
                    <textarea name="logistics_capabilities" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Credit Period Offered (if applicable)</label>
                    <input type="text" name="credit_period" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Compliance & Documentation --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">5. Compliance & Documentation</h4>
                <p class="text-sm text-slate-500">Upload mandatory certificates.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Copy of GST Certificate (upload)</label>
                    <input type="file" name="gst_certificate" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Copy of PAN (upload)</label>
                    <input type="file" name="pan_copy" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Company Profile (upload PDF)</label>
                    <input type="file" name="company_profile" accept=".pdf" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Factory License / Trading License</label>
                    <input type="file" name="factory_license" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Quality Certifications (ISO, BIS, etc.)</label>
                    <input type="file" name="quality_certifications" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Environmental & Safety Certification (if any)</label>
                    <input type="file" name="environment_certifications" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Past Experience --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">6. Past Experience</h4>
                <p class="text-sm text-slate-500">Demonstrate credibility via past work.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Major Clients Served</label>
                    <textarea name="major_clients" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Solar Industry Experience (in years)</label>
                    <input type="number" name="industry_experience_years" min="0" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Completed Projects List (upload)</label>
                    <input type="file" name="projects_list" accept=".pdf,.xlsx,.csv" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Reference Contacts</label>
                    <textarea name="reference_contacts" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
            </div>
        </div>

        {{-- Declarations --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">7. Declarations</h4>
                <p class="text-sm text-slate-500">Confirm compliance statements.</p>
            </div>
            <div class="space-y-4">
                <label class="inline-flex items-start gap-3 text-sm text-slate-700">
                    <input type="checkbox" name="accept_terms" class="mt-1 text-amber-500 border-slate-300">
                    <span>Agreement to Terms & Conditions</span>
                </label>
                <label class="inline-flex items-start gap-3 text-sm text-slate-700">
                    <input type="checkbox" name="anti_bribery" class="mt-1 text-amber-500 border-slate-300">
                    <span>Anti-Bribery / Compliance Declaration</span>
                </label>
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="{{ $labelClass }}">Signature / e-Signature</label>
                        <input type="text" name="signature" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="{{ $labelClass }}">Date</label>
                        <input type="date" name="declaration_date" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between flex-wrap gap-4">
            <p class="text-sm text-slate-500">Your data is securely stored and reviewed within 2 business days.</p>
            <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-amber-500 rounded-xl hover:bg-amber-600" style="background-color: #42c058;">Submit Supplier Details</button>
        </div>
    </form>
</section>
