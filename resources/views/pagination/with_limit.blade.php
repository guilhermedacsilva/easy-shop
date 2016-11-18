<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($records->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($records->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $records->url(1) }}">First</a>
         </li>
        @for ($i = 1; $i <= $records->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $records->currentPage() - $half_total_links;
            $to = $records->currentPage() + $half_total_links;
            if ($records->currentPage() < $half_total_links) {
               $to += $half_total_links - $records->currentPage();
            }
            if ($records->lastPage() - $records->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($records->lastPage() - $records->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="{{ ($records->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $records->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="{{ ($records->currentPage() == $records->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $records->url($records->lastPage()) }}">Last</a>
        </li>
    </ul>
@endif
