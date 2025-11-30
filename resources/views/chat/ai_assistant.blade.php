<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-secondary-900 leading-tight animate-fade-in">
                    {{ __('AI Chat Assistant') }}
                </h2>
                <p class="text-sm text-secondary-600 mt-1">Tanyakan pertanyaan tentang perpustakaan dengan mudah</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-secondary-500" id="real-time-date">{{ date('l, d F Y') }}</p>
                <p class="text-xs text-secondary-400" id="real-time-clock">{{ date('H:i:s') }} WIB</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-large overflow-hidden">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Question Categories -->
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-semibold text-secondary-900 mb-4">Pilih Kategori</h3>
                            <div class="space-y-2">
                                @foreach($questionData as $key => $category)
                                    <button
                                        class="category-btn w-full text-left p-4 rounded-xl border-2 border-secondary-200 hover:border-primary-400 hover:bg-primary-50 transition-all duration-200 {{ $loop->first ? 'active' : '' }}"
                                        data-category="{{ $key }}"
                                    >
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-{{ $key === 'library' ? 'book' : ($key === 'books' ? 'book-open' : ($key === 'loans' ? 'hand-holding-heart' : ($key === 'returns' ? 'undo-alt' : ($key === 'membership' ? 'users' : 'concierge-bell')))) }} text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-secondary-900">{{ $category['title'] }}</h4>
                                                <p class="text-sm text-secondary-500">{{ count($category['questions']) }} pertanyaan</p>
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Questions List -->
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-semibold text-secondary-900 mb-4">Pertanyaan</h3>
                            <div id="questions-container" class="space-y-2">
                                @foreach($questionData['library']['questions'] as $question)
                                    <button
                                        class="question-btn w-full text-left p-3 rounded-lg bg-secondary-50 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200 border border-secondary-200 hover:border-primary-300"
                                        data-question="{{ $question }}"
                                    >
                                        <span class="text-sm">{{ $question }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Chat Interface -->
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-semibold text-secondary-900 mb-4">Jawaban</h3>
                            <div id="chat-container" class="bg-gradient-to-br from-secondary-50 to-secondary-100 rounded-xl p-4 min-h-96 max-h-96 overflow-y-auto">
                                <div id="chat-messages" class="space-y-3">
                                    <div class="text-center text-secondary-500 text-sm py-8">
                                        <i class="fas fa-robot text-2xl mb-2"></i>
                                        <p>Pilih pertanyaan untuk mendapatkan jawaban</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const questionData = @json($questionData);
        const answers = @json($answers);

        document.addEventListener('DOMContentLoaded', function() {
            const categoryButtons = document.querySelectorAll('.category-btn');
            const chatMessages = document.getElementById('chat-messages');

            // Category selection
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    categoryButtons.forEach(btn => btn.classList.remove('active', 'border-primary-500', 'bg-primary-50'));
                    // Add active class to clicked button
                    this.classList.add('active', 'border-primary-500', 'bg-primary-50');

                    const category = this.dataset.category;
                    updateQuestions(category);
                });
            });

            // Question selection
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('question-btn') || e.target.closest('.question-btn')) {
                    const questionBtn = e.target.classList.contains('question-btn') ? e.target : e.target.closest('.question-btn');
                    const question = questionBtn.dataset.question;
                    const category = document.querySelector('.category-btn.active').dataset.category;

                    // Add user message
                    addMessage(question, 'user');

                    // Add bot response
                    setTimeout(() => {
                        const answer = getAnswer(category, question);
                        addMessage(answer, 'bot');
                    }, 500);
                }
            });

            function updateQuestions(category) {
                const container = document.getElementById('questions-container');
                container.innerHTML = '';

                questionData[category].questions.forEach(question => {
                    const button = document.createElement('button');
                    button.className = 'question-btn w-full text-left p-3 rounded-lg bg-secondary-50 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200 border border-secondary-200 hover:border-primary-300';
                    button.dataset.question = question;
                    button.innerHTML = `<span class="text-sm">${question}</span>`;
                    container.appendChild(button);
                });
            }

            function addMessage(text, type) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `flex ${type === 'user' ? 'justify-end' : 'justify-start'}`;

                const messageContent = document.createElement('div');
                messageContent.className = `max-w-xs px-4 py-2 rounded-lg text-sm ${
                    type === 'user'
                        ? 'bg-primary-500 text-white'
                        : 'bg-white text-secondary-900 border border-secondary-200'
                }`;
                messageContent.textContent = text;

                messageDiv.appendChild(messageContent);
                chatMessages.appendChild(messageDiv);

                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function getAnswer(category, question) {
                return answers[category][question] || 'Maaf, saya tidak dapat menemukan jawaban untuk pertanyaan tersebut.';
            }

            // Update real-time clock
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', {
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                document.getElementById('real-time-clock').textContent = timeString + ' WIB';
            }

            setInterval(updateClock, 1000);
        });
    </script>
</x-app-layout>
