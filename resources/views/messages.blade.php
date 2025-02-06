<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Messsages' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="messageContainer" class="flex flex-col gap-2"></div>

                    <form action="" method="POST" id="message-form">
                        <x-text-input type="hidden" name="sender_id" value="{{ Auth::user()->id }}" />
                        <x-text-input type="hidden" name="channel_id" value="1" />

                        <div class="mb-4">
                            <x-input-label for="message" value="Message" />
                            <x-text-input id="message" name="content" />
                        </div>
                        <x-primary-button type="submit">
                            Gönder
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector('#message-form');
        const submitButton = document.querySelector('button[type="submit"]');
        const messageContainer = document.querySelector('#messageContainer');

        document.addEventListener('DOMContentLoaded', async () => {
            const RESPONSE = await ApiService.fetchData("{{ route('messages.show') }}", {}, 'GET');

            if (RESPONSE.status === 200) {
                messageContainer.innerHTML = RESPONSE.data.html;
            } else {
                alert('Mesajlar yüklenirken bir hata oluştu.');
            }
        });

        submitButton.addEventListener('click', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            const RESPONSE = await ApiService.fetchData("{{ route('messages.store') }}", formData, 'POST');

            if (RESPONSE.status === 200) {
                messageContainer.innerHTML = `
                    <div class="bg-gray-200 p-2 rounded-lg">
                        ${RESPONSE.data.html}
                    </div>
                `;
            } else {
                alert('Mesaj gönderilirken bir hata oluştu.');
            }
        })
    </script>
</x-app-layout>
