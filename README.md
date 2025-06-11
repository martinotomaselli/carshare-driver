# 🚗 Car Share Driver

Mini piattaforma di **car sharing** sviluppata in **Laravel 10**, progettata per la gestione dei veicoli e l’autenticazione degli utenti.  
Realizzata per un secondo colloquio tecnico.

---

##  Funzionalità attuali

- Registrazione e login utente (Laravel Breeze)
- Accesso sicuro con autenticazione
- Dashboard utente protetta
- CRUD completo dei veicoli:
  - Aggiunta veicolo
  - Modifica veicolo
  - Eliminazione veicolo
  - Visualizzazione lista veicoli

---

##  Stack Tecnologico

- **Laravel 10** (con Blade)
- **PHP 8+**
- **MySQL** (gestito via DBeaver)
- **Tailwind CSS** (preset Breeze)
- **Bootstrap** (per elementi UI rapidi)
- **VS Code** + Git + GitHub

---

##  Struttura del progetto

- `routes/web.php` – Tutte le rotte web protette e pubbliche
- `app/Http/Controllers/VehicleController.php` – Gestione veicoli
- `resources/views/vehicles/` – Vista `index`, `create`, `edit`
- `database/migrations/` – Tabella `vehicles`
- `.env` – Configurazione DB

---

##  Come eseguire il progetto

```bash
git clone https://github.com/martinotomaselli/carshare-driver.git
cd carshare-driver
composer install
cp .env.example .env
php artisan key:generate
# Imposta DB in .env
php artisan migrate
php artisan serve
