@if (!empty($items))
    <div class="hitta-direkt" style="--hitta-direkt-columns: {{ (int) $columns }};">
        @foreach ($items as $item)
            @php($target = $item['link']['target'] ?? '')
            @php($rel = $target === '_blank' ? 'noopener noreferrer' : '')
            <a
                class="hitta-direkt__item"
                href="{{ $item['link']['url'] }}"
                @if (!empty($target))
                    target="{{ $target }}"
                @endif
                @if (!empty($rel))
                    rel="{{ $rel }}"
                @endif
            >
                <span class="hitta-direkt__circle" style="--hitta-direkt-color: {{ $item['colorValue'] }};">
                    <span
                        class="c-icon material-symbols hitta-direkt__icon"
                        data-material-symbol="{{ $item['icon'] }}"
                        aria-hidden="true"
                    ></span>
                </span>
                @if ($item['label'] !== '')
                    <span class="hitta-direkt__label">{{ $item['label'] }}</span>
                @endif
            </a>
        @endforeach
    </div>
@endif
