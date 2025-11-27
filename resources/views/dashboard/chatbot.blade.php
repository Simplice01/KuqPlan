
<div class="container">
  <div id="chatbot" class="chatbot">
      <div id="chatbox" class="chatbox">
          <div id="messages" class="messages"></div>
          <div style="display: flex; align-items: center;">
              <input type="text" id="user-input" placeholder="Posez une question..." />
              <button id="send-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                      <path d="m21.426 11.095-17-8A1 1 0 0 0 3.03 4.242l1.212 4.849L12 12l-7.758 2.909-1.212 4.849a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81z"></path>
                  </svg>
              </button>
          </div>
      </div>
      <button style="background: none;" id="chatbot-toggle">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: orange;transform: ;msFilter:;">
              <path d="M21.928 11.607c-.202-.488-.635-.605-.928-.633V8c0-1.103-.897-2-2-2h-6V4.61c.305-.274.5-.668.5-1.11a1.5 1.5 0 0 0-3 0c0 .442.195.836.5 1.11V6H5c-1.103 0-2 .897-2 2v2.997l-.082.006A1 1 0 0 0 1.99 12v2a1 1 0 0 0 1 1H3v5c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5a1 1 0 0 0 1-1v-1.938a1.006 1.006 0 0 0-.072-.455zM5 20V8h14l.001 3.996L19 12v2l.001.005.001 5.995H5z"></path>
              <ellipse cx="8.5" cy="12" rx="1.5" ry="2"></ellipse>
              <ellipse cx="15.5" cy="12" rx="1.5" ry="2"></ellipse>
              <path d="M8 16h8v2H8z"></path>
          </svg>
      </button>
  </div>
</div>



  <script>
document.addEventListener('DOMContentLoaded', function () {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbox = document.getElementById('chatbox');
    const sendBtn = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const messages = document.getElementById('messages');

    chatbotToggle.addEventListener('click', function () {
        chatbox.style.display = chatbox.style.display === 'block' ? 'none' : 'block';
    });

    sendBtn.addEventListener('click', function () {
        const userMessage = userInput.value.toLowerCase();
        addMessage(userMessage, 'user');

        const botResponse = getResponse(userMessage);
        addMessage(botResponse, 'bot');

        userInput.value = ''; // Clear input
    });

    function addMessage(message, sender) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', sender);
        messageElement.textContent = message;
        messages.appendChild(messageElement);
        messages.scrollTop = messages.scrollHeight; // Scroll to the bottom
    }

    function getResponse(userMessage) {
        if (userMessage === '') {
            return "Bonjour ! Comment puis-je vous aider aujourd'hui ?";
        }

        for (const [key, response] of Object.entries(responses)) {
            if (userMessage.includes(key)) {
                return response;
            }
        }
        return "Je ne comprends pas votre question. Pouvez-vous la reformuler ou consulter notre site pour plus d'informations ?";
    }

    const responses = {
        "site": "Innov-Deks est un site qui vous permet d'avoir des informations sur les nouvelles innovations dans le domaine de l'intelligence artificielle en Afrique de l'ouest.",
        "cc": "Oui ! Comment puis-je vous aider aujourd'hui ?",
        "merci": "Je suis disponible pour d'autres préoccupations. Bonne visite sur Innov-Deks !",
        "bonjour": "Bonjour ! Comment puis-je vous aider aujourd'hui ?",
        "prix": "Le prix de chaque publication est de 19.99€. Pour plus de détails sur le prix de publications spécifiques, veuillez consulter la page de la publication ou contacter l'auteur.",
        "article": "Pour obtenir plus d'informations sur un article spécifique, vous pouvez contacter l'auteur directement via WhatsApp. Les informations de contact de l'auteur sont disponibles sur la page de chaque publication.",
        "livraison": "Toutes nos publications sont numériques, donc aucune livraison physique n'est nécessaire. Vous pouvez les télécharger directement après l'achat.",
        "aide": "Je suis là pour vous aider avec vos questions sur nos publications numériques. Que souhaitez-vous savoir ?",
        "commande": "Pour passer une commande, veuillez visiter la page de la publication souhaitée et suivre les instructions pour l'achat. Vous pouvez également ajouter les publications à votre panier et procéder au paiement.",
        "paiement": "Nous acceptons plusieurs méthodes de paiement pour votre commodité. Pour plus de détails sur les options de paiement disponibles, veuillez consulter notre page de paiement.",
        "soutien": "Si vous avez besoin de soutien ou avez des questions supplémentaires, n'hésitez pas à contacter notre service client. Nous sommes là pour vous aider avec tout problème ou question que vous pourriez avoir.",
        "fonctionnalités": "Nos publications offrent divers contenus numériques, y compris des livres électroniques, des guides, et plus encore. Chaque publication a une description détaillée sur sa page dédiée.",
        "intelligence artificielle": "L'intelligence artificielle (IA) est un domaine de l'informatique qui se concentre sur la création de systèmes capables de réaliser des tâches qui nécessitent normalement l'intelligence humaine, comme la reconnaissance vocale, la vision par ordinateur et la prise de décision.",
        "machine learning": "Le machine learning est une sous-catégorie de l'intelligence artificielle qui permet aux systèmes de s'améliorer automatiquement à partir de l'expérience sans être explicitement programmés.",
        "réseaux neuronaux": "Les réseaux neuronaux sont un ensemble d'algorithmes, inspirés du cerveau humain, qui sont conçus pour reconnaître des motifs. Ils forment la base de nombreux systèmes d'intelligence artificielle.",
        "big data": "Le big data fait référence aux ensembles de données volumineux et complexes qui sont analysés pour révéler des modèles, des tendances et des associations, en particulier en relation avec le comportement humain et les interactions.",
        "nlp": "Le traitement du langage naturel (NLP) est une branche de l'intelligence artificielle qui se concentre sur l'interaction entre les ordinateurs et les humains via le langage naturel.",
        "robotique": "La robotique est un domaine de l'ingénierie et des sciences qui comprend la conception, la construction, le fonctionnement et l'utilisation de robots. Les robots sont souvent utilisés pour accomplir des tâches qui sont dangereuses ou répétitives pour les humains.",
        "deep learning": "Le deep learning est un sous-ensemble du machine learning qui utilise des réseaux neuronaux à plusieurs couches pour analyser différentes caractéristiques des données.",
        "cloud computing": "Le cloud computing est la livraison de services informatiques, y compris le stockage, la puissance de calcul et les bases de données, via Internet. Il permet de stocker et de traiter des données de manière flexible.",
        "ia forte": "L'IA forte est un concept hypothétique d'une intelligence artificielle qui pourrait accomplir n'importe quelle tâche intellectuelle que peut accomplir un être humain, avec une conscience et une compréhension égales à celles d'un humain.",
        "éthique de l'ia": "L'éthique de l'intelligence artificielle se concentre sur les préoccupations morales et sociétales qui émergent avec le développement et l'utilisation de l'IA. Cela inclut des questions sur la confidentialité, la sécurité, et l'impact sur l'emploi.",
        "ia": "L'intelligence artificielle (IA) est un domaine de l'informatique qui vise à créer des machines capables d'effectuer des tâches qui nécessitent normalement une intelligence humaine, telles que la reconnaissance de la parole, la prise de décision et la résolution de problèmes. Que souhaitez-vous savoir ?",
        "l'ia": "L'intelligence artificielle (IA) est un domaine de l'informatique qui vise à créer des machines capables d'effectuer des tâches qui nécessitent normalement une intelligence humaine, telles que la reconnaissance de la parole, la prise de décision et la résolution de problèmes. Que souhaitez-vous savoir ?"
    };

});

</script>




<style>
    .chatbot {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: black;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 100;
}

#chatbox {
  display: none;
  border: 2px solid orange;
  border-radius: 10px;
  width: 300px;
  padding: 15px;
}

#messages {
  height: 200px;
  overflow-y: scroll;
  border-bottom: 1px solid orange;
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
}

#user-input {
  width: calc(100% - 60px);
  padding: 5px;
  border: 1px solid orange;
  background: none;
  color: rgb(255, 255, 255);
}

#send-btn {
  padding: 5px 10px;
  background: none;
  color: white;
  border: none;
  cursor: pointer;
}

#chatbot-toggle {
  padding: 10px;
  background-color: orange;
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
}

.message {
  padding: 10px;
  margin: 5px 0;
  border-radius: 5px;
  max-width: 70%;
  clear: both;
  display: inline-block;
}

.user {
  background-color: #f1f1f1;
  text-align: right;
  align-self: flex-end;
}

.bot {
  background-color: orange;
  text-align: left;
  color: white;
  align-self: flex-start;
}


</style>

