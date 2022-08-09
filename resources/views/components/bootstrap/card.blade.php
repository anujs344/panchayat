<div {{ $attributes->merge(['class'=> 'card radius-10 w-100']) }} >
    <div class="card-body">
        <div class="d-flex justify-content-between">
            {{-- Header --}}
            <div class="d-flex flex-column">
                {{-- Card title --}}
                @if (isset($title))
                <h5 class='mb-0'>
                    {{$title}}
                </h5>
                @endif
                {{-- Card Subtitle --}}
                @if (isset($subTitle))
                    {{$subTitle}}
                @endif
            </div>
            {{-- Controls --}}
            @if (isset($controls))
            <div class="d-flex justify-content-between align-items-start">
                {{$controls}}
            </div>
            @endif
        </div>
        {{-- Content --}}
        @if (isset($content))
            {{$content}}
        @else
            {{$slot}}
        @endif
    </div>
</div>