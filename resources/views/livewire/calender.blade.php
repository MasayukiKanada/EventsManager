<div>
    カレンダー
    <x-input id="calender" class="block mt-1 w-full" type="text" name="calender" />
    {{ $currentDate }}
    <div class="flex">
    @for ($day = 0; $day < 7; $day++)
        {{ $currentWeek[$day] }}
    @endfor
    </div>
</div>
