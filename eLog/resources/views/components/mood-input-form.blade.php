<div class="col">
    <!-- Show today's mood -->
    <div class="row m-0 justify-content-center">
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
                @foreach ($moodOptions as $option)
                <input type="radio" class="btn-check" name="mood" id="{{$option->name}}" autocomplete="off" value="{{$option->name}}" required>
                <label class="btn btn-light p-0 selected-pic mx-2" for="{{$option->name}}">
                    <img src="{{asset($option->emoji)}}" class="selected-mood" title="{{$option->name}}">
                </label>
                @endforeach
            </div>
        </fieldset>

        <div class="text-center mt-3">
            <input type="submit" class="btn submit-button" value="Submit">
        </div>
    </form>
</div>