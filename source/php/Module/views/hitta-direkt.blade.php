@if (!empty($items))
    <div class="shortcuts">
        @foreach ($items as $item)
            @php($target = $item['link']['target'] ?? '')
            @php($rel = $target === '_blank' ? 'noopener noreferrer' : '')
            <a
                class="shortcuts__item"
                href="{{ $item['link']['url'] }}"
                @if (!empty($target))
                    target="{{ $target }}"
                @endif
                @if (!empty($rel))
                    rel="{{ $rel }}"
                @endif
            >
                <span class="shortcuts__circle shortcuts__circle--{{ $item['colorKey'] }}">
                    <span
                        class="c-icon material-symbols shortcuts__icon"
                        data-material-symbol="{{ $item['icon'] }}"
                        aria-hidden="true"
                    ></span>
                </span>
                @if ($item['label'] !== '')
                    <span class="shortcuts__label">{{ $item['label'] }}</span>
                @endif
            </a>
        @endforeach
    </div>
@endif
