<x-layouts.main :title="$article->meta_title ?: $article->title" :description="$article->meta_description">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-8 flex-wrap">
            <a href="{{ route('help.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">{{ __('help.title') }}</a>
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('help.category', $category->slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">{{ $category->name }}</a>
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-900 dark:text-white font-medium">{{ Str::limit($article->title, 40) }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <article class="lg:col-span-3">
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden">
                    <!-- Article Header -->
                    <div class="p-6 sm:p-8 border-b border-slate-200 dark:border-dark-border">
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white leading-tight">{{ $article->title }}</h1>
                        <div class="flex items-center gap-4 mt-4 text-sm text-slate-500 dark:text-slate-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ __('help.reading_time', ['count' => $article->reading_time]) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ number_format($article->views_count) }} {{ __('help.views') }}
                            </span>
                            @if($article->published_at)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $article->published_at->format('M d, Y') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="p-6 sm:p-8">
                        <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-semibold prose-a:text-primary-600 dark:prose-a:text-primary-400 prose-img:rounded-xl">
                            {!! $article->content !!}
                        </div>
                    </div>

                    <!-- Article Footer - Feedback -->
                    <div class="p-6 sm:p-8 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border"
                        x-data="{
                            submitted: false,
                            selectedType: null,
                            loading: false,
                            cookieName: 'help_feedback_{{ $article->id }}',
                            
                            init() {
                                // Check if already submitted via cookie
                                const existingFeedback = this.getCookie(this.cookieName);
                                if (existingFeedback) {
                                    this.submitted = true;
                                    this.selectedType = existingFeedback;
                                }
                            },
                            
                            getCookie(name) {
                                const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                                return match ? match[2] : null;
                            },
                            
                            setCookie(name, value, days) {
                                const expires = new Date(Date.now() + days * 864e5).toUTCString();
                                document.cookie = name + '=' + value + '; expires=' + expires + '; path=/; SameSite=Lax';
                            },
                            
                            async submitFeedback(type) {
                                if (this.submitted || this.loading) return;
                                
                                this.loading = true;
                                this.selectedType = type;
                                
                                try {
                                    const response = await fetch('{{ route('help.feedback', $article->id) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ type: type })
                                    });
                                    
                                    if (response.ok) {
                                        this.submitted = true;
                                        this.setCookie(this.cookieName, type, 7); // 7 days = 1 week
                                    }
                                } catch (e) {
                                    console.error('Feedback error:', e);
                                } finally {
                                    this.loading = false;
                                }
                            }
                        }">
                        
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <p class="text-sm text-slate-600 dark:text-slate-400">
                                <template x-if="!submitted">
                                    <span>{{ __('help.was_helpful') }}</span>
                                </template>
                                <template x-if="submitted">
                                    <span class="text-green-600 dark:text-green-400">{{ __('help.feedback_thanks') }}</span>
                                </template>
                            </p>
                            
                            <div class="flex items-center gap-2">
                                <button 
                                    @click="submitFeedback('yes')"
                                    :disabled="submitted || loading"
                                    :class="{
                                        'bg-green-500 text-white': selectedType === 'yes',
                                        'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/50': selectedType !== 'yes',
                                        'opacity-50 cursor-not-allowed': submitted && selectedType !== 'yes'
                                    }"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg transition text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    {{ __('help.yes') }}
                                </button>
                                <button 
                                    @click="submitFeedback('no')"
                                    :disabled="submitted || loading"
                                    :class="{
                                        'bg-slate-500 text-white': selectedType === 'no',
                                        'bg-slate-100 dark:bg-dark-border text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-dark-soft': selectedType !== 'no',
                                        'opacity-50 cursor-not-allowed': submitted && selectedType !== 'no'
                                    }"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg transition text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                    </svg>
                                    {{ __('help.no') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back to Category -->
                <div class="mt-6">
                    <a href="{{ route('help.category', $category->slug) }}" class="inline-flex items-center text-sm text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        {{ __('help.back_to_category', ['category' => $category->name]) }}
                    </a>
                </div>
            </article>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Related Articles -->
                @if($relatedArticles->isNotEmpty())
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4">{{ __('help.related_articles') }}</h3>
                    <ul class="space-y-3">
                        @foreach($relatedArticles as $related)
                        <li>
                            <a href="{{ route('help.article', [$category->slug, $related->slug]) }}" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition">
                                {{ $related->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Other Categories -->
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4">{{ __('help.browse_categories') }}</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('help.category', $cat->slug) }}" class="flex items-center gap-2 text-sm py-1 {{ $cat->id === $category->id ? 'text-primary-600 dark:text-primary-400 font-medium' : 'text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400' }} transition">
                                @if($cat->icon)
                                <span class="text-sm">{!! $cat->icon !!}</span>
                                @endif
                                <span>{{ $cat->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-5 text-white">
                    <h3 class="font-semibold mb-2">{{ __('help.still_need_help') }}</h3>
                    <p class="text-primary-100 text-sm mb-4">{{ __('help.contact_support_text') }}</p>
                    <a href="{{ route('app.tickets.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-primary-600 text-sm font-medium rounded-lg hover:bg-primary-50 transition">
                        {{ __('help.contact_support') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
