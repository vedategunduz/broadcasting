@foreach ($messages as $message)
    <div class="bg-gray-200 p-2 rounded-lg">
        <div class="text-gray-800 font-semibold">{{ $message->sender->name }}</div>
        <div>{{ $message->content }}</div>
    </div>
@endforeach
