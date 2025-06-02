<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notes

            {{-- Alert --}}
            @if (session('success'))
                <span class="text-green-600">{{ session('success') }}</span>
            @elseif (session('error'))
                <span class="text-red-600">{{ session('error') }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 gap-4 justify-start text-gray-900 dark:text-gray-100">



                    <a href="{{ route('note.create') }}" style="color: #8dc1f8">
                        Add Note +
                    </a>

                    @forelse ($notes as $note)
                        {{-- Note Card --}}
                        <div style="margin: 15px 0" class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-4 w-full sm:w-[calc(50%-0.5rem)] md:w-[calc(33.33%-0.67rem)] lg:w-[calc(25%-0.75rem)]">
                            <h3 class="text-lg font-bold mb-2">{{ $note->title }}</h3>
                            <p class="mb-4">{{ $note->content }}</p>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('note.edit', $note->id) }}" class="text-green-600 hover:underline" style="width: fit-content">
                                    Update
                                </a>

                                <form action="{{ route('note.destroy', $note) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>No notes available.</p>
                    @endforelse

                        <div class="d-flex justify-content-center">
                            {{ $notes->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
