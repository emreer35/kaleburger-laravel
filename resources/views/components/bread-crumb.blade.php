<div {{ $attributes }}>
    <ul class="flex space-x-4 font-semibold text-text items-center">
        <li>
            <a  href="/">KaleBurger</a>
        </li>
        @foreach ($links as $label => $link)
            <li class="text-xl">→</li>
            <li>
                <a  href="{{ $link }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>

</div>
