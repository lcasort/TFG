<script src="js/journal-view.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Journal') }}
        </h2>
    </x-slot>

    <div class="py-12 main-page-container">
        <!-- Navigation bar for journal entries -->
        <div>
                <div class="d-flex flex-row w-100">
                    <!-- Previous entry button -->
                    <form action="{{ route('journal.show-prev', ['entry' => $entry->id ?? 0]) }}" method="GET">
                        @csrf
                        @method('get')
                        <div class="text-center col-1 journal-nav-button">
                            <input type="submit" class="btn submit-button" value="⫷">
                        </div>
                    </form>
                    <!-- Date -->
                    <div class="d-flex col text-center text-xl text-gray-900 dark:text-gray-200 leading-tight text-break justify-content-center align-items-center">
                        {{ $entry ? strtoupper($entry->created_at->toFormattedDateString()) : now()->toFormattedDateString() }}
                    </div>
                    <!-- Next entry button -->
                    <form action="{{ route('journal.show-next', ['entry' => $entry->id ?? 0]) }}" method="GET">
                        @csrf
                        @method('get')
                        <div class="text-center col-1 journal-nav-button">
                            <input type="submit" class="btn submit-button" value="⫸" disabled="{{$entry ? now()->isSameDay($entry->created_at) ? 'disabled' : '' : ''}}">
                        </div>
                    </form>
                </div>
            </form>
            
            
            
        </div>
        <!-- Input space to write journal entry -->
        <div>
            <form action="{{ route('journal.save') }}" method="POST">
                @csrf
                @method('post')
                <textarea class="textarea-form" name="textarea" placeholder="Write something here...">
                    @if($entry)
                        {{ trim($entry->text, " \n\r\t\v\x00") }}
                    @endif
                </textarea>
                <!-- Save button (saves journal entry) -->
                <div class="text-center mt-3">
                    <input type="submit" class="btn submit-button" value="Save" disabled="{{$entry ? now()->isSameDay($entry->created_at) ? '' : 'disabled' : ''}}">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>