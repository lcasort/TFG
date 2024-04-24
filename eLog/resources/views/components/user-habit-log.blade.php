<div class="col py-3">
    <!--
        \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                       DASHBOARD FORM FOR THE HABITS OF THE WEEK
        ////////////////////////////////////////////////////////////////////////
    -->
    @foreach ($habits as $habit => $data)
    <div class="row p-0 text-center m-0 my-3">
        <div class="col d-flex flex-column justify-content-center m-0">
            <!--
                \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                                 FORM TO ADD-DELETE HABIT LOGS
                ////////////////////////////////////////////////////////////////
            -->
            <div class="d-flex flex-row flex-wrap habit-name justify-content-start">
                <!-- If we click on the '-', we can delete today's log -->
                <form action="{{ route('habit-log.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="habit" value="{{ $data['id'] }}">
                    <button type="submit" class="btn add-habit-log p-0 mr-2" type="submit">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                </form>
                <!-- Name of the habit -->
                <div><p class="text-uppercase text-light">{{ $habit }}</p></div>
                <!-- If we click on the '+', we can save today's log -->
                <form action="{{ route('habit-log.save') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="habit" value="{{ $data['id'] }}">
                    <button type="submit" class="btn add-habit-log p-0 ml-2" type="submit">
                        <i class="fa-regular fa-square-plus"></i>
                    </button>
                </form>
            </div>
            <!--
                \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                              WE SHOW THE HABITS LOGS FOR THE WEEK
                ////////////////////////////////////////////////////////////////
            -->
            <div class="d-flex flex-row flex-wrap justify-content-start m-0">
                @foreach ($data['logs'] as $log)
                    @if ($log)
                    <div class="day-check color-marked p-0 my-2 mx-1">
                    </div>
                    @else
                    <div class="day-not-check my-2 mx-1">
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>