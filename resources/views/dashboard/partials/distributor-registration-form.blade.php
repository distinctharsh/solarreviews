@php
    $labelClass = 'block text-sm font-semibold text-slate-700 mb-1';
    $productInterests = [
        'Solar Panels',
        'Inverters',
        'Batteries',
        'Mounting Structures',
        'Solar Water Pumps',
        'Solar Street Lights',
        'EV Charging Solutions',
    ];
@endphp

<section class="bg-white rounded-2xl shadow p-6 space-y-8">
    <div class="flex flex-col gap-2">
        <p class="text-sm text-slate-500">Distributor / Dealer Intake</p>
        <h3 class="text-2xl font-semibold text-slate-900">Tell us about your sales reach</h3>
        <p class="text-sm text-slate-500">We’ll surface your profile to OEMs and EPCs once verification is done.</p>
    </div>

    <form method="POST" action="#" enctype="multipart/form-data" class="space-y-10">
        @csrf

        {{-- Business Information --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">1. Business Information</h4>
                <p class="text-sm text-slate-500">Let’s start with your firm’s basics.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Company / Firm Name</label>
                    <input type="text" name="company_name" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400" required>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Business Type</label>
                    <select name="business_type" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400" required>
                        <option value="">Select</option>
                        <option>Distributor</option>
                        <option>Dealer</option>
                        <option>Reseller</option>
                    </select>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Year of Establishment</label>
                    <input type="number" name="year_of_establishment" min="1950" max="{{ now()->year }}" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Registered Address</label>
                    <textarea name="registered_address" rows="2" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Operating Region(s) / Territory Interested</label>
                    <textarea name="operating_regions" rows="2" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">GST Number</label>
                    <input type="text" name="gst_number" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">PAN Number</label>
                    <input type="text" name="pan_number" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">UDYAM / MSME Number (optional)</label>
                    <input type="text" name="msme_number" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Owner / Key Contact Details --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">2. Owner / Key Contact Details</h4>
                <p class="text-sm text-slate-500">Who should we connect with?</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Owner / Proprietor Name</label>
                    <input type="text" name="owner_name" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Mobile Number</label>
                    <input type="tel" name="owner_mobile" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Email Address</label>
                    <input type="email" name="owner_email" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Sales Manager Contact (if applicable)</label>
                    <input type="text" name="sales_manager_contact" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Office Landline</label>
                    <input type="text" name="office_landline" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Product Interest --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">3. Product Interest</h4>
                <p class="text-sm text-slate-500">Choose categories you plan to source.</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                @foreach($productInterests as $interest)
                    <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-700 hover:border-amber-400">
                        <input type="checkbox" name="product_interests[]" value="{{ $interest }}" class="text-amber-500 border-slate-300">
                        {{ $interest }}
                    </label>
                @endforeach
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Expected Monthly Sales Volume</label>
                    <input type="text" name="monthly_sales_volume" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Existing Solar Product Lines (if any)</label>
                    <input type="text" name="existing_product_lines" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Sales & Distribution Capabilities --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">4. Sales & Distribution Capabilities</h4>
                <p class="text-sm text-slate-500">Help us understand your reach.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">On-ground Team Size</label>
                    <input type="number" name="team_size" min="0" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Warehouse Availability & Capacity</label>
                    <textarea name="warehouse_capacity" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Logistics Tie-ups</label>
                    <textarea name="logistics_tieups" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Service Team Available?</label>
                    <select name="service_team" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                        <option value="">Select</option>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Market Coverage (districts / states)</label>
                    <textarea name="market_coverage" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
            </div>
        </div>

        {{-- Financial Details --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">5. Financial Details</h4>
                <p class="text-sm text-slate-500">Share your commercial preferences.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Annual Turnover</label>
                    <input type="text" name="annual_turnover" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Preferred Credit Terms</label>
                    <input type="text" name="credit_terms" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Last 2 Years’ Financial Statements (upload)</label>
                    <input type="file" name="financial_statements" accept=".pdf,.xlsx" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Bank Name</label>
                    <input type="text" name="bank_name" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Account Number</label>
                    <input type="text" name="account_number" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">IFSC Code</label>
                    <input type="text" name="ifsc_code" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Certifications & Compliance --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">6. Certifications & Compliance</h4>
                <p class="text-sm text-slate-500">Upload proof of compliance.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Trade License (upload)</label>
                    <input type="file" name="trade_license" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">GST Certificate (upload)</label>
                    <input type="file" name="gst_certificate" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tax Clearance (if applicable)</label>
                    <input type="file" name="tax_clearance" accept=".pdf,.jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Agreement to Distributor Policy</label>
                    <label class="inline-flex items-center gap-2 text-sm text-slate-700 mt-2">
                        <input type="checkbox" name="distributor_policy" class="text-amber-500 border-slate-300" required>
                        I agree to follow Solar Reviews distributor policy.
                    </label>
                </div>
            </div>
        </div>

        {{-- Past Experience --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">7. Past Experience</h4>
                <p class="text-sm text-slate-500">Share notable partnerships.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Existing Brands Distributed</label>
                    <textarea name="existing_brands" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Years of Distribution Experience</label>
                    <input type="number" name="distribution_experience_years" min="0" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Reference Clients / Companies</label>
                    <textarea name="reference_clients" rows="3" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400"></textarea>
                </div>
            </div>
        </div>

        {{-- Additional Documents --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">8. Additional Documents</h4>
                <p class="text-sm text-slate-500">Optional uploads that improve credibility.</p>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Company Profile (upload)</label>
                    <input type="file" name="company_profile" accept=".pdf" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
                <div>
                    <label class="{{ $labelClass }}">Office / Warehouse Photos (optional)</label>
                    <input type="file" name="office_photos" accept=".jpg,.png" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400" multiple>
                </div>
                <div>
                    <label class="{{ $labelClass }}">Visiting Card (upload)</label>
                    <input type="file" name="visiting_card" accept=".jpg,.png,.pdf" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                </div>
            </div>
        </div>

        {{-- Declaration --}}
        <div class="space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-slate-900">9. Declaration</h4>
                <p class="text-sm text-slate-500">Final confirmation.</p>
            </div>
            <div class="space-y-4">
                <label class="inline-flex items-start gap-3 text-sm text-slate-700">
                    <input type="checkbox" name="information_accuracy" required class="mt-1 text-amber-500 border-slate-300">
                    <span>Confirmation of Information Accuracy</span>
                </label>
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="{{ $labelClass }}">e-Signature</label>
                        <input type="text" name="e_signature" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="{{ $labelClass }}">Date</label>
                        <input type="date" name="declaration_date" class="w-full rounded-xl border-slate-200 focus:border-amber-400 focus:ring-amber-400">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between flex-wrap gap-4">
            <p class="text-sm text-slate-500">Submissions are reviewed within 72 hours.</p>
            <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700">Submit Distributor Profile</button>
        </div>
    </form>
</section>
