@props(['barang'])

@php
    $n = mb_strtolower($barang?->nama_barang ?? '');
    $art = 'box';
    foreach (['beras' => 'beras', 'minyak' => 'minyak', 'vitamin' => 'vitamin', 'obat' => 'vitamin', 'susu' => 'susu', 'pupuk' => 'pupuk'] as $k => $v) {
        if (str_contains($n, $k)) { $art = $v; break; }
    }
@endphp

@if ($art === 'beras')
    <svg viewBox="0 0 400 300" class="block h-auto w-full">
        <defs>
            <linearGradient id="beras-bg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#fffbeb"/><stop offset="1" stop-color="#fff"/></linearGradient>
            <linearGradient id="beras-sack" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#fde68a"/><stop offset="1" stop-color="#fcd34d"/></linearGradient>
        </defs>
        <rect width="400" height="300" rx="24" fill="url(#beras-bg)"/>
        <ellipse cx="200" cy="248" rx="82" ry="12" fill="#00000012"/>
        <path d="M166 92h68c8 0 14 10 14 22v86c0 22-14 34-48 34s-48-12-48-34v-86c0-12 6-22 14-22z" fill="url(#beras-sack)" stroke="#d97706" stroke-width="3"/>
        <path d="M166 98q34-14 68 0" fill="none" stroke="#b45309" stroke-width="4" stroke-linecap="round"/>
        <rect x="166" y="140" width="68" height="34" rx="7" fill="#fff" opacity="0.92"/>
        <text x="200" y="162" text-anchor="middle" font-family="Arial, sans-serif" font-size="13" font-weight="700" fill="#92400e">BERAS</text>
        <path d="M174 190h52" stroke="#d97706" stroke-width="3" stroke-linecap="round"/>
        <circle cx="178" cy="210" r="2.5" fill="#d97706"/><circle cx="190" cy="214" r="2.5" fill="#d97706"/><circle cx="204" cy="209" r="2.5" fill="#d97706"/><circle cx="218" cy="214" r="2.5" fill="#d97706"/>
    </svg>
@elseif ($art === 'minyak')
    <svg viewBox="0 0 400 300" class="block h-auto w-full">
        <defs>
            <linearGradient id="minyak-bg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#fff7ed"/><stop offset="1" stop-color="#fff"/></linearGradient>
            <linearGradient id="minyak-body" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#fde68a"/><stop offset="1" stop-color="#f59e0b"/></linearGradient>
        </defs>
        <rect width="400" height="300" rx="24" fill="url(#minyak-bg)"/>
        <ellipse cx="200" cy="252" rx="72" ry="11" fill="#00000012"/>
        <rect x="186" y="40" width="28" height="18" rx="4" fill="#b45309"/>
        <rect x="190" y="56" width="20" height="30" fill="#fcd34d" stroke="#d97706" stroke-width="2.5"/>
        <path d="M162 86h76v92a38 38 0 0 1-76 0z" fill="url(#minyak-body)" stroke="#d97706" stroke-width="3"/>
        <rect x="166" y="118" width="68" height="28" rx="6" fill="#fff" opacity="0.92"/>
        <text x="200" y="137" text-anchor="middle" font-family="Arial, sans-serif" font-size="11" font-weight="700" fill="#92400e">MINYAK</text>
        <path d="M174 168h52" stroke="#d97706" stroke-width="3" stroke-linecap="round"/>
    </svg>
@elseif ($art === 'vitamin')
    <svg viewBox="0 0 400 300" class="block h-auto w-full">
        <defs>
            <linearGradient id="vitamin-bg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f0f9ff"/><stop offset="1" stop-color="#fff"/></linearGradient>
            <linearGradient id="vitamin-body" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#bae6fd"/><stop offset="1" stop-color="#7dd3fc"/></linearGradient>
        </defs>
        <rect width="400" height="300" rx="24" fill="url(#vitamin-bg)"/>
        <ellipse cx="200" cy="252" rx="70" ry="11" fill="#00000012"/>
        <rect x="120" y="168" width="46" height="17" rx="8.5" fill="#fbbf24" stroke="#d97706" stroke-width="2.5"/>
        <rect x="126" y="196" width="46" height="17" rx="8.5" fill="#f87171" stroke="#dc2626" stroke-width="2.5"/>
        <rect x="188" y="38" width="24" height="16" rx="4" fill="#e0f2fe" stroke="#0284c7" stroke-width="2.5"/>
        <rect x="192" y="52" width="16" height="24" fill="#bae6fd" stroke="#0284c7" stroke-width="2"/>
        <path d="M166 76h68v90a34 34 0 0 1-68 0z" fill="url(#vitamin-body)" stroke="#0284c7" stroke-width="3"/>
        <rect x="172" y="118" width="56" height="26" rx="6" fill="#fff" opacity="0.92"/>
        <text x="200" y="135" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" font-weight="700" fill="#0369a1">VITAMIN</text>
    </svg>
@elseif ($art === 'susu')
    <svg viewBox="0 0 400 300" class="block h-auto w-full">
        <defs>
            <linearGradient id="susu-bg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f0fdfa"/><stop offset="1" stop-color="#fff"/></linearGradient>
        </defs>
        <rect width="400" height="300" rx="24" fill="url(#susu-bg)"/>
        <ellipse cx="200" cy="250" rx="74" ry="11" fill="#00000012"/>
        <path d="M168 92l32-28h64l32 28v138h-128z" fill="#fff" stroke="#14b8a6" stroke-width="3" stroke-linejoin="round"/>
        <path d="M168 92h128" stroke="#14b8a6" stroke-width="3"/>
        <path d="M200 64v28" stroke="#14b8a6" stroke-width="2.5"/>
        <path d="M168 92v138h64V92z" fill="#ccfbf1" opacity="0.85"/>
        <rect x="176" y="148" width="56" height="36" rx="7" fill="#14b8a6"/>
        <text x="204" y="165" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" font-weight="700" fill="#fff">SUSU</text>
        <path d="M184 176q10-6 20 0q10 6 20 0" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round"/>
    </svg>
@elseif ($art === 'pupuk')
    <svg viewBox="0 0 400 300" class="block h-auto w-full">
        <defs>
            <linearGradient id="pupuk-bg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f7fee7"/><stop offset="1" stop-color="#fff"/></linearGradient>
            <linearGradient id="pupuk-sack" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#d9f99d"/><stop offset="1" stop-color="#a3e635"/></linearGradient>
        </defs>
        <rect width="400" height="300" rx="24" fill="url(#pupuk-bg)"/>
        <ellipse cx="200" cy="248" rx="82" ry="12" fill="#00000012"/>
        <path d="M166 92h68c8 0 14 10 14 22v86c0 22-14 34-48 34s-48-12-48-34v-86c0-12 6-22 14-22z" fill="url(#pupuk-sack)" stroke="#65a30d" stroke-width="3"/>
        <path d="M166 98q34-14 68 0" fill="none" stroke="#4d7c0f" stroke-width="4" stroke-linecap="round"/>
        <path d="M200 120v-26" stroke="#16a34a" stroke-width="4" stroke-linecap="round"/>
        <path d="M200 122q-14-4-16-16q12 2 16 16z" fill="#22c55e"/>
        <path d="M200 122q14-4 16-16q-12 2-16 16z" fill="#16a34a"/>
        <rect x="166" y="140" width="68" height="34" rx="7" fill="#fff" opacity="0.92"/>
        <text x="200" y="162" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" font-weight="700" fill="#4d7c0f">PUPUK</text>
        <path d="M174 190h52" stroke="#65a30d" stroke-width="3" stroke-linecap="round"/>
    </svg>
@else
    <svg viewBox="0 0 400 300" class="block h-auto w-full">
        <defs>
            <linearGradient id="box-bg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f0fdfa"/><stop offset="1" stop-color="#fff"/></linearGradient>
            <linearGradient id="box-front" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#99f6e4"/><stop offset="1" stop-color="#5eead4"/></linearGradient>
        </defs>
        <rect width="400" height="300" rx="24" fill="url(#box-bg)"/>
        <ellipse cx="200" cy="248" rx="76" ry="12" fill="#00000012"/>
        <path d="M144 118h112l-9-20h-94z" fill="#0d9488"/>
        <path d="M148 118h104v92h-104z" fill="url(#box-front)" stroke="#0d9488" stroke-width="3" stroke-linejoin="round"/>
        <path d="M200 140l30 17.3v34.6l-30 17.3l-30-17.3v-34.6z" fill="#fff" opacity="0.95"/>
        <path d="M192 158v-8" stroke="#0d9488" stroke-width="3" stroke-linecap="round"/>
        <path d="M200 158v-11" stroke="#14b8a6" stroke-width="3" stroke-linecap="round"/>
        <path d="M208 158v-14" stroke="#2dd4bf" stroke-width="3" stroke-linecap="round"/>
    </svg>
@endif
