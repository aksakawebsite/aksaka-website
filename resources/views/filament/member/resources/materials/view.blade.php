<x-filament-panels::page>
    <div class="max-w-7xl mx-auto space-y-8">
        {{-- Header Card --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-purple-700 to-pink-700 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/10 opacity-50 [mask-image:linear-gradient(0deg,transparent,black)]"></div>
            <div class="relative px-8 py-10">
                <div class="flex items-start gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center text-white shadow-xl">
                            @if($record->type === 'video')
                                <x-heroicon-o-video-camera class="!w-9 !h-9" />
                            @else
                                <x-heroicon-o-document-text class="!w-9 !h-9" />
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="inline-flex items-center rounded-full bg-white/20 backdrop-blur-sm border border-white/30 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                                {{ $record->type === 'video' ? 'Video Pembelajaran' : 'E-Book PDF' }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2 drop-shadow-md">
                            {{ $record->title }}
                        </h1>
                        <p class="text-base text-blue-100 mb-3 drop-shadow-sm">
                            {{ $record->description }}
                        </p>
                        <div class="flex items-center gap-2 text-sm text-blue-100">
                             <x-heroicon-o-bookmark class="!w-4 !h-4" />
                            <span class="font-medium">Program: {{ $record->program->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
            <div class="p-6 md:p-8">
                @if($record->type === 'video')
                    @php
                        $videoUrl = $record->content_url;
                        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $videoUrl, $matches)) {
                            $videoId = $matches[1];
                        } elseif (preg_match('/youtu\.be\/([^?]+)/', $videoUrl, $matches)) {
                            $videoId = $matches[1];
                        } else {
                            $videoId = null;
                        }
                    @endphp
                    
                    @if($videoId)
                        <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700" style="padding-top: 56.25%;">
                            <iframe class="absolute inset-0 w-full h-full" 
                                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&showinfo=0" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                        <div class="mt-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50">
                            <div class="flex items-start gap-3">
                                <x-heroicon-o-light-bulb class="!w-5 !h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" />
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Tips Menonton</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        Gunakan mode layar penuh untuk pengalaman terbaik. Jangan lupa aktifkan subtitle jika tersedia.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-12 text-center bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/20 mb-3">
                                <x-heroicon-o-x-circle class="!w-7 !h-7 text-red-600 dark:text-red-400" />
                            </div>
                            <p class="text-red-600 dark:text-red-400 font-medium text-sm">Link video tidak valid atau tidak dapat di-embed.</p>
                        </div>
                    @endif
                @else
                    @php
                        $pdfUrl = Storage::url($record->content_url);
                    @endphp
                    <div class="space-y-4">
                        <div class="relative rounded-xl overflow-hidden shadow-lg border-2 border-gray-200 dark:border-gray-700">
                            <embed src="{{ $pdfUrl }}#toolbar=1&navpanes=1&scrollbar=1" 
                                   type="application/pdf" 
                                   class="w-full bg-gray-50 dark:bg-gray-800"
                                   style="height: 800px;">
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50">
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-arrow-down-tray class="!w-6 !h-6 text-purple-600 dark:text-purple-400 flex-shrink-0" />
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Download untuk Akses Offline</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Simpan PDF ini di perangkat Anda untuk dibaca nanti.</p>
                                </div>
                            </div>
                            <a href="{{ $pdfUrl }}" 
                               download
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200">
                                <x-heroicon-s-arrow-down-tray class="!w-4 !h-4" />
                                <span>Download</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .bg-grid-white {
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</x-filament-panels::page>
