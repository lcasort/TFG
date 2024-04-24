<div class="col">
    <!--
        \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                                   SHOW TODAY'S MOOD
        ////////////////////////////////////////////////////////////////////////
    -->
    <div class="row m-0 justify-content-center">
        <!--
            If there's already a mood selected for today we show it, else we
            show a placeholder for it.
        -->
        @if ($moodToday)
        <div class="mood-today-set">
            <img class="mood-today-pic"
                src="{{asset($moodToday->emoji)}}"
                title="{{$moodToday->name}}" />
        </div>
        @else
        <div class="mood-today-not-set">
        </div>
        @endif
    </div>

    <!--
        \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                            WE SHOW THE MOOD SELECTION FORM
        ////////////////////////////////////////////////////////////////////////
    -->
    <!--
        If the user has already selected the mood for today, we update it.
        Else, we save it as a new one.
    -->
    <form
        action="{{ $moodToday ? route('mood.update') : route('mood.save') }}"
        method="POST">
        @csrf
        @if($moodToday)
            @method('PATCH')
        @else
            @method('POST')
        @endif
        
        <fieldset class="mt-6">
            <legend class="text-center mb-3">Moods</legend>
            <div class="d-flex flex-wrap justify-content-center">
                <!-- We show the different mood options -->
                @foreach ($moodOptions as $option)
                <input type="radio" class="btn-check" name="mood" id="{{$option->name}}" autocomplete="off" value="{{$option->name}}" required>
                <label class="btn btn-light p-0 selected-pic mx-2" for="{{$option->name}}">
                    <img src="{{asset($option->emoji)}}" class="selected-mood" title="{{$option->name}}">
                </label>
                @endforeach
            </div>
        </fieldset>

        <!-- Button that saves/updates the mood -->
        <div class="text-center mt-3">
            <input type="submit" class="btn submit-button" value="Submit">
        </div>
    </form>
</div>