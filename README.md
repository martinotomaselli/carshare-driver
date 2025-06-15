# 🚗 CarShare Driver - Mini Piattaforma di Car Sharing

Mini-app full stack per simulare una piattaforma di car sharing, con funzionalità essenziali e design intuitivo. Consente a utenti (driver) di registrarsi, cercare veicoli disponibili, effettuare prenotazioni e pagamenti, con l'integrazione di un **chatbot AI** intelligente come assistente virtuale.

---

##  Funzionalità Implementate

### 1. Autenticazione e Gestione Utenti

- Registrazione e login sicuri (Laravel Auth)
- Dashboard personale con cronologia prenotazioni

###  Ricerca Veicoli

- Elenco veicoli disponibili con marca, modello, prezzo
- Pulsante "Prenota" attivo per ogni veicolo

###  Prenotazioni

- Simulazione di prenotazione per ogni utente
- Storico prenotazioni nella dashboard personale
  
### Revisore (Moderazione)

Gli utenti possono richiedere di diventare revisori dalla propria dashboard.
L’amministratore può approvare o rifiutare le richieste.
I revisori approvati hanno accesso a un pannello di amministrazione con strumenti aggiuntivi (es. gestione veicoli).

###  Pagamenti (Opzionale)

- Integrazione con Stripe (test mode, gratuito)
- Checkout con carta di test
- Conferma di pagamento e pagina di successo

###  Chatbot AI (Extra)

- Microservizio FastAPI con modello **Ollama**
- Il bot conosce le reali funzionalità della piattaforma
- Guida l’utente su prenotazioni, login, dashboard ecc.
- Risposte amichevoli e personalizzate

---

##  Tecnologie Utilizzate

- **Laravel 10**
- **MySQL (TablePlus)**
- **Bootstrap 5**
- **FastAPI + Python 3.11**
- **Ollama (LLM locale)**
- **Stripe (checkout sandbox)**
- **JavaScript fetch/AJAX**

---

##  Istruzioni per l'installazione

### Backend (Laravel)

```bash
git clone https://github.com/tuo-utente/carshare-driver.git
cd carshare-driver
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
