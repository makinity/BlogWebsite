    <x-layout>
        <style>
            /* Chat bubbles */
            .chat-bubble {
                max-width: 70%;
                padding: 12px 18px;
                border-radius: 18px;
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.5);
                font-size: 1rem;
                line-height: 1.4;
                white-space: pre-wrap; /* preserve line breaks */
                word-wrap: break-word;
                animation: fadeInUp 0.3s ease forwards;
            }

            .chat-bubble.user {
                background: linear-gradient(135deg, #4e8cff, #306fe0);
                color: #fff;
                border-bottom-right-radius: 4px;
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.7);
            }

            .chat-bubble.assistant {
                background: #2a2e35;
                color: #ddd;
                border: 1px solid #444;
                border-bottom-left-radius: 4px;
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.7);
            }

            /* Message container spacing */
            .message-row {
                margin-bottom: 14px;
                display: flex;
            }

            .message-row.user {
                justify-content: flex-end;
            }

            .message-row.assistant {
                justify-content: flex-start;
            }

            /* Scrollable chat box */
            #chat-box {
                height: 420px;
                overflow-y: auto;
                padding: 20px 16px;
                background: #1f232a;
                border-radius: 12px 12px 0 0;
                box-shadow: inset 0 0 10px #000000aa;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #ddd;
            }

            /* Form styling */
            #chat-form {
                background: #252a33;
                padding: 16px 20px;
                border-radius: 0 0 12px 12px;
                box-shadow: 0 2px 6px rgb(0 0 0 / 0.7);
                display: flex;
                gap: 12px;
            }

            #prompt {
                flex-grow: 1;
                resize: none;
                border-radius: 20px;
                border: 1.5px solid #444;
                padding: 12px 18px;
                font-size: 1rem;
                transition: border-color 0.3s ease;
                font-family: inherit;
                min-height: 40px;
                max-height: 120px;
                overflow-y: auto;
                background: #1f232a;
                color: #ddd;
            }

            #prompt:focus {
                border-color: #4e8cff;
                outline: none;
                box-shadow: 0 0 8px #4e8cff88;
                background: #252a33;
                color: #eee;
            }

            #prompt::placeholder {
                color: #777;
                font-style: italic;
            }

            #send-btn {
                background: #4e8cff;
                border: none;
                color: white;
                padding: 0 24px;
                border-radius: 20px;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.25s ease;
                display: flex;
                align-items: center;
                box-shadow: 0 2px 6px rgb(0 0 0 / 0.5);
            }

            #send-btn:hover:not(:disabled) {
                background: #306fe0;
            }

            #send-btn:disabled {
                background: #a3bffa;
                cursor: not-allowed;
            }

            /* Fade in animation for new messages */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(8px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Heading color */
            h1 {
                color: #cbd5e1; /* lighter text */
            }

            /* Error alert styling */
            .alert-danger {
                background-color: #5a1e1e;
                color: #f8d7da;
                border-color: #721c24;
            }
        </style>

        <div class="container mt-5" style="max-width: 600px;">
            <div class="mb-4 text-center" style="font-weight: 700; font-size: 1.0rem; color: #cbd5e1;">
                <i class="bi bi-cpu"></i> MakiBot
            </div>

            <div class="card shadow-sm border-0 bg-dark">
                <div id="chat-box">
                    @if(session('chatHistory'))
                        @foreach(session('chatHistory') as $message)
                            <div class="message-row {{ $message['role'] === 'user' ? 'user' : 'assistant' }}">
                                <div class="chat-bubble {{ $message['role'] === 'user' ? 'user' : 'assistant' }}">
                                    {{ $message['content'] }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted mt-4" style="color: #888;">
                            Start the conversation by typing a message below.
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('ai.generate') }}" id="chat-form" autocomplete="off" spellcheck="false">
                    @csrf
                    <textarea
                        id="prompt"
                        name="prompt"
                        rows="1"
                        placeholder="Type your message..."
                        required
                        oninput="autoGrow(this)"
                    >{{ old('prompt') }}</textarea>
                    <button class="btn" type="submit" id="send-btn">Send</button>
                </form>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mt-3 rounded">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <script>
            // Scroll chat box to bottom on page load
            const chatBox = document.getElementById('chat-box');
            chatBox.scrollTop = chatBox.scrollHeight;

            // Disable send button on submit
            document.getElementById('chat-form').addEventListener('submit', function() {
                document.getElementById('send-btn').disabled = true;
                document.getElementById('send-btn').innerText = 'Sending...';
            });

            function autoGrow(element) {
                element.style.height = "40px";
                element.style.height = (element.scrollHeight) + "px";
            }

            const promptEl = document.getElementById('prompt');
            autoGrow(promptEl);
        </script>
    </x-layout>
