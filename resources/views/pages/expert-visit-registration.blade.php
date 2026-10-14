<x-guest-layout brand="click-n-grow">
    <section class="expert-visit-hero" aria-labelledby="expert-visit-title">
        <img class="expert-visit-hero__image" src="{{ asset('images/home_banner.png') }}"
            alt="Farmer standing in a flourishing crop field" fetchpriority="high">
        <div class="expert-visit-hero__wash" aria-hidden="true"></div>
        <div class="expert-visit-hero__content">
            <p class="expert-visit-hero__eyebrow">Expert Visit Registration</p>
            <h1 class="expert-visit-hero__title" id="expert-visit-title">One Step Closer to<br>Better Crop Choices</h1>
            <p class="expert-visit-hero__description">
                Register for an expert farm visit to get soil assessment, resources evaluation and personalized crop
                recommendations for a successful herbal farming journey.
            </p>
        </div>
    </section>

    <div class="expert-registration">
        <div class="expert-registration__layout">
            <form class="expert-registration__form" id="expert-visit-form"
                action="{{ route('expert-visit-registration.store') }}" method="POST">
                @csrf
                <header class="expert-registration__form-header">
                    <h2>Expert Visit Registration (Pre-Sowing)</h2>
                    <p>One-time farm assessment for soil, resources and crop selection</p>
                </header>

                <section class="expert-registration__section" aria-labelledby="expert-person-title">
                    <h3 id="expert-person-title"><span>1.</span> Personal Information</h3>
                    <div class="expert-registration__fields expert-registration__fields--three">
                        <label class="expert-registration__field">Name *
                            <input name="name" autocomplete="given-name" maxlength="100" required>
                        </label>
                        <label class="expert-registration__field">Father's Name *
                            <input name="father_name" maxlength="100" required>
                        </label>
                        <label class="expert-registration__field">Surname *
                            <input name="surname" autocomplete="family-name" maxlength="100" required>
                        </label>
                        <label class="expert-registration__field">Mobile Number *
                            <input name="mobile" type="tel" inputmode="numeric" autocomplete="tel-national"
                                pattern="[6-9][0-9]{9}" maxlength="10" required>
                        </label>
                    </div>
                </section>

                <section class="expert-registration__section" aria-labelledby="expert-residence-title">
                    <h3 id="expert-residence-title"><span>2.</span> Residential Address</h3>
                    <div class="expert-registration__fields expert-registration__fields--three">
                        <label class="expert-registration__field">Village *
                            <input name="residential[village]" maxlength="120" required>
                        </label>
                        <label class="expert-registration__field">Taluka *
                            <input name="residential[taluka]" maxlength="120" required>
                        </label>
                        <label class="expert-registration__field">District *
                            <input name="residential[district]" maxlength="120" required>
                        </label>
                        <label class="expert-registration__field">State *
                            <select name="residential[state]" required>
                                <option value="">Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="expert-registration__field">Pincode *
                            <input name="residential[pincode]" inputmode="numeric" pattern="[0-9]{6}"
                                maxlength="6" required>
                        </label>
                    </div>
                </section>

                <section class="expert-registration__section" aria-labelledby="expert-farm-title">
                    <div class="expert-registration__section-heading">
                        <h3 id="expert-farm-title"><span>3.</span> Land Address(es)</h3>
                        <button class="expert-registration__add-farm" id="add-farm-address" type="button">
                            <i class="fas fa-plus" aria-hidden="true"></i> Add address
                        </button>
                    </div>
                    <div class="expert-registration__farm-list" id="farm-address-list">
                        <fieldset class="expert-registration__farm" data-farm-index="0">
                            <legend>Land Address 1</legend>
                            <button class="expert-registration__remove-farm" type="button" aria-label="Remove land address" disabled>
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </button>
                            <div class="expert-registration__fields expert-registration__fields--three">
                                <label class="expert-registration__field">Village *
                                    <input name="farms[0][village]" maxlength="120" required>
                                </label>
                                <label class="expert-registration__field">Taluka *
                                    <input name="farms[0][taluka]" maxlength="120" required>
                                </label>
                                <label class="expert-registration__field">District *
                                    <input name="farms[0][district]" maxlength="120" required>
                                </label>
                                <label class="expert-registration__field">State *
                                    <select name="farms[0][state]" class="farm-state" required>
                                        <option value="">Select state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="expert-registration__field">Pincode *
                                    <input name="farms[0][pincode]" inputmode="numeric" pattern="[0-9]{6}"
                                        maxlength="6" required>
                                </label>
                                <label class="expert-registration__field">Mobile Number *
                                    <input name="farms[0][mobile]" type="tel" inputmode="numeric"
                                        pattern="[6-9][0-9]{9}" maxlength="10" required>
                                </label>
                                <label class="expert-registration__field">Land Area (acres) *
                                    <input name="farms[0][area_acres]" class="farm-area" type="number"
                                        min="0.01" max="100000" step="0.01" inputmode="decimal" required>
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <p class="expert-registration__total-area">Total land area: <strong id="total-land-area">0 acres</strong></p>
                </section>

                <section class="expert-registration__section" aria-labelledby="expert-visit-details-title">
                    <h3 id="expert-visit-details-title"><span>4.</span> Other Details</h3>
                    <div class="expert-registration__fields expert-registration__fields--two">
                        <label class="expert-registration__field">Nearest Railway Station *
                            <input name="nearest_railway_station" maxlength="150" required>
                        </label>
                        <label class="expert-registration__field">Preferred Visit Date *
                            <input name="preferred_visit_date" type="date" min="{{ now()->toDateString() }}" required>
                        </label>
                        <input name="visit_days" type="hidden" value="1">
                    </div>
                </section>

                <section class="expert-registration__section expert-registration__payment" aria-labelledby="expert-payment-title">
                    <h3 id="expert-payment-title"><span>5.</span> Payment</h3>
                    <label class="expert-registration__consent">
                        <input type="checkbox" name="policy_accepted" value="1" required>
                        <span>I have read and agree to the registration, visit, travel and cancellation policies.</span>
                    </label>
                    <div class="expert-registration__payment-row">
                        <div>
                            <span class="expert-registration__field-label">Registration Fee</span>
                            <strong class="expert-registration__fee" id="registration-fee" aria-live="polite">Select farm state</strong>
                            <small id="registration-fee-note">The fee is based on the highest-rate farm state for one visit day.</small>
                        </div>
                        <button class="expert-registration__pay-button" id="pay-registration" type="submit"
                            @disabled(!$checkoutReady)>
                            Proceed to Pay <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                    @unless ($checkoutReady)
                        <p class="expert-registration__setup-note">
                            Online registration is not available yet. The site owner must configure the registration
                            database and Razorpay credentials in Render.
                        </p>
                    @endunless
                    <p class="expert-registration__secure"><i class="fas fa-lock" aria-hidden="true"></i> Secure online payment</p>
                    <div class="expert-registration__message" id="registration-message" role="status" aria-live="polite"></div>
                    <p class="expert-registration__receipt">
                        <i class="fas fa-circle-check" aria-hidden="true"></i>
                        After payment is verified, your registration reference will appear here.
                    </p>
                </section>
            </form>

            <aside class="expert-registration__sidebar">
                <section class="expert-registration__side-card" aria-labelledby="expert-fee-title">
                    <h2 id="expert-fee-title"><i class="fas fa-indian-rupee-sign" aria-hidden="true"></i> Expert Visit Registration Fee Structure</h2>
                    <div class="expert-registration__fee-table-wrap">
                        <table class="expert-registration__fee-table">
                            <thead>
                                <tr><th>Location of Farm</th><th>Registration Fee / Day</th></tr>
                            </thead>
                            <tbody>
                                @foreach ($feeGroups as $group)
                                    <tr>
                                        <td>
                                            <strong>{{ $group['label'] }}</strong>
                                            <small>{{ implode(', ', $group['states']) }}</small>
                                        </td>
                                        <td>₹{{ number_format($group['rate']) }}<small>per day</small></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="expert-registration__fee-rule">For multiple farm locations, the highest applicable state rate is used for each visit day.</p>
                </section>

                <section class="expert-registration__side-card expert-registration__notes" aria-labelledby="expert-notes-title">
                    <h2 id="expert-notes-title"><i class="fas fa-clipboard-list" aria-hidden="true"></i> Important Information</h2>
                    <ol>
                        <li><strong>Registration Policy</strong><span>Registration fees are non-refundable and cannot be cancelled once paid.</span></li>
                        <li><strong>Purpose</strong><span>This one-time pre-sowing visit assesses soil and resources to recommend suitable crops and a cultivation approach.</span></li>
                        <li><strong>Visit Charges</strong><span>Charges are calculated per day of the expert visit and based on the farm's state.</span></li>
                        <li><strong>Travel &amp; Pickup</strong><span>The grower arranges pickup and drop-off for the expert from the nearest railway station or airport, as mutually agreed.</span></li>
                        <li><strong>Registration Fee</strong><span>The fee covers expert fees, travel tickets, food, accommodation and other applicable visit-related expenses.</span></li>
                        <li><strong>Soil Analysis</strong><span>Soil assessment and analysis are performed through the KisanSAT application.</span></li>
                        <li><strong>Visit Scheduling</strong><span>Visits may be rescheduled due to operational, weather or other unavoidable reasons. Our team will confirm the final date with you.</span></li>
                        <li><strong>Advance Confirmation</strong><span>Your visit is confirmed after registration and payment confirmation.</span></li>
                        <li><strong>Additional Visits</strong><span>Any visit beyond the agreed scope is charged separately at actual expenses.</span></li>
                        <li><strong>Coordination</strong><span>Please provide necessary field information and ensure access to the farm on the scheduled date.</span></li>
                    </ol>
                </section>
            </aside>
        </div>
    </div>

    <template id="farm-address-template">
        <fieldset class="expert-registration__farm" data-farm-index="__INDEX__">
            <legend>Land Address __NUMBER__</legend>
            <button class="expert-registration__remove-farm" type="button" aria-label="Remove land address">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
            <div class="expert-registration__fields expert-registration__fields--three">
                <label class="expert-registration__field">Village *
                    <input name="farms[__INDEX__][village]" maxlength="120" required>
                </label>
                <label class="expert-registration__field">Taluka *
                    <input name="farms[__INDEX__][taluka]" maxlength="120" required>
                </label>
                <label class="expert-registration__field">District *
                    <input name="farms[__INDEX__][district]" maxlength="120" required>
                </label>
                <label class="expert-registration__field">State *
                    <select name="farms[__INDEX__][state]" class="farm-state" required>
                        <option value="">Select state</option>
                        @foreach ($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="expert-registration__field">Pincode *
                    <input name="farms[__INDEX__][pincode]" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" required>
                </label>
                <label class="expert-registration__field">Mobile Number *
                    <input name="farms[__INDEX__][mobile]" type="tel" inputmode="numeric"
                        pattern="[6-9][0-9]{9}" maxlength="10" required>
                </label>
                <label class="expert-registration__field">Land Area (acres) *
                    <input name="farms[__INDEX__][area_acres]" class="farm-area" type="number"
                        min="0.01" max="100000" step="0.01" inputmode="decimal" required>
                </label>
            </div>
        </fieldset>
    </template>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        (() => {
            const form = document.getElementById('expert-visit-form');
            const farmList = document.getElementById('farm-address-list');
            const farmTemplate = document.getElementById('farm-address-template');
            const addFarmButton = document.getElementById('add-farm-address');
            const feeOutput = document.getElementById('registration-fee');
            const feeNote = document.getElementById('registration-fee-note');
            const totalAreaOutput = document.getElementById('total-land-area');
            const submitButton = document.getElementById('pay-registration');
            const message = document.getElementById('registration-message');
            const stateRates = @json($stateRates);
            let nextFarmIndex = 1;

            const money = amount => new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0
            }).format(amount);

            const updateFee = () => {
                const rates = [...farmList.querySelectorAll('.farm-state')]
                    .map(select => stateRates[select.value] || 0)
                    .filter(rate => rate > 0);
                const days = 1;
                const perDay = rates.length ? Math.max(...rates) : 0;

                feeOutput.textContent = perDay ? money(perDay * days) : 'Select farm state';
                feeNote.textContent = perDay
                    ? `${money(perDay)} for one visit day`
                    : 'The fee is based on the highest-rate farm state for one visit day.';
            };

            const updateTotalArea = () => {
                const total = [...farmList.querySelectorAll('.farm-area')]
                    .reduce((sum, input) => sum + (Number(input.value) || 0), 0);
                totalAreaOutput.textContent = `${total.toLocaleString('en-IN', {
                    maximumFractionDigits: 2
                })} ${total === 1 ? 'acre' : 'acres'}`;
            };

            addFarmButton.addEventListener('click', () => {
                if (farmList.children.length >= 5) {
                    message.textContent = 'You can add up to five farm addresses per registration.';
                    return;
                }

                const markup = farmTemplate.innerHTML
                    .replaceAll('__INDEX__', String(nextFarmIndex))
                    .replaceAll('__NUMBER__', String(farmList.children.length + 1));
                farmList.insertAdjacentHTML('beforeend', markup);
                nextFarmIndex += 1;
                message.textContent = '';
            });

            farmList.addEventListener('click', event => {
                const removeButton = event.target.closest('.expert-registration__remove-farm');
                if (!removeButton || farmList.children.length <= 1) return;
                removeButton.closest('.expert-registration__farm').remove();
                [...farmList.children].forEach((farm, index) => {
                    farm.querySelector('legend').textContent = `Land Address ${index + 1}`;
                });
                updateFee();
                updateTotalArea();
            });

            farmList.addEventListener('change', event => {
                if (event.target.matches('.farm-state')) updateFee();
            });
            farmList.addEventListener('input', event => {
                if (event.target.matches('.farm-area')) updateTotalArea();
            });
            form.addEventListener('submit', async event => {
                event.preventDefault();
                if (!form.reportValidity()) return;

                submitButton.disabled = true;
                submitButton.dataset.label = submitButton.innerHTML;
                submitButton.textContent = 'Preparing secure payment…';
                message.className = 'expert-registration__message';
                message.textContent = '';

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
                        },
                        body: new FormData(form)
                    });
                    const order = await response.json();
                    if (!response.ok) {
                        const validationErrors = Object.values(order.errors || {}).flat();
                        throw new Error(validationErrors[0] || order.message || 'Unable to start payment.');
                    }
                    if (!window.Razorpay) throw new Error('Secure checkout could not be loaded. Please refresh and try again.');

                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButton.dataset.label;
                    const checkout = new Razorpay({
                        key: order.key,
                        amount: order.amount,
                        currency: order.currency,
                        name: 'Click-N-Grow Agroventures',
                        description: 'Expert farm visit registration',
                        order_id: order.order_id,
                        prefill: {
                            name: order.name,
                            contact: order.mobile
                        },
                        notes: {
                            registration_reference: order.reference
                        },
                        theme: {
                            color: '#08733d'
                        },
                        handler: async payment => {
                            submitButton.disabled = true;
                            submitButton.textContent = 'Verifying payment…';
                            try {
                                const verification = await fetch(@json(route('expert-visit-registration.payment.verify')), {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
                                    },
                                    body: JSON.stringify({
                                        reference: order.reference,
                                        razorpay_order_id: payment.razorpay_order_id,
                                        razorpay_payment_id: payment.razorpay_payment_id,
                                        razorpay_signature: payment.razorpay_signature
                                    })
                                });
                                const result = await verification.json();
                                if (!verification.ok) throw new Error(result.message || 'Payment verification failed.');

                                message.className = 'expert-registration__message is-success';
                                message.textContent = `${result.message} Reference: ${result.reference}`;
                                form.reset();
                                farmList.innerHTML = farmTemplate.innerHTML
                                    .replaceAll('__INDEX__', '0')
                                    .replaceAll('__NUMBER__', '1');
                                farmList.querySelector('.expert-registration__remove-farm').disabled = true;
                                nextFarmIndex = 1;
                                updateFee();
                                updateTotalArea();
                            } catch (error) {
                                message.className = 'expert-registration__message is-error';
                                message.textContent = error.message;
                            } finally {
                                submitButton.disabled = false;
                                submitButton.innerHTML = submitButton.dataset.label;
                            }
                        },
                        modal: {
                            ondismiss: () => {
                                submitButton.disabled = false;
                                submitButton.innerHTML = submitButton.dataset.label;
                            }
                        }
                    });
                    checkout.on('payment.failed', failure => {
                        message.className = 'expert-registration__message is-error';
                        message.textContent = failure.error.description || 'Payment failed. Your registration is saved as pending.';
                    });
                    checkout.open();
                } catch (error) {
                    message.className = 'expert-registration__message is-error';
                    message.textContent = error.message;
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButton.dataset.label;
                }
            });

            updateFee();
            updateTotalArea();
        })();
    </script>
</x-guest-layout>
