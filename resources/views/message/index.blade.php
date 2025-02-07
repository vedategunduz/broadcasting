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
                    <livewire:message-component channel_id = "1" />



                    <form action="" method="POST" id="message-form">
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
            window.Echo.private(`message-channel.1`)
                .listen('MessageCreated', (event) => {
                    console.log('Yeni mesaj:', event.message);
                });
        });

        submitButton.addEventListener('click', async (e) => {
            e.preventDefault();

            e.target.disabled = true;
            e.target.textContent = 'Gönderiliyor...';

            try {
                const formData = new FormData(form);

                const RESPONSE = await ApiService.fetchData("{{ route('message.store') }}", formData, 'POST');

                if (RESPONSE.status === 201) {
                    form.reset();
                } else {
                    alert('Mesaj gönderilirken bir hata oluştu.');
                }
            } catch (error) {

            } finally {
                e.target.disabled = false;
                e.target.textContent = 'Gönder';
            }
        })
    </script>
</x-app-layout>
