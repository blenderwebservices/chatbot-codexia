<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Codexia - Generador de Bots con IA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #0f172a;
            color: #f8fafc;
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        }
        .glow {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float { animation: float 3s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="p-6 flex justify-between items-center max-w-7xl mx-auto">
        <div class="text-2xl font-bold gradient-text">Chatbot Codexia</div>
        <div class="hidden md:flex gap-8 text-sm font-medium text-slate-400">
            <a href="#" class="hover:text-white transition">Características</a>
            <a href="#" class="hover:text-white transition">Precios</a>
            <a href="#" class="hover:text-white transition">Docs</a>
        </div>
        <a href="/admin" class="px-5 py-2 rounded-full glass border border-slate-700 text-sm hover:bg-white/5 transition">
            Admin Panel
        </a>
    </nav>

    <!-- Hero -->
    <header class="py-20 px-6 text-center max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            Crea tu propio <span class="gradient-text">Agente IA</span> para cualquier sitio web
        </h1>
        <p class="text-xl text-slate-400 mb-10 leading-relaxed">
            Personaliza la personalidad, apariencia y conocimientos de tu bot en segundos. 
            Sin código, solo pura inteligencia artificial.
        </p>
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <button onclick="scrollToBuilder()" class="px-8 py-4 rounded-full gradient-bg font-bold glow hover:scale-105 transition">
                Empezar Gratis
            </button>
            <button class="px-8 py-4 rounded-full glass border border-slate-700 font-bold hover:bg-white/5 transition">
                Ver Demo
            </button>
        </div>
    </header>

    <!-- How it works -->
    <section class="py-20 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-16">Tres simples pasos</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="glass p-10 rounded-3xl space-y-4">
                    <div class="w-12 h-12 rounded-2xl gradient-bg flex items-center justify-center mx-auto text-xl font-bold">1</div>
                    <h3 class="text-xl font-bold">Configura tu Agente</h3>
                    <p class="text-slate-400">Define la personalidad y el modelo (GPT-4, Gemini, Groq) desde el panel admin.</p>
                </div>
                <div class="glass p-10 rounded-3xl space-y-4">
                    <div class="w-12 h-12 rounded-2xl gradient-bg flex items-center justify-center mx-auto text-xl font-bold">2</div>
                    <h3 class="text-xl font-bold">Personaliza el Diseño</h3>
                    <p class="text-slate-400">Ajusta los colores y la posición para que coincida con tu marca.</p>
                </div>
                <div class="glass p-10 rounded-3xl space-y-4">
                    <div class="w-12 h-12 rounded-2xl gradient-bg flex items-center justify-center mx-auto text-xl font-bold">3</div>
                    <h3 class="text-xl font-bold">Copia el Script</h3>
                    <p class="text-slate-400">Pega una sola línea de código en tu sitio web y listo. Tu IA está en vivo.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Builder Section -->
    <section id="builder" class="py-20 px-6 bg-slate-900/50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Configurador de Bots</h2>
                <p class="text-slate-400">Diseña tu bot en tiempo real y obtén el código de integración.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Form -->
                <div class="glass p-8 rounded-3xl space-y-6">
                    <div>
                        <label class="block text-sm font-medium mb-2 text-slate-300">Nombre del Bot</label>
                        <input type="text" id="bot-name" oninput="updatePreview()" value="CodexiaBot" 
                            class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 outline-none focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-slate-300">Personalidad / Instrucciones</label>
                        <textarea id="bot-prompt" oninput="updatePreview()" rows="4"
                            class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 outline-none focus:border-blue-500 transition"
                            placeholder="Ej: Eres un asistente amable experto en ventas..."></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-slate-300">Color Primario</label>
                            <input type="color" id="bot-color" oninput="updatePreview()" value="#3b82f6"
                                class="w-full h-12 bg-slate-800 border border-slate-700 rounded-xl p-1 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-slate-300">Posición</label>
                            <select id="bot-pos" onchange="updatePreview()" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 outline-none">
                                <option value="right">Derecha</option>
                                <option value="left">Izquierda</option>
                            </select>
                        </div>
                    </div>
                    <button onclick="generateScript()" class="w-full py-4 rounded-xl gradient-bg font-bold mt-4">
                        Generar Script de Integración
                    </button>
                </div>

                <!-- Preview Area -->
                <div class="relative h-[600px] glass rounded-3xl overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-white/5 flex items-center justify-between">
                        <span class="text-xs uppercase tracking-widest text-slate-500 font-bold">Vista Previa</span>
                        <div class="flex gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-500/50"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/50"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500/50"></div>
                        </div>
                    </div>
                    
                    <div class="flex-grow p-8 flex items-end justify-end relative">
                        <div class="text-center w-full mb-20">
                            <p class="text-slate-500 italic">Interactúa con el bot en la esquina inferior</p>
                        </div>

                        <!-- Realtime Bot Preview -->
                        <div id="preview-widget" class="absolute bottom-8 right-8 w-80 h-[400px] glass rounded-2xl border border-white/10 flex flex-col shadow-2xl float">
                            <div id="preview-header" class="p-4 rounded-t-2xl flex items-center gap-3 text-white">
                                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs">AI</div>
                                <div class="font-bold text-sm" id="preview-name">CodexiaBot</div>
                            </div>
                            <div class="flex-grow p-4 space-y-3 overflow-y-auto">
                                <div class="bg-slate-800 text-xs p-3 rounded-tr-xl rounded-bl-xl rounded-br-xl max-w-[80%]">
                                    ¡Hola! Soy tu asistente configurado. ¿Cómo puedo ayudarte?
                                </div>
                            </div>
                            <div class="p-3 border-t border-white/5 flex gap-2">
                                <input disabled type="text" placeholder="Escribe..." class="bg-slate-800/50 text-xs rounded-lg px-3 py-2 flex-grow outline-none">
                                <div id="preview-send" class="w-8 h-8 rounded-lg flex items-center justify-center text-white cursor-pointer">➜</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script Modal (Overlay) -->
    <div id="modal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-6">
        <div class="glass p-8 rounded-3xl max-w-2xl w-full">
            <h3 class="text-2xl font-bold mb-4">¡Tu Script está listo!</h3>
            <p class="text-slate-400 mb-6">Copia y pega este código antes de cerrar la etiqueta <code>&lt;/body&gt;</code> de tu sitio web.</p>
            <div class="bg-slate-950 p-6 rounded-xl border border-slate-800 mb-6">
                <code id="script-code" class="text-blue-400 text-sm break-all"></code>
            </div>
            <button onclick="closeModal()" class="px-6 py-2 rounded-full glass border border-slate-700 hover:bg-white/5 transition">
                Cerrar
            </button>
        </div>
    </div>

    <script>
        function updatePreview() {
            const name = document.getElementById('bot-name').value;
            const color = document.getElementById('bot-color').value;
            const pos = document.getElementById('bot-pos').value;
            
            document.getElementById('preview-name').innerText = name;
            document.getElementById('preview-header').style.backgroundColor = color;
            document.getElementById('preview-send').style.backgroundColor = color;
            
            const widget = document.getElementById('preview-widget');
            if(pos === 'left') {
                widget.style.right = 'auto';
                widget.style.left = '32px';
            } else {
                widget.style.left = 'auto';
                widget.style.right = '32px';
            }
        }

        function generateScript() {
            const name = document.getElementById('bot-name').value;
            const color = document.getElementById('bot-color').value;
            const pos = document.getElementById('bot-pos').value;
            const domain = window.location.origin;

            const code = `<script src="${domain}/bot.js" data-name="${name}" data-color="${color}" data-pos="${pos}"><\/script>`;
            document.getElementById('script-code').innerText = code;
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function scrollToBuilder() {
            document.getElementById('builder').scrollIntoView({ behavior: 'smooth' });
        }

        // Initialize preview
        updatePreview();
    </script>
</body>
</html>
