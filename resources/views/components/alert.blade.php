<!-- Alert Component -->
<div
    x-data="alert"
    x-show="isOpen"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
    style="display: none;"
>
    <div
        :class="{
            'alert-info': type === 'info',
            'alert-success': type === 'success',
            'alert-warning': type === 'warning',
            'alert-error': type === 'error'
        }"
        class="alert p-6 rounded-lg shadow-lg w-96"
    >
        <!-- Title -->
        <h2 x-text="title" class="text-lg font-bold mb-4"></h2>

        <!-- Message -->
        <p x-text="message" class="mb-4"></p>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4">
            <!-- Cancel Button (for confirmation dialogs) -->
            <template x-if="type === 'confirm'">
                <button
                    @click="closeAlert"
                    class="bg-gray-500 text-white px-4 py-2 rounded"
                >
                    Cancel
                </button>
            </template>

            <!-- Confirm/OK Button -->
            <button
                @click="handleConfirm"
                :class="{
                    'bg-red-500': type === 'confirm' || type === 'error',
                    'bg-blue-500': type === 'info',
                    'bg-green-500': type === 'success',
                    'bg-yellow-500': type === 'warning'
                }"
                class="text-white px-4 py-2 rounded"
            >
                <span x-text="confirmButtonText"></span>
            </button>
        </div>
    </div>
</div>

<!-- Alpine.js Component Script -->
<script>
    document.addEventListener('alpine:init', () => {
        // Initialize the alert component
        Alpine.data('alert', function () {
            return {
                isOpen: false,
                title: '',
                message: '',
                type: 'alert', // 'alert', 'confirm', 'info', 'success', 'warning', 'error'
                confirmButtonText: 'OK',
                onConfirm: () => {},

                // Open the alert
                openAlert(data) {
                    this.title = data.title;
                    this.message = data.message;
                    this.type = data.type || 'alert';
                    this.confirmButtonText = data.confirmButtonText || 'OK';
                    this.onConfirm = data.onConfirm || (() => {});
                    this.isOpen = true;
                },

                // Close the alert
                closeAlert() {
                    this.isOpen = false;
                },

                // Handle confirm button click
                handleConfirm() {
                    this.onConfirm();
                    this.closeAlert();
                }
            };
        });

        // Listen for the open-alert event
        document.addEventListener('open-alert', (event) => {
            const alert = Alpine.$data(document.querySelector('[x-data="alert"]'));
            alert.openAlert(event.detail);
        });
    });
</script>


{{--  DOCS 
 ? Information-Sharing Alert (No User Interaction) with OK button only
 <button
    @click="
        $dispatch('open-alert', {
            title: 'Info',
            message: 'This is an informational message.',
            type: 'info' // Can be 'info', 'success', 'warning', or 'error'
        })
    "
    class="bg-blue-500 text-white px-4 py-2 rounded"
>
    Show Info Alert
</button>


? show a confirmation dialog with "Confirm" and "Cancel" buttons
<button
    @click="
        $dispatch('open-alert', {
            title: 'Are you sure?',
            message: 'This action cannot be undone.',
            type: 'confirm', // Use 'confirm' for user interaction
            confirmButtonText: 'Yes, delete it!',
            onConfirm: () => {
                // Perform the action here
                console.log('User confirmed the action');
            }
        })
    "
    class="bg-red-500 text-white px-4 py-2 rounded"
>
    Delete Record
</button>


Key Points:
- Event: $dispatch('open-alert', { ... })
- Types: info, success, warning, error, confirm
- Classes: alert-info, alert-success, alert-warning, alert-error
- Actions: Use the onConfirm callback to define what happens when the user confirms the action.

--}}