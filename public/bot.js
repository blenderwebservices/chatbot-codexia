// BotGenius Integration Script
(function() {
    const script = document.currentScript;
    const name = script.getAttribute('data-name') || 'BotGenius';
    const color = script.getAttribute('data-color') || '#3b82f6';
    const pos = script.getAttribute('data-pos') || 'right';
    const promptConfig = script.getAttribute('data-prompt') || '';
    const domain = new URL(script.src).origin;

    const container = document.createElement('div');
    container.style.position = 'fixed';
    container.style.bottom = '20px';
    container.style[pos] = '20px';
    container.style.zIndex = '9999';
    container.style.fontFamily = 'sans-serif';

    const button = document.createElement('button');
    button.innerHTML = '💬';
    button.style.width = '60px';
    button.style.height = '60px';
    button.style.borderRadius = '50%';
    button.style.backgroundColor = color;
    button.style.color = 'white';
    button.style.border = 'none';
    button.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    button.style.cursor = 'pointer';
    button.style.fontSize = '24px';
    button.style.transition = 'transform 0.2s';
    button.onmouseover = () => button.style.transform = 'scale(1.1)';
    button.onmouseout = () => button.style.transform = 'scale(1)';

    const chatWindow = document.createElement('div');
    chatWindow.style.display = 'none';
    chatWindow.style.width = '350px';
    chatWindow.style.height = '500px';
    chatWindow.style.backgroundColor = 'white';
    chatWindow.style.borderRadius = '20px';
    chatWindow.style.boxShadow = '0 12px 24px rgba(0,0,0,0.2)';
    chatWindow.style.flexDirection = 'column';
    chatWindow.style.overflow = 'hidden';
    chatWindow.style.marginBottom = '20px';
    chatWindow.style.border = '1px solid #eee';

    chatWindow.innerHTML = `
        <div style="background-color: ${color}; padding: 20px; color: white; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 30px; height: 30px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">AI</div>
                <span>${name}</span>
            </div>
            <button id="close-chat" style="background: none; border: none; color: white; cursor: pointer; font-size: 16px;">✕</button>
        </div>
        <div id="chat-messages" style="flex-grow: 1; padding: 20px; overflow-y: auto; background-color: #f8fafc; display: flex; flex-direction: column; gap: 10px;">
            <div style="background-color: #e2e8f0; color: #1e293b; padding: 12px 16px; border-radius: 15px; border-bottom-left-radius: 4px; font-size: 14px; max-width: 85%; align-self: flex-start;">
                ¡Hola! Soy ${name}. ¿En qué puedo ayudarte?
            </div>
        </div>
        <div style="padding: 15px; border-top: 1px solid #eee; display: flex; gap: 10px; background: white;">
            <input type="text" id="chat-input" placeholder="Escribe un mensaje..." style="flex-grow: 1; padding: 12px; border: 1px solid #e2e8f0; border-radius: 12px; outline: none; font-size: 14px; transition: border-color 0.2s;">
            <button id="chat-send" style="background-color: ${color}; color: white; border: none; padding: 0 20px; border-radius: 12px; cursor: pointer; font-weight: bold; transition: opacity 0.2s;">➜</button>
        </div>
    `;

    container.appendChild(chatWindow);
    container.appendChild(button);
    document.body.appendChild(container);

    const messagesContainer = chatWindow.querySelector('#chat-messages');
    const inputField = chatWindow.querySelector('#chat-input');
    const sendButton = chatWindow.querySelector('#chat-send');

    let isWaiting = false;
    let chatHistory = [];

    function addMessage(text, isUser = false) {
        const msgDiv = document.createElement('div');
        msgDiv.style.padding = '12px 16px';
        msgDiv.style.borderRadius = '15px';
        msgDiv.style.fontSize = '14px';
        msgDiv.style.maxWidth = '85%';
        msgDiv.style.lineHeight = '1.4';
        
        if (isUser) {
            msgDiv.style.backgroundColor = color;
            msgDiv.style.color = 'white';
            msgDiv.style.alignSelf = 'flex-end';
            msgDiv.style.borderBottomRightRadius = '4px';
        } else {
            msgDiv.style.backgroundColor = '#e2e8f0';
            msgDiv.style.color = '#1e293b';
            msgDiv.style.alignSelf = 'flex-start';
            msgDiv.style.borderBottomLeftRadius = '4px';
        }
        
        msgDiv.innerText = text;
        messagesContainer.appendChild(msgDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function addTypingIndicator() {
        const id = 'typing-' + Date.now();
        const msgDiv = document.createElement('div');
        msgDiv.id = id;
        msgDiv.style.padding = '12px 16px';
        msgDiv.style.borderRadius = '15px';
        msgDiv.style.borderBottomLeftRadius = '4px';
        msgDiv.style.fontSize = '14px';
        msgDiv.style.backgroundColor = '#e2e8f0';
        msgDiv.style.color = '#1e293b';
        msgDiv.style.alignSelf = 'flex-start';
        msgDiv.innerHTML = '<span style="animation: botPulse 1.5s infinite">● ● ●</span>';
        
        if (!document.getElementById('bot-typing-styles')) {
            const style = document.createElement('style');
            style.id = 'bot-typing-styles';
            style.innerHTML = '@keyframes botPulse { 0%, 100% { opacity: 0.5; } 50% { opacity: 1; } }';
            document.head.appendChild(style);
        }

        messagesContainer.appendChild(msgDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        return id;
    }

    function removeTypingIndicator(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    async function sendMessage() {
        const text = inputField.value.trim();
        if (!text || isWaiting) return;

        inputField.value = '';
        addMessage(text, true);

        const typingId = addTypingIndicator();
        isWaiting = true;
        sendButton.style.opacity = '0.5';

        try {
            const response = await fetch(`${domain}/api/bot/chat`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: text,
                    prompt: promptConfig,
                    history: chatHistory
                })
            });

            const data = await response.json();
            removeTypingIndicator(typingId);
            
            let aiText = "Lo siento, hubo un error procesando tu mensaje.";
            if (response.ok && data.success && data.response) {
                aiText = data.response;
            } else if (data.error) {
                aiText = data.error;
            }

            addMessage(aiText, false);
            chatHistory.push({ role: 'user', content: text });
            chatHistory.push({ role: 'assistant', content: aiText });

        } catch (error) {
            removeTypingIndicator(typingId);
            addMessage("Error de conexión. Intenta nuevamente más tarde.", false);
        } finally {
            isWaiting = false;
            sendButton.style.opacity = '1';
            inputField.focus();
        }
    }

    sendButton.onclick = sendMessage;
    inputField.onkeypress = (e) => {
        if (e.key === 'Enter') sendMessage();
    };

    button.onclick = () => {
        chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex' : 'none';
        if (chatWindow.style.display === 'flex') {
            inputField.focus();
        }
    };

    chatWindow.querySelector('#close-chat').onclick = () => {
        chatWindow.style.display = 'none';
    };
})();
