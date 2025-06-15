document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('chatbot-toggle');
  const box    = document.getElementById('chatbot-box');
  const close  = document.getElementById('chatbot-close');
  const form   = document.getElementById('chatbot-form');
  const input  = document.getElementById('chatbot-input');
  const msgs   = document.getElementById('chatbot-messages');

  const route  = document.querySelector('meta[name="chatbot-route"]').content;
  const token  = document.querySelector('meta[name="csrf-token"]').content;

  const addMsg = (role, text) => {
    const div = document.createElement('div');
    div.className = `msg ${role}`;
    div.textContent = text;
    msgs.appendChild(div);
    msgs.scrollTop = msgs.scrollHeight;
  };

  toggle.addEventListener('click', () => box.classList.toggle('hidden'));
  close .addEventListener('click', () => box.classList.add('hidden'));

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const message = input.value.trim();
    if (!message) return;

    addMsg('user', message);
    input.value = '';
    try {
      const res  = await fetch(route, {
        method : 'POST',
        headers: {
          'Content-Type'  : 'application/json',
          'X-CSRF-TOKEN'  : token
        },
        body: JSON.stringify({ message })
      });
      const data = await res.json();
      addMsg('bot', data.reply ?? '⚠️ Nessuna risposta');
    } catch (err) {
      addMsg('bot', '❌ Errore di rete');
    }
  });
});
