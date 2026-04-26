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
                    <button onclick="showDemoModal()" class="w-full py-4 rounded-xl glass border border-slate-700 text-red-500 font-bold mt-4 hover:bg-red-500/10 transition">
                        Ver demo
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

    <!-- Demo Modal (Overlay) -->
    <div id="demo-modal" class="fixed inset-0 bg-black/90 hidden flex-col items-center justify-center z-[60] p-4">
        <div class="relative w-full max-w-6xl h-[90vh] bg-slate-50 rounded-2xl overflow-hidden flex flex-col shadow-2xl">
            <!-- Modal Header -->
            <div class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center text-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    <h3 class="font-bold text-lg ml-4">Demo en vivo: Sitio de ejemplo</h3>
                </div>
                <button onclick="closeDemoModal()" class="text-slate-400 hover:text-red-500 transition font-bold text-2xl leading-none">&times;</button>
            </div>
            
            <!-- Iframe Container for the Mini Site -->
            <iframe id="demo-iframe" class="w-full flex-grow bg-white border-none"></iframe>
            
            <div class="p-4 bg-white border-t border-slate-200 text-center flex justify-center shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)] z-10 relative">
                 <button onclick="closeDemoModal()" class="px-8 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition shadow-lg">
                    Cerrar Demo
                </button>
            </div>
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
            const prompt = document.getElementById('bot-prompt').value.replace(/"/g, '&quot;');
            const domain = window.location.origin;

            const code = `<script src="${domain}/bot.js" data-name="${name}" data-color="${color}" data-pos="${pos}" data-prompt="${prompt}"><\/script>`;
            document.getElementById('script-code').innerText = code;
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function showDemoModal() {
            const name = document.getElementById('bot-name').value;
            const color = document.getElementById('bot-color').value;
            const pos = document.getElementById('bot-pos').value;
            const prompt = document.getElementById('bot-prompt').value.replace(/"/g, '&quot;');
            const domain = window.location.origin;

            const scriptCode = `<script src="${domain}/bot.js" data-name="${name}" data-color="${color}" data-pos="${pos}" data-prompt="${prompt}"><\/script>`;
            
            const htmlContent = `
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Mini Sitio</title>
    <script src="https://cdn.tailwindcss.com"><\/script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }<\/style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-black text-slate-900 tracking-tighter">Mi<span class="text-blue-600">Empresa</span></div>
            <nav class="hidden md:flex gap-8 text-sm font-semibold text-slate-600">
                <a href="#" class="hover:text-blue-600 transition">Inicio</a>
                <a href="#" class="hover:text-blue-600 transition">Servicios</a>
                <a href="#" class="hover:text-blue-600 transition">Casos de Éxito</a>
                <a href="#" class="hover:text-blue-600 transition">Contacto</a>
            </nav>
            <button class="hidden md:block px-5 py-2 bg-slate-900 text-white text-sm font-semibold rounded-lg hover:bg-slate-800 transition">Comenzar</button>
        </div>
    </header>

    <main class="flex-grow">
        <section class="bg-white py-24 px-6 text-center border-b border-slate-200">
            <div class="max-w-4xl mx-auto">
                <div class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 font-semibold text-sm mb-6 border border-blue-100">
                    Nueva integración de IA disponible
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-8 tracking-tight leading-tight">Revoluciona la <br/>atención al cliente</h1>
                <p class="text-xl md:text-2xl text-slate-500 mb-12 leading-relaxed max-w-2xl mx-auto">Esta es una página de demostración. Observa cómo el widget de tu agente inteligente se integra perfectamente en un entorno real.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 text-lg">Solicitar Demo</button>
                    <button class="px-8 py-4 bg-white text-slate-700 font-semibold rounded-xl border-2 border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition text-lg">Ver Documentación</button>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 text-slate-900">Por qué elegirnos</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-8">⚡</div>
                    <h3 class="text-xl font-bold mb-4 text-slate-900">Automatización Inteligente</h3>
                    <p class="text-slate-500 leading-relaxed">Respuestas instantáneas y precisas a las preguntas frecuentes de tus clientes, 24/7 sin interrupciones.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl mb-8">🎯</div>
                    <h3 class="text-xl font-bold mb-4 text-slate-900">Hiper-Personalización</h3>
                    <p class="text-slate-500 leading-relaxed">Adapta el tono y estilo de la comunicación para que coincida perfectamente con la identidad de tu marca.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-2xl mb-8">📈</div>
                    <h3 class="text-xl font-bold mb-4 text-slate-900">Aumento de Conversión</h3>
                    <p class="text-slate-500 leading-relaxed">Guía a tus visitantes a través del embudo de ventas mediante interacciones conversacionales efectivas.</p>
                </div>
            </div>
        </section>
        
        <section class="bg-slate-900 py-24 px-6 text-center text-white">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl font-bold mb-6">¿Listo para transformar tu negocio?</h2>
                <p class="text-xl text-slate-400 mb-10">Únete a miles de empresas que ya utilizan nuestra plataforma para potenciar sus ventas y soporte.</p>
                <button class="px-8 py-4 bg-white text-slate-900 font-bold rounded-xl hover:bg-slate-100 transition shadow-lg text-lg">Crear cuenta gratis</button>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-slate-200 text-slate-500 py-12 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-xl font-black text-slate-900 tracking-tighter">Mi<span class="text-blue-600">Empresa</span></div>
            <div class="text-sm">© 2026 MiEmpresa Inc. Todos los derechos reservados.</div>
            <div class="flex gap-6 text-sm font-medium">
                <a href="#" class="hover:text-slate-900 transition">Términos</a>
                <a href="#" class="hover:text-slate-900 transition">Privacidad</a>
            </div>
        </div>
    </footer>

    ${scriptCode}
</body>
</html>
            `;
            
            document.getElementById('demo-iframe').srcdoc = htmlContent;
            document.getElementById('demo-modal').style.display = 'flex';
        }

        function closeDemoModal() {
            document.getElementById('demo-modal').style.display = 'none';
            document.getElementById('demo-iframe').srcdoc = ''; // Clear iframe content
        }

        function scrollToBuilder() {
            document.getElementById('builder').scrollIntoView({ behavior: 'smooth' });
        }

        // Initialize preview
        updatePreview();
    </script>
</body>
</html>
