<div class="timetable">
    <div class="column-hour">
        <header></header>
    @foreach($ttHours as $hour)
        <div>{{ $hour }}</div>
    @endforeach
    </div>
@foreach($ttDays as $dayIndex => $day)
    <div class="column">
        <header>{{ $ttHeaders[$dayIndex] }}</header>
        <div style="height: {{ $ttColumnHeight }}px"></div>
    @foreach($day as $item)
        <article style="top: {{ $item['css_top'] }}px; left: {{ $item['css_left'] }}%; width: {{ $item['css_width'] }}%; height: {{ $item['css_height'] }}px" role="button" title="{{ $item['title'] }}" onclick="navigateTo('{{ route($routePrefix.'.edit',$item['session']['id']) }}')">
            {{ $item['session']['name'] }}
        </article>
    @endforeach
    </div>
@endforeach
</div>
