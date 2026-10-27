<x-guest-layout brand="click-n-grow">
    <section class="trading-export-hero trading-enquiry-hero" aria-labelledby="trading-enquiry-title">
        <img class="trading-export-hero__image" src="{{ asset('images/crop.png') }}"
            alt="Herbal crops and raw materials" fetchpriority="high">
        <div class="trading-export-hero__wash" aria-hidden="true"></div>
        <div class="trading-export-hero__content">
            <p class="trading-export-hero__eyebrow">Trading &amp; Export</p>
            <h1 class="trading-export-hero__title" id="trading-enquiry-title">Trade Inquiry Form</h1>
            <p class="trading-export-hero__description">
                Tell us about your raw material requirements or partnership opportunity. Share your details below
                and our team will get in touch with you.
            </p>
        </div>
    </section>

    <section class="trading-export-highlights" aria-label="Trading and export advantages">
        <div class="trading-export-highlights__grid">
            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-leaf"></i>
                </span>
                <h2 class="trading-export-highlight__title">Wide Range of Herbal Crops</h2>
                <p class="trading-export-highlight__description">
                    14+ herbal crops sourced from our farmer network.
                </p>
            </article>
            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-certificate"></i>
                </span>
                <h2 class="trading-export-highlight__title">Reliable Quality</h2>
                <p class="trading-export-highlight__description">
                    Quality checked and processed as per industry standards.
                </p>
            </article>
            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-truck"></i>
                </span>
                <h2 class="trading-export-highlight__title">Consistent Supply</h2>
                <p class="trading-export-highlight__description">
                    Scalable supply from 500+ farmers across 10+ states.
                </p>
            </article>
            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-globe"></i>
                </span>
                <h2 class="trading-export-highlight__title">Domestic &amp; Global Reach</h2>
                <p class="trading-export-highlight__description">
                    Supplying to leading herbal companies in India and international markets.
                </p>
            </article>
        </div>
    </section>

    <div class="expert-registration trading-enquiry">
        <div class="expert-registration__layout">
            <form class="expert-registration__form" method="POST" action="{{ route('trading-enquiry-form.store') }}">
                @csrf
                <header class="trading-enquiry__form-header">
                    <span class="trading-enquiry__form-icon" aria-hidden="true">
                        <i class="fas fa-handshake"></i>
                    </span>
                    <div>
                        <h2>Business Inquiry / Partnership Registration</h2>
                        <p>Connect with us for bulk supply, sourcing, export opportunities or to become a business associate in your region.</p>
                    </div>
                </header>

                @if (session('success'))
                    <p class="expert-registration__message is-success">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <p class="expert-registration__message is-error">Please review the highlighted fields and try again.</p>
                @endif

                <section class="expert-registration__section" aria-labelledby="trading-org-title">
                    <h3 id="trading-org-title"><span>1.</span> Organization Details</h3>
                    <div class="expert-registration__fields expert-registration__fields--two">
                        <label class="expert-registration__field">Company / Organization Name *
                            <input name="company_name" value="{{ old('company_name') }}" maxlength="255"
                                placeholder="Enter company name" required>
                            @error('company_name')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Type of Organization *
                            <select name="organization_type" required>
                                <option value="">Select type</option>
                                @foreach ($organizationTypes as $type)
                                    <option value="{{ $type }}" @selected(old('organization_type') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('organization_type')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Contact Person Name *
                            <input name="contact_person_name" value="{{ old('contact_person_name') }}" maxlength="150"
                                placeholder="Enter contact person name" required>
                            @error('contact_person_name')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Designation *
                            <input name="designation" value="{{ old('designation') }}" maxlength="150"
                                placeholder="Enter designation" required>
                            @error('designation')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Email Address *
                            <input name="email" type="email" value="{{ old('email') }}" maxlength="150"
                                placeholder="Enter email address" required>
                            @error('email')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Mobile Number *
                            <span class="trading-enquiry__phone">
                                <input name="mobile_country_code" value="{{ old('mobile_country_code', '+91') }}"
                                    maxlength="8" aria-label="Country code">
                                <input name="mobile" type="tel" inputmode="numeric" value="{{ old('mobile') }}"
                                    pattern="[6-9][0-9]{9}" maxlength="10" placeholder="Enter mobile number" required>
                            </span>
                            @error('mobile')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field trading-enquiry__field--full">Website (Optional)
                            <input name="website" value="{{ old('website') }}" maxlength="255"
                                placeholder="Enter website URL">
                            @error('website')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                    </div>
                </section>

                <section class="expert-registration__section" aria-labelledby="trading-business-title">
                    <h3 id="trading-business-title"><span>2.</span> Business Details</h3>
                    <div class="expert-registration__fields expert-registration__fields--two">
                        <label class="expert-registration__field">Business Type *
                            <select name="business_type" required>
                                <option value="">Select business type</option>
                                @foreach ($businessTypes as $type)
                                    <option value="{{ $type }}" @selected(old('business_type') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('business_type')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Products You Are Interested In *
                            <select name="product_interest" required>
                                <option value="">Select herbal crops / products</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product }}" @selected(old('product_interest') === $product)>{{ $product }}</option>
                                @endforeach
                            </select>
                            @error('product_interest')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Expected Quantity (Annual) *
                            <select name="expected_quantity" required>
                                <option value="">Select quantity</option>
                                @foreach ($quantities as $value => $label)
                                    <option value="{{ $value }}" @selected(old('expected_quantity') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('expected_quantity')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <fieldset class="expert-registration__field">
                            <legend>Purpose of Inquiry *</legend>
                            <div class="trading-enquiry__purposes">
                                @foreach ($purposes as $value => $label)
                                    <label>
                                        <input type="checkbox" name="inquiry_purposes[]" value="{{ $value }}"
                                            @checked(in_array($value, old('inquiry_purposes', []), true))>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            @error('inquiry_purposes')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </fieldset>
                    </div>
                </section>

                <section class="expert-registration__section" aria-labelledby="trading-address-title">
                    <h3 id="trading-address-title"><span>3.</span> Address Details</h3>
                    <div class="expert-registration__fields expert-registration__fields--two">
                        <label class="expert-registration__field trading-enquiry__field--full">Company Address *
                            <input name="company_address" value="{{ old('company_address') }}" maxlength="500"
                                placeholder="Enter complete address" required>
                            @error('company_address')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">City *
                            <input name="city" value="{{ old('city') }}" maxlength="120" placeholder="Enter city" required>
                            @error('city')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">State *
                            <select name="state" required>
                                <option value="">Enter state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                                @endforeach
                            </select>
                            @error('state')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Country *
                            <select name="country" required>
                                <option value="">Select country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}" @selected(old('country', 'India') === $country)>{{ $country }}</option>
                                @endforeach
                            </select>
                            @error('country')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                        <label class="expert-registration__field">Pincode *
                            <input name="pincode" value="{{ old('pincode') }}" maxlength="20"
                                placeholder="Enter pincode" required>
                            @error('pincode')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                    </div>
                </section>

                <section class="expert-registration__section" aria-labelledby="trading-additional-title">
                    <h3 id="trading-additional-title"><span>4.</span> Additional Information</h3>
                    <div class="expert-registration__fields">
                        <label class="expert-registration__field">Tell Us About Your Requirements *
                            <textarea name="requirements" rows="4" maxlength="2000" placeholder="Enter your requirements, specifications or any other details" required>{{ old('requirements') }}</textarea>
                            @error('requirements')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        </label>
                    </div>
                    <div class="trading-enquiry__footer">
                        <label class="expert-registration__consent">
                            <input type="checkbox" name="consent" value="1" @checked(old('consent')) required>
                            I agree to be contacted by ClickN Grow Agroventures Pvt Ltd regarding this inquiry. *
                        </label>
                        @error('consent')<span class="trading-enquiry__error">{{ $message }}</span>@enderror
                        <button class="expert-registration__pay-button" type="submit">Submit Inquiry</button>
                    </div>
                </section>
            </form>

            <aside class="expert-registration__sidebar">
                <section class="expert-registration__side-card" aria-labelledby="trading-capabilities-title">
                    <h2 id="trading-capabilities-title">
                        <i class="fas fa-seedling" aria-hidden="true"></i>
                        Our Trading &amp; Export Capabilities
                    </h2>
                    <ul class="trading-enquiry__capabilities">
                        <li>
                            <i class="fas fa-leaf" aria-hidden="true"></i>
                            <span>
                                <strong>Wide Range of Herbal Crops</strong>
                                14+ medicinal and aromatic plants
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-certificate" aria-hidden="true"></i>
                            <span>
                                <strong>Quality &amp; Traceability</strong>
                                Strict quality checks and full traceability from farm to delivery
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-boxes" aria-hidden="true"></i>
                            <span>
                                <strong>Bulk Supply Capacities</strong>
                                Consistent and scalable supply from our farmer network
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-box-open" aria-hidden="true"></i>
                            <span>
                                <strong>Custom Packaging</strong>
                                As per buyer requirements
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-globe" aria-hidden="true"></i>
                            <span>
                                <strong>Domestic &amp; International Supply</strong>
                                Supplying to leading herbal companies across India and global markets
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-file-alt" aria-hidden="true"></i>
                            <span>
                                <strong>Documentation Support</strong>
                                Export documentation and compliance assistance
                            </span>
                        </li>
                    </ul>
                </section>

                <div class="trading-enquiry__photo" role="img" aria-label="Bulk herbal products prepared for shipping and export">
                    <div class="trading-export-shipping">
                        <div class="trading-export-shipping__sun" aria-hidden="true"></div>
                        <div class="trading-export-shipping__containers" aria-hidden="true">
                            <span class="trading-export-shipping__container trading-export-shipping__container--red"></span>
                            <span class="trading-export-shipping__container trading-export-shipping__container--blue"></span>
                            <span class="trading-export-shipping__container trading-export-shipping__container--gold"></span>
                            <span class="trading-export-shipping__container trading-export-shipping__container--navy"></span>
                        </div>
                        <i class="fas fa-ship trading-export-shipping__ship" aria-hidden="true"></i>
                    </div>
                </div>

                <section class="expert-registration__side-card" aria-labelledby="trading-why-title">
                    <h2 id="trading-why-title">Why Partner With Us?</h2>
                    <ul class="trading-enquiry__why">
                        <li>Reliable and long-term supply partnerships</li>
                        <li>Sustainable and ethically sourced raw materials</li>
                        <li>Quality processing and grading</li>
                        <li>Support for custom requirements</li>
                        <li>Transparent and professional communication</li>
                    </ul>
                </section>
            </aside>
        </div>
    </div>
</x-guest-layout>
