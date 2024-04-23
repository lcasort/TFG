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
                        @method('GET')
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
                        @method('GET')
                        <div class="text-center col-1 journal-nav-button">
                            <input type="submit" class="btn submit-button" value="⫸">
                        </div>
                    </form>
                </div>
            </form>
            
            
            
        </div>
        <!-- Input space to write journal entry -->
        <div>
            <form action="{{ is_null($entry) ? route('journal.save') : route('journal.update') }}" method="POST">
                @csrf
                @if(is_null($entry))
                    @method('POST')
                @else
                    @method('PATCH')
                @endif
                <input required type="text" class="title-form text-center" name="title" placeholder="TITLE" value="
                    @if($entry)
                        {{ trim($entry->title, " \n\r\t\v\x00") }}
                    @endif
                ">
                <select class="prompt-picker form-select w-100" name="prompt">
                    <option value="">Select a prompt</option>
                    @foreach ($prompts as $prompt)
                        @if ($entry && $entry->prompt_id === $prompt->id)
                            <option value="{{ $prompt->id }}" selected>{{ $prompt->text }}</option>
                        @else
                            <option value="{{ $prompt->id }}">{{ $prompt->text }}</option>
                        @endif
                    @endforeach
                  </select>
                <textarea required class="textarea-form" name="text" placeholder="Write something here...">
                    @if($entry)
                        {{ trim($entry->text, " \n\r\t\v\x00") }}
                    @endif
                </textarea>
                <!-- Save button (saves journal entry) -->
                <div class="text-center mt-3">
                    @if(is_null($entry) || \Carbon\Carbon::now()->isSameDay($entry->created_at))
                        <input type="submit" class="btn submit-button" value="Save">
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app-layout>