<div class="col py-3">
    @foreach ($habits as $habit => $data)
    <div class="row p-0 text-center m-0 my-3">
        <div class="col d-flex flex-column justify-content-center m-0">
            <div class="d-flex flex-row flex-wrap habit-name justify-content-start">
                <form action="{{ route('habit-log.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="habit" value="{{ $data['id'] }}">
                    <button type="submit" class="btn add-habit-log p-0 mr-2" type="submit">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                </form>
                <div><p class="text-uppercase text-light">{{ $habit }}</p></div>
                <form action="{{ route('habit-log.save') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="habit" value="{{ $data['id'] }}">
                    <button type="submit" class="btn add-habit-log p-0 ml-2" type="submit">
                        <i class="fa-regular fa-square-plus"></i>
                    </button>
                </form>
            </div>
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