@php
    $chatbotConfig = [
        'bootstrapUrl' => url('/api/chatbot/bootstrap'),
        'answerUrl' => url('/api/chatbot/answer'),
    ];
@endphp

<div
    class="chatbot-widget"
    x-data="chatbotWidget({ bootstrapUrl: '{{ $chatbotConfig['bootstrapUrl'] }}', answerUrl: '{{ $chatbotConfig['answerUrl'] }}' })"
    x-init="init()"
>
    <button class="chatbot-launcher" @click="toggle" aria-label="Open chat support">
        <i class="fas" :class="isOpen ? 'fa-times' : 'fa-comments'"></i>
    </button>

    <div class="chatbot-panel" x-show="isOpen" x-transition x-cloak>
        <div class="chatbot-panel__header">
            <div>
                <h5>Need Help?</h5>
                <small>Chat with Solar Reviews assistant</small>
            </div>
            <button class="chatbot-close" @click="toggle"><i class="fas fa-times"></i></button>
        </div>

        <div class="chatbot-panel__body">
            <template x-if="error">
                <div class="chatbot-alert chatbot-alert--error" x-text="error"></div>
            </template>

            <template x-if="!error">
                <div class="chatbot-messages" x-ref="messages">
                    <template x-for="(message, idx) in messages" :key="idx">
                        <div class="chat-message" :class="message.sender">
                            <div class="chat-message__bubble">
                                <p class="mb-0" x-text="message.text"></p>
                                <template x-if="message.meta">
                                    <small class="chat-meta" x-text="message.meta"></small>
                                </template>
                            </div>
                        </div>
                    </template>
                    <template x-if="loading">
                        <div class="chat-message bot">
                            <div class="chat-message__bubble">
                                <div class="typing-dots">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <div class="chatbot-panel__footer" x-show="!completed && !error" x-cloak>
            <template x-if="currentQuestion">
                <div>
                    <p class="chatbot-question" x-text="currentQuestion.prompt"></p>

                    <template x-if="currentQuestion.type === 'choice'">
                        <div class="chatbot-options">
                            <template x-for="option in currentQuestion.options" :key="option.id">
                                <button class="chatbot-option" @click="sendOption(option)" :disabled="loading">
                                    <span class="fw-semibold" x-text="option.label"></span>
                                    <small x-show="option.description" x-text="option.description"></small>
                                </button>
                            </template>
                        </div>
                    </template>

                    <template x-if="currentQuestion.type !== 'choice'">
                        <form @submit.prevent="submitInput">
                            <input
                                class="chatbot-input"
                                :type="inputType"
                                :placeholder="currentQuestion.input_placeholder || 'Type your response'"
                                x-model="inputValue"
                                :required="currentQuestion.is_required"
                            >
                            <button type="submit" class="chatbot-submit" :disabled="loading">
                                <span x-show="!loading">Send</span>
                                <span x-show="loading" class="spinner-border spinner-border-sm"></span>
                            </button>
                        </form>
                    </template>
                </div>
            </template>

            <template x-if="completed">
                <div class="chatbot-complete">
                    <i class="fas fa-check-circle"></i>
                    <p class="mb-0">Thanks! Our team will review your conversation soon.</p>
                </div>
            </template>
        </div>
    </div>
</div>

<style>
.chatbot-widget {
    position: fixed;
    right: 2rem;
    bottom: 2rem;
    z-index: 1500;
}
.chatbot-launcher {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    border: none;
    background: linear-gradient(135deg, #3ba14c, #1f7a30);
    color: #fff;
    font-size: 1.3rem;
    box-shadow: 0 15px 30px rgba(15, 118, 54, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.chatbot-panel {
    position: absolute;
    right: 0;
    bottom: 72px;
    width: min(360px, calc(100vw - 2rem));
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 45px rgba(15, 23, 42, 0.15);
    display: flex;
    flex-direction: column;
    max-height: 75vh;
}
.chatbot-panel__header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.chatbot-panel__header h5 {
    margin: 0;
    font-weight: 700;
}
.chatbot-panel__header small {
    color: #64748b;
}
.chatbot-close {
    border: none;
    background: transparent;
    color: #475569;
    font-size: 1rem;
    cursor: pointer;
}
.chatbot-panel__body {
    padding: 1.25rem;
    flex: 1;
    overflow-y: auto;
    background: #f8fafc;
}
.chatbot-messages {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}
.chat-message {
    display: flex;
}
.chat-message.bot { justify-content: flex-start; }
.chat-message.user { justify-content: flex-end; }
.chat-message__bubble {
    max-width: 85%;
    padding: 0.75rem 1rem;
    border-radius: 16px;
    font-size: 0.92rem;
    line-height: 1.4;
}
.chat-message.bot .chat-message__bubble {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-bottom-left-radius: 4px;
}
.chat-message.user .chat-message__bubble {
    background: #3ba14c;
    color: #fff;
    border-bottom-right-radius: 4px;
}
.chat-meta {
    display: block;
    margin-top: 0.35rem;
    font-size: 0.78rem;
    opacity: 0.8;
}
.chatbot-panel__footer {
    border-top: 1px solid #e2e8f0;
    padding: 1rem 1.25rem;
    background: #fff;
}
.chatbot-question {
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.chatbot-options {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.chatbot-option {
    border: 1px solid #cbd5f5;
    background: #fff;
    padding: 0.65rem 0.75rem;
    border-radius: 10px;
    text-align: left;
    cursor: pointer;
    transition: border-color 0.2s, transform 0.2s;
}
.chatbot-option:hover {
    border-color: #3b82f6;
    transform: translateX(2px);
}
.chatbot-input {
    width: 100%;
    border: 1px solid #cbd5f5;
    border-radius: 10px;
    padding: 0.65rem 0.75rem;
    margin-bottom: 0.5rem;
}
.chatbot-submit {
    width: 100%;
    border: none;
    background: #1e40af;
    color: #fff;
    border-radius: 10px;
    padding: 0.65rem;
    font-weight: 600;
}
.chatbot-complete {
    text-align: center;
    color: #15803d;
}
.chatbot-complete i { font-size: 2rem; margin-bottom: 0.5rem; }
.chatbot-alert { padding: 0.75rem; border-radius: 10px; }
.chatbot-alert--error { background: #fee2e2; color: #991b1b; }
.typing-dots { display: flex; gap: 0.3rem; }
.typing-dots span {
    width: 8px;
    height: 8px;
    background: #94a3b8;
    border-radius: 50%;
    animation: blink 1s infinite;
}
.typing-dots span:nth-child(2) { animation-delay: 0.2s; }
.typing-dots span:nth-child(3) { animation-delay: 0.4s; }
@keyframes blink {
    0%, 80%, 100% { opacity: 0.3; }
    40% { opacity: 1; }
}
@media (max-width: 640px) {
    .chatbot-widget { right: 1rem; bottom: 1rem; }
    .chatbot-panel { width: calc(100vw - 2rem); }
}
</style>

<script>
    const registerChatbotWidget = () => {
        if (!window.Alpine || window.__chatbotWidgetRegistered) {
            return;
        }

        window.__chatbotWidgetRegistered = true;

        window.Alpine.data('chatbotWidget', ({ bootstrapUrl, answerUrl }) => ({
            bootstrapUrl,
            answerUrl,
            isOpen: false,
            loading: false,
            error: null,
            sessionId: null,
            currentQuestion: null,
            messages: [],
            inputValue: '',
            completed: false,
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
            init() {
                this.bootstrap();
            },
            get inputType() {
                const typeMap = {
                    text: 'text',
                    input: 'text',
                    number: 'number',
                    email: 'email',
                    phone: 'tel',
                };
                return typeMap[this.currentQuestion?.type] || 'text';
            },
            toggle() {
                this.isOpen = !this.isOpen;
                if (this.isOpen) {
                    this.scrollToEnd();
                }
            },
            async bootstrap() {
                this.loading = true;
                this.error = null;
                try {
                    const response = await fetch(this.bootstrapUrl, {
                        credentials: 'same-origin',
                    });
                    if (!response.ok) {
                        throw new Error('Chatbot unavailable right now.');
                    }
                    const data = await response.json();
                    this.sessionId = data.session_id;
                    this.setQuestion(data.question);
                } catch (err) {
                    this.error = err.message || 'Something went wrong.';
                } finally {
                    this.loading = false;
                }
            },
            setQuestion(question) {
                if (!question) {
                    this.currentQuestion = null;
                    return;
                }
                this.currentQuestion = question;
                this.messages.push({ sender: 'bot', text: question.prompt });
                this.scrollToEnd();
            },
            async sendOption(option) {
                if (this.loading) return;
                this.messages.push({ sender: 'user', text: option.label, meta: option.description });
                this.scrollToEnd();
                await this.sendAnswer({ option_id: option.id });
            },
            async submitInput() {
                if (this.loading || !this.currentQuestion) return;
                if (!this.inputValue && this.currentQuestion.is_required) {
                    return;
                }
                const value = this.inputValue;
                this.messages.push({ sender: 'user', text: value || '[No response]' });
                this.inputValue = '';
                this.scrollToEnd();
                await this.sendAnswer({ input_value: value });
            },
            async sendAnswer(extraPayload) {
                this.loading = true;
                try {
                    const response = await fetch(this.answerUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            session_id: this.sessionId,
                            question_id: this.currentQuestion.id,
                            ...extraPayload,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Failed to send response.');
                    }

                    const data = await response.json();

                    if (data.completed) {
                        this.completed = true;
                        this.messages.push({ sender: 'bot', text: data.message || 'Conversation completed.' });
                        this.currentQuestion = null;
                    } else if (data.question) {
                        this.setQuestion(data.question);
                    }
                } catch (err) {
                    this.error = err.message || 'Unable to continue the chat.';
                } finally {
                    this.loading = false;
                    this.scrollToEnd();
                }
            },
            scrollToEnd() {
                this.$nextTick(() => {
                    const container = this.$refs.messages;
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                });
            },
        }));
    };

    if (window.Alpine) {
        registerChatbotWidget();
    } else {
        document.addEventListener('alpine:init', registerChatbotWidget);
    }

    if (!window.Alpine) {
        const loadAlpineForChatbot = () => {
            if (window.Alpine || window.__chatbotAlpineRequested) {
                return;
            }

            window.__chatbotAlpineRequested = true;

            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js';
            script.defer = true;
            script.setAttribute('data-chatbot-alpine', 'true');
            document.head.appendChild(script);
        };

        if (document.readyState === 'complete') {
            loadAlpineForChatbot();
        } else {
            window.addEventListener('load', loadAlpineForChatbot, { once: true });
        }
    }
</script>
