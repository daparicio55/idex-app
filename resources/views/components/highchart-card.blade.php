<div class="card shadow mb-1 border-left-info">
    <div class="card-header">
        {{ $header }}
    </div>
    <div class="card-body">
        <div class="p-0 chartjs">
            <figure class="highcharts-figure">
                <div id="{{ $id }}"></div>
                <p style="font-size: 0.8rem">
                    {{ $description }}
                </p>
            </figure>
        </div>
    </div>
</div>