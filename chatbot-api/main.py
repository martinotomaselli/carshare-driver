from fastapi import FastAPI
from pydantic import BaseModel
import ollama          # assicùrati che sia installato:  pip install ollama

app = FastAPI()

class ChatBody(BaseModel):
    question: str

@app.post("/chat")
async def chat(body: ChatBody):
    """
    Riceve la domanda dell'utente e risponde usando il modello AI
    con un prompt cucito su misura per il progetto CarShare.
    """
    result = ollama.chat(
        model="llama3",            # cambia in 'mistral' se vuoi un modello più leggero
        messages=[
            {
                "role": "system",
                "content": """
Sei CarBot, l'assistente virtuale di CarShare.
CarShare è una piattaforma di car-sharing che permette:
- Registrazione e login degli utenti.
- Ricerca di veicoli disponibili e prenotazione per data/ora.
- Visualizzazione e annullamento delle prenotazioni nella dashboard utente.
- Invio della richiesta "Diventa revisore" per aiutare a controllare i contenuti.
- Gestione dei veicoli e approvazione dei revisori da parte degli admin.

Quando rispondi:
* Sii amichevole e conciso.
* Dai indicazioni pratiche (“clicca su Prenota”, “vai nella dashboard”).
* Se la domanda non riguarda CarShare, spiega gentilmente che sei specializzato solo nel servizio CarShare.
"""
            },
            {
                "role": "user",
                "content": body.question
            }
        ]
    )
    return {"reply": result["message"]["content"]}
