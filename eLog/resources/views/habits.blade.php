<!-- Script import -->
<script src="js/habits-view.js"></script>

<x-app-layout>
    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            {{ __('Habits') }}
        </h2>
    </x-slot>

    <!-- Main content container -->
    <div class="py-12 main-page-container">
        <div class="row m-0 justify-content-between">

            <!-- Form to add new habits -->
            <div class="form-container col-lg d-flex flex-column align-items-center justify-content-center h-auto" style="word-break: break-all">
                <div class="row">
                    <form
                        action="{{ route('habit.save') }}"
                        method="POST">
                        @csrf

                        <fieldset>
                            <legend class="text-center mb-2 text-gray-200 leading-tight text-break">
                                Want to track a new habit?
                            </legend>
                            <div class="d-flex flex-wrap justify-content-center mt-3">
                                <input type="text"
                                    required="required"
                                    class="form-control rounded bg-transparent text-light"
                                    id="habit"
                                    name="habit_name"
                                    placeholder="Name of the new habit">
                            </div>
                        </fieldset>

                        <div class="text-center mt-2">
                            <input type="submit" class="btn submit-button" value="Submit">
                        </div>
                    </form>
                </div>
                
                <!-- Form request information -->
                <div class="row form-messges pt-2">
                    @if(session('success'))
                        <div class="alert text-success m-0">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert text-danger m-0">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Monthly view -->
            <div class="month-container-bg col-lg col-lg-9 mt-6 mt-lg-0 w-100 w-lg-50">
                <div class="col p-0">
                    @if (count($habits) > 0)
                        @foreach ($habits as $habit => $data)
                        <div class="row p-0 text-center m-0 my-3">
                            <div class="col d-flex flex-column justify-content-center m-0">
                                <div class="d-flex flex-row flex-wrap habit-name justify-content-start">
                                    <form class="d-flex" action="{{ route('habit-log.delete') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="habit" value="{{ $data['id'] }}">
                                        <button type="submit" class="btn add-habit-log p-0 mr-2">
                                            <i class="fa-regular fa-square-minus"></i>
                                        </button>
                                    </form>
                                    <form  class="d-flex delete-habit-form" action="{{ route('habit.delete', ['habit_id' => $data['id']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="habit-title text-uppercase text-light">
                                            {{ $habit }}
                                        </button>
                                    </form>
                                    <form class="d-flex" action="{{ route('habit-log.save') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="habit" value="{{ $data['id'] }}">
                                        <button type="submit" class="btn add-habit-log p-0 ml-2">
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
                    @else
                        <div class="text-uppercase text-center h4 my-3 p-0">No habits registered yet</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>