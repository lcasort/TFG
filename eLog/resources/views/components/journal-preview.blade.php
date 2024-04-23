<div class="col">
    @if (!is_null($prevEntry))
        <div class="row flex-column m-0 pb-6 justify-content-center border-bottom border-light">
            <p class="text-center text-lg mt-3">Your last journal entry was on</p>
            <p class="journal-preview-date text-center justify-content-center text-xl text-gray-900 dark:text-gray-200 leading-tight text-break">
                {{ $prevEntry->updated_at->format('d F Y') }}
            </p>
            <div class="d-flex justify-content-center my-3">
                <form action="{{ route('journal.show-prev', ['entry' => $todaysEntry->id ?? 0]) }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="text-center col-1 journal-nav-button">
                        <input type="submit" class="btn submit-button" value="See my entry">
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row flex-column m-0 pb-6 justify-content-center border-bottom border-light">
            <p class="text-center text-lg mt-3">You haven't written your first journal entry yet!</p>
    @endif
    <div class="row flex-column m-0 pt-6 justify-content-center">
        @if (is_null($todaysEntry) || (!is_null($todaysEntry) && $todaysEntry->updated_at->toDateString() != today()->toDateString()))
            <!-- Recommendation of journaling prompt -->
            <blockquote class="blockquote text-center my-3">
                <p class="text-lg">Today you could maybe write about...</p>
                <cite class="mb-0">{{ $prompt->text }}</cite>
            </blockquote>
            <div class="row m-0 mb-3 justify-content-center">
                <!-- Button that redirects to the journal view -->
                <div class="text-center">
                    <a href="{{ route('journal') }}" class="btn submit-button">
                        Start writing now
                    </a>
                </div>
            </div>
        @else
            <blockquote class="blockquote text-center my-3">
                @if (is_null($todaysEntry->prompt))
                    <p class="text-xl">You already saved a journal entry today!</p>
                    <p class="text-lg">Do you want to update it?</p>
                @else
                    <p class="text-lg">Today you wrote about...</p>
                    <cite class="mb-0">{{ $todaysEntry->prompt->text }}</cite>
                @endif
            </blockquote>
            <div class="row m-0 mb-3 justify-content-center">
                <!-- Button that redirects to the journal view -->
                <div class="text-center">
                    <a href="{{ route('journal') }}" class="btn submit-button">
                        Update entry
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>