<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="dashboard py-12 main-page-container d-flex justify-content-center">
        <div class="container text-center p-0 m-0">
            <!-- Motivational quote -->
            <div class="row inspirational-quote-container p-0 m-0 justify-content-center">
                <p>{{ strtoupper($inspirationalQuote) }}</p>
            </div>
            <!-- Pages preview -->
            <div class="page-cards row mx-0 p-0 text-white">
                <div class="page-card col-lg p-0 mr-lg-4 mb-6 mb-lg-0">
                    <div class="page-card-title mb-2">{{ 'MOODS' }}</div>
                    <div class="page-card-body">
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek
                    </div>
                </div>
                <div class="page-card col-lg p-0 mr-lg-4 mb-6 mb-lg-0">
                    <div class="page-card-title mb-2">{{ 'HABITS '}}</div>
                    <div class="page-card-body">
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek
                    </div>
                </div>
                <div class="page-card col-lg p-0">
                    <div class="page-card-title mb-2">{{ 'JOURNAL' }}</div>
                    <div class="page-card-body">
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek<br />
                        muxotextonosek
                    </div>
                </div>
            </div>
            <!-- Meditation video recommendations -->
            {{-- <div class="row p-0 m-0">
                @foreach ($meditationVideos as $video)
                    {{ $video }}
                @endforeach
            </div> --}}
        </div>
    </div>
</x-app-layout>
