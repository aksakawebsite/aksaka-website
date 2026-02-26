<x-filament-panels::page>
    {{-- Info Section --}}
    <x-filament::section
        :heading="$record->title"
        :description="$record->description"
    >
        <x-slot:afterHeader>
            <x-filament::badge :color="$record->type === 'video' ? 'info' : 'success'">
                {{ $record->type === 'video' ? 'Video' : 'E-Book' }}
            </x-filament::badge>
        </x-slot:afterHeader>
    </x-filament::section>

    {{-- Content Section --}}
    @if ($record->type === 'video')
        @php
            $videoUrl = $record->content_url;
            $videoId = null;
            if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $videoUrl, $matches)) {
                $videoId = $matches[1];
            } elseif (preg_match('/youtu\.be\/([^?]+)/', $videoUrl, $matches)) {
                $videoId = $matches[1];
            }
        @endphp

        <x-filament::section heading="Video Pembelajaran">
            @if ($videoId)
                <div style="position:relative;width:100%;padding-top:56.25%;overflow:hidden;border-radius:0.75rem;background:#000;">
                    <iframe
                        style="position:absolute;top:0;left:0;width:100%;height:100%;"
                        src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
            @else
                <x-filament::empty-state
                    heading="Video tidak tersedia"
                    description="Link video tidak valid atau tidak dapat ditampilkan."
                    icon="heroicon-o-x-circle"
                />
            @endif
        </x-filament::section>

        @if ($videoId)
            <x-filament::callout
                color="warning"
                icon="heroicon-o-light-bulb"
                heading="Tips Menonton"
                description="Gunakan mode layar penuh untuk pengalaman terbaik. Aktifkan subtitle jika tersedia."
            />
        @endif
    @else
        @php
            $pdfUrl = Storage::url($record->content_url);
        @endphp

        <x-filament::section heading="Dokumen PDF">
            <x-slot:afterHeader>
                <x-filament::button
                    tag="a"
                    href="{{ $pdfUrl }}"
                    target="_blank"
                    download
                    color="gray"
                    size="sm"
                >
                    Download PDF
                </x-filament::button>
            </x-slot:afterHeader>

            <div style="overflow:hidden;border-radius:0.75rem;">
                <embed
                    src="{{ $pdfUrl }}#toolbar=1&navpanes=1&scrollbar=1"
                    type="application/pdf"
                    style="width:100%;height:800px;">
            </div>
        </x-filament::section>
    @endif
</x-filament-panels::page>
