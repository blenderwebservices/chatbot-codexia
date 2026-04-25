// BotGenius Integration Script
(function() {
    const script = document.currentScript;
    const name = script.getAttribute('data-name') || 'BotGenius';
    const color = script.getAttribute('data-color') || '#3b82f6';
    const pos = script.getAttribute('data-pos') || 'right';

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
        <div style="background-color: ${color}; padding: 20px; color: white; font-weight: bold; display: flex; justify-content: space-between;">
            <span>${name}</span>
            <button id="close-chat" style="background: none; border: none; color: white; cursor: pointer;">✕</button>
        </div>
        <div id="chat-messages" style="flex-grow: 1; padding: 20px; overflow-y: auto; background-color: #f8fafc;">
            <div style="background-color: #e2e8f0; padding: 10px 15px; border-radius: 15px; font-size: 14px; max-width: 80%; margin-bottom: 10px;">
                ¡Hola! Soy ${name}. ¿En qué puedo ayudarte?
            </div>
        </div>
        <div style="padding: 15px; border-top: 1px solid #eee; display: flex; gap: 10px;">
            <input type="text" placeholder="Escribe un mensaje..." style="flex-grow: 1; padding: 10px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-size: 14px;">
            <button style="background-color: ${color}; color: white; border: none; padding: 10px 15px; border-radius: 10px; cursor: pointer;">➜</button>
        </div>
    `;

    container.appendChild(chatWindow);
    container.appendChild(button);
    document.body.appendChild(container);

    button.onclick = () => {
        chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex' : 'none';
    };

    chatWindow.querySelector('#close-chat').onclick = () => {
        chatWindow.style.display = 'none';
    };
})();
