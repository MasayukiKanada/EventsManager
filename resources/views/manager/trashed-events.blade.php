<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            削除済みイベント
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-4 mx-auto">

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @elseif(session('alert'))
                        <div class="mb-4 font-medium text-sm text-white bg-red-600">
                            {{ session('alert') }}
                        </div>
                    @endif

                      <div class="px-4 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">イベント名</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">開始日時</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">終了日時</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">定員</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">削除日</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">削除</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($trashedEvents as $event)
                            <form id="delete_{{$event->id}}" method="post" action="{{ route('trashed-events.destroy', ['event' => $event->id])}}">
                            @csrf
                            <tr>
                                <td class="px-4 py-3 text-blue-500"><a href="{{ route('events.show', ['event' => $event->id]) }}">{{ $event->name }}</a></td>
                                <td class="px-4 py-3">{{ $event->start_date }}</td>
                                <td class="px-4 py-3">{{ $event->end_date }}</td>
                                <td class="px-4 py-3">後ほど</td>
                                <td class="px-4 py-3">{{ $event->max_people }}</td>
                                <td class="px-4 py-3">{{ $event->deleted_at->diffForHumans() }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="#" data-id="{{ $event->id }}" onclick="deletePost(this)"
                                   class="text-white bg-red-400 border-0 p-2 focus:outline-none
                                   hover:bg-red-500 rounded">完全に削除する</a>
                                </td>
                            </tr>
                            </form>
                            @endforeach
                          </tbody>
                        </table>
                        {{ $trashedEvents->links() }}
                      </div>
                      <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">

                      </div>
                    </div>
                  </section>
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
