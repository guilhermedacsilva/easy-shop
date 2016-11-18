<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ $title }}</h2>
        </div>
        @if (!isset($notIncludeTopButton) || !$notIncludeTopButton)
            <div class="pull-right hidden-print">
                <a class="btn btn-primary" href="{{ route($topButtonRoute) }}">
                    {{ $topButtonText }}
                </a>
            </div>
        @endif
    </div>
</div>
