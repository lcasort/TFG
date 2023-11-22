<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 main-page-container">
        <div class="container">
            <!-- Motivational quote -->
            <div class="row inspirational-quote-container">
                {{ $inspirationalQuote }}
            </div>
            <!-- Pages preview -->
            <div class="row flex-md-col">
                <div class="col-sm mr-3" style="min-width: 20%;min-height:25px;background-color:white;">

                </div>
                <div class="col-sm mr-3" style="min-width: 20%;min-height:25px;background-color:white;">

                </div>
                <div class="col-sm" style="min-width: 20%;min-height:25px;background-color:white;">

                </div>
            </div>
            <!-- Meditation video recommendations -->
            <div class="row">
                {{ $meditationVideos }}
            </div>
        </div>
    </div>
</x-app-layout>
