<x-filament-panels::page>
    <div class="max-w-7xl mx-auto space-y-8">
        {{-- Hero Header --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-purple-700 to-pink-700 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/10 opacity-50"></div>
            <div class="relative px-8 py-12">
                <h1 class="text-4xl font-bold text-white mb-3 drop-shadow-md">{{ $record->title }}</h1>
                <p class="text-lg text-purple-100 max-w-3xl drop-shadow-sm">{{ $record->description }}</p>
            </div>
        </div>

        {{-- Materi Grid --}}
        <div class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
            <div class="flex items-center gap-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700/50 px-6 py-4">
                <x-heroicon-o-book-open class="!w-6 !h-6 text-gray-500 dark:text-gray-400" />
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Materi Pembelajaran</h3>
            </div>
            <div class="p-6">
                @php $materials = $record->materials()->orderBy('order')->get(); @endphp
                @if($materials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($materials as $material)
                        <div class="group relative flex flex-col justify-between overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
                            <div class="p-6">
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br {{ $material->type === 'video' ? 'from-blue-500 to-cyan-500' : 'from-purple-500 to-violet-500' }} flex items-center justify-center text-white shadow-lg">
                                        @if($material->type === 'video')
                                            <x-heroicon-o-video-camera class="!w-7 !h-7" />
                                        @else
                                            <x-heroicon-o-document-text class="!w-7 !h-7" />
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="inline-flex items-center rounded-full {{ $material->type === 'video' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' }} px-3 py-1 text-xs font-semibold mb-2">
                                            {{ ucfirst($material->type) }}
                                        </span>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white mb-1 line-clamp-2">{{ $material->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $material->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 pb-6">
                                <a href="{{ \App\Filament\Member\Resources\Materials\MaterialResource::getUrl('view', ['record' => $material]) }}"
                                   class="block w-full text-center px-4 py-2.5 bg-gradient-to-r {{ $material->type === 'video' ? 'from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700' : 'from-purple-600 to-violet-600 hover:from-purple-700 hover:to-violet-700' }} text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                    Mulai Belajar
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <x-heroicon-o-book-open class="!mx-auto !h-12 !w-12 text-gray-400" />
                        <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">Belum Ada Materi</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Materi untuk program ini akan segera tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quiz Grid --}}
        <div class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
            <div class="flex items-center gap-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700/50 px-6 py-4">
                 <x-heroicon-o-pencil-square class="!w-6 !h-6 text-gray-500 dark:text-gray-400" />
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Quiz & Evaluasi</h3>
            </div>
            <div class="p-6">
                @php $quizzes = $record->quizzes()->whereNotNull('gform_url')->orderBy('order')->get(); @endphp
                @if($quizzes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($quizzes as $quiz)
                        <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
                            <div class="p-6">
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white shadow-lg">
                                        <x-heroicon-o-pencil-square class="!w-7 !h-7" />
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $quiz->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $quiz->description }}</p>
                                        <a href="{{ $quiz->gform_url }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-2 w-full justify-center px-4 py-2.5 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                            Kerjakan Quiz
                                            <x-heroicon-s-arrow-top-right-on-square class="!w-4 !h-4" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <x-heroicon-o-pencil-square class="!mx-auto !h-12 !w-12 text-gray-400" />
                        <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">Belum Ada Quiz</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Quiz untuk program ini akan segera tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <style>
        .bg-grid-white { background-image: linear-gradient(to right, rgba(255, 255, 255, 0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 1px, transparent 1px); background-size: 24px 24px; }
    </style>
</x-filament-panels::page>
