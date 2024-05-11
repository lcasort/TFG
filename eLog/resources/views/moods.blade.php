<x-app-layout>
    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            {{ __('Moods') }}
        </h2>
    </x-slot>

    <!-- Main content container -->
    <div class="py-12 main-page-container container">
        <div class="row m-0 justify-content-between">
            <!-- Month view -->
            <div class="month-container col-lg mb-6 mb-lg-0 w-100 w-lg-50">
                <div class="col p-0">
                    <div class="row days-week text-white m-0 pb-3 justify-content-center">
                        @foreach ($daysOfTheWeek as $day)
                            <div class="col d-flex justify-content-center p-0"><p>{{ $day }}</p></div>
                        @endforeach
                    </div>
                    <div class="row week-data m-0">
                        @foreach ($moodsByDate as $date => $mood)
                        <div class="col p-0 text-center">
                            <div class="row justify-content-center day-number m-0">
                                <p>{{date('d', strtotime($date))}}</p>
                            </div>
                            <div class="row justify-content-center m-0">
                                @if ($mood)
                                <div class="col day-check p-0 my-2 mx-0">
                                    <img src="{{ asset($mood->mood->emoji) }}"
                                        alt="{{ $mood->mood->name }}"
                                        title="{{ $mood->mood->name }}" />
                                </div>
                                @else
                                <div class="col day-not-check my-2 mx-0">
                                </div>
                                @endif
                            </div>
                        </div>
                            
                    @if(intval(date('d', strtotime($date)))!=1 && intval(date('d', strtotime($date)))%7 == 0)
                    </div>
                    <div class="row week-data m-0 ">
                    @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="form-container col-lg" style="word-break: break-all">
                <x-mood-input-form
                    :moodToday=$moodToday
                    :moodOptions=$moodOptions
                />
            </div>
        </div>
    </div>
</x-app-layout>