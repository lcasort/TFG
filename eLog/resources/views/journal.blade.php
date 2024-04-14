<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Journal') }}
        </h2>
    </x-slot>

    <div class="py-12 main-page-container">
        <!-- Navigation bar for journal entries -->
        <div>
            <!-- Previous entry button -->
            <!-- Date -->
            <!-- Next entry button -->
        </div>
        <!-- Input space to write journal entry -->
        <div>
            <form action="{{ route('journal.save') }}" method="POST">
                <!-- Save button (saves journal entry) -->
                <input type="submit" />
            </form>
        </div>
    </div>
</x-app-layout>