<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベント詳細
        </h2>
    </x-slot>

    <div class="pt-4 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="max-w-2xl mx-auto py-8 px-4">

                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('events.edit', ['event' => $event->id]) }}">

                        <div>
                            <x-label for="event_name" value="イベント名" />
                            {{ $event->name }}
                        </div>

                        <div class="mt-4">
                            <x-label for="information" value="イベント詳細" />
                            {!! nl2br(e($event->information)) !!}
                        </div>

                        <div class="md:flex justify-between">
                            <div class="mt-4">
                                <x-label for="event_date" value="イベント日付" />
                                {{ $event->eventDate }}
                            </div>

                            <div class="mt-4">
                                <x-label for="start_time" value="開始時間" />
                                {{ $event->startTime }}
                            </div>

                            <div class="mt-4">
                                <x-label for="end_time" value="終了時間" />
                                {{ $event->endTime }}
                            </div>
                        </div>

                        <div class="md:flex justify-between items-center">
                            <div class="mt-4">
                                <x-label for="max_people" value="定員数" />
                                {{ $event->max_people }}
                            </div>
                            <div class="flex space-x-4 justify-around mt-4">
                                @if($event->is_visible)
                                    表示中
                                @else
                                    非表示中
                                @endif
                            </div>
                            @if($event->eventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                            <x-button class="ms-4 mt-4">
                                編集する
                            </x-button>
                            @endif
                        </div>
                    </form>
                    <form id="delete_{{$event->id}}" method="post"
                        action="{{ route('events.destroy', ['event' => $event->id])}}">
                        @csrf @method('delete')
                            <div class="mt-4 flex justify-end">
                                <a href="#" data-id="{{ $event->id }}" class=" text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded-md" onclick="deletePost(this)" >削除する</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-8 px-4">
                    @if (!$users->isEmpty())
                        <div class="text-center py-4">予約状況</div>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                              <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">予約者名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                @if (is_null($reservation['canceled_date']))
                                <tr>
                                    <td class="px-4 py-3">{{ $reservation['name'] }}</td>
                                    <td class="px-4 py-3">{{ $reservation['number_of_people'] }}</td>
                                </tr>
                                 @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
