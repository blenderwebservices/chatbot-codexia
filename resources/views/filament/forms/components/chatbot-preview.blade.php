<style>
    .bot-preview-container {
        position: relative;
        height: 550px;
        width: 100%;
        background-color: #0f172a;
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 1.5rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        font-family: 'Outfit', system-ui, -apple-system, sans-serif;
    }
    .bot-header {
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .bot-header-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
        font-weight: 700;
    }
    .bot-dots {
        display: flex;
        gap: 0.375rem;
    }
    .bot-dot {
        width: 0.625rem;
        height: 0.625rem;
        border-radius: 9999px;
    }
    .bot-preview-area {
        flex-grow: 1;
        padding: 1.5rem;
        display: flex;
        align-items: flex-end;
        position: relative;
    }
    .bot-preview-area.left { justify-content: flex-start; }
    .bot-preview-area.right { justify-content: flex-end; }
    .bot-center-text {
        position: absolute;
        width: 100%;
        text-align: center;
        left: 0;
        bottom: 50%;
        transform: translateY(50%);
        color: #64748b;
        font-style: italic;
        font-size: 0.875rem;
    }
    .bot-widget {
        width: 100%;
        max-width: 400px;
        height: 350px;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 10;
        transition: all 0.5s ease;
    }
    .bot-widget-header {
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: white;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        transition: background-color 0.3s ease;
    }
    .bot-widget-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .bot-widget-name {
        font-weight: 700;
        font-size: 0.875rem;
    }
    .bot-widget-body {
        flex-grow: 1;
        padding: 1rem;
        overflow-y: auto;
    }
    .bot-message-bubble {
        max-width: 85%;
        background-color: #1e293b;
        color: white;
        font-size: 0.75rem;
        padding: 0.75rem;
        border-top-right-radius: 0.75rem;
        border-bottom-left-radius: 0.75rem;
        border-bottom-right-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        line-height: 1.4;
    }
    .bot-widget-footer {
        padding: 0.75rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        gap: 0.5rem;
    }
    .bot-input {
        background-color: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        font-size: 0.75rem;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        flex-grow: 1;
        outline: none;
        color: white;
        width: 100%;
        box-sizing: border-box;
    }
    .bot-send-btn {
        width: 2rem;
        height: 2rem;
        flex-shrink: 0;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .bot-send-btn svg {
        width: 1rem;
        height: 1rem;
    }
</style>

<div 
    x-data="{
        botName: $wire.$entangle('data.name').live,
        botColor: $wire.$entangle('data.color').live,
        botPos: $wire.$entangle('data.position').live,
        botMsg: $wire.$entangle('data.welcome_message').live,
        isOpen: false
    }"
    class="bot-preview-container"
>
    <!-- Header Vista Previa -->
    <div class="bot-header">
        <span class="bot-header-title">Vista Previa Interna</span>
        <div class="bot-dots">
            <div class="bot-dot" style="background-color: rgba(239, 68, 68, 0.5);"></div>
            <div class="bot-dot" style="background-color: rgba(234, 179, 8, 0.5);"></div>
            <div class="bot-dot" style="background-color: rgba(34, 197, 94, 0.5);"></div>
        </div>
    </div>
    
    <div class="bot-preview-area" :class="botPos === 'left' ? 'left' : 'right'">
        <div class="bot-center-text">
            Esta es una vista previa del diseño. <br> 
            Mira la esquina inferior <span x-text="botPos === 'left' ? 'izquierda' : 'derecha'"></span> de tu pantalla para ver el bot real.
        </div>

        <!-- Realtime Bot Preview (Static in the section) -->
        <div class="bot-widget">
            <div class="bot-widget-header" :style="`background-color: ${botColor || '#3b82f6'}`">
                <div class="bot-widget-avatar">AI</div>
                <div class="bot-widget-name" x-text="botName || 'CodexiaBot'"></div>
            </div>
            
            <div class="bot-widget-body">
                <div class="bot-message-bubble">
                    <span x-text="botMsg || '¡Hola! Soy tu asistente configurado. ¿Cómo puedo ayudarte?'"></span>
                </div>
            </div>
            
            <div class="bot-widget-footer">
                <input disabled type="text" placeholder="Escribe..." class="bot-input">
                <div class="bot-send-btn" :style="`background-color: ${botColor || '#3b82f6'}`">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- REAL FLOATING BOT TELEPORTED TO BODY -->
    <template x-teleport="body">
        <div 
            class="fixed bottom-6 z-[9999] flex flex-col items-end transition-all duration-500 ease-in-out"
            :class="botPos === 'left' ? 'left-6 items-start' : 'right-6 items-end'"
        >
            <!-- Chat Window -->
            <div 
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-10 scale-95"
                class="mb-4 w-[350px] h-[500px] bg-white dark:bg-gray-900 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-800 flex flex-col overflow-hidden"
            >
                <!-- Header -->
                <div :style="`background-color: ${botColor || '#3b82f6'}`" class="p-5 text-white flex justify-between items-center shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center font-bold">AI</div>
                        <div>
                            <div class="font-bold text-sm" x-text="botName || 'CodexiaBot'"></div>
                            <div class="text-[10px] opacity-80 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                En línea
                            </div>
                        </div>
                    </div>
                    <button @click="isOpen = false" class="p-2 hover:bg-white/10 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="flex-grow p-5 overflow-y-auto bg-gray-50 dark:bg-gray-950 flex flex-col gap-4">
                    <div class="self-start max-w-[85%] bg-white dark:bg-gray-800 p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 dark:border-gray-800 text-sm dark:text-gray-200 leading-relaxed">
                        <span x-text="botMsg || '¡Hola! Soy tu asistente configurado. ¿Cómo puedo ayudarte?'"></span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-4 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 flex gap-3 items-center">
                    <input type="text" placeholder="Escribe tu mensaje..." class="flex-grow bg-gray-100 dark:bg-gray-800 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-opacity-50 dark:text-white" :style="`--tw-ring-color: ${botColor || '#3b82f6'}`">
                    <button 
                        :style="`background-color: ${botColor || '#3b82f6'}`"
                        class="w-11 h-11 rounded-xl flex items-center justify-center text-white shadow-lg hover:brightness-110 transition-all"
                    >
                        <svg class="w-5 h-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Sphere (Trigger) -->
            <button 
                @click="isOpen = !isOpen"
                :style="`background-color: ${botColor || '#3b82f6'}`"
                class="w-16 h-16 rounded-full shadow-2xl flex items-center justify-center text-white transition-all duration-300 hover:scale-110 active:scale-95 group relative"
            >
                <div class="absolute inset-0 rounded-full bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <template x-if="!isOpen">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </template>
                <template x-if="isOpen">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </template>
            </button>
        </div>
    </template>
</div>
