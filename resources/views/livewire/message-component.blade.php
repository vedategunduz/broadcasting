<div class="flex flex-col-reverse gap-2">
    @foreach ($messages as $message)
        <div @class([
            'flex',
            'flex-row-reverse' => $message->sender->id === auth()->id(),
        ])>
            <div @class([
                'p-4 rounded',
                'bg-emerald-50' => $message->sender->id === auth()->id(),
                'bg-blue-50' => $message->sender->id !== auth()->id(),
            ])>
                <div @class([
                    'text-gray-900 font-semibold',
                    'text-right' => $message->sender->id === auth()->id(),
                ])>
                    <small>{{ $message->sender->name }}</small>
                </div>
                <div>{{ $message->content }}</div>
                <div class="text-right">
                    <small>{{ $message->created_at }}</small>
                </div>
            </div>
        </div>
    @endforeach
    <x-secondary-button type="button" wire:click="incrementMessageCount" class="mx-auto">
        Daha fazla
    </x-secondary-button>
</div>
