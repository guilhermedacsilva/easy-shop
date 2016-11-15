@if (isset($records) && $records->lastPage() > 1)
<ul class="pagination">
    <li class="{{ ($records->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $records->url(1) }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $records->lastPage(); $i++)
        <li class="{{ ($records->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $records->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ ($records->currentPage() == $records->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $records->url($records->currentPage()+1) }}" >Next</a>
    </li>
</ul>
@endif
