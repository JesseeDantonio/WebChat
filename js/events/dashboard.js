import { LogoutTimer } from "../classes/LogoutTimer.js";
import { Chat } from "../classes/Chat.js";
import { ResponsiveDesign } from "../classes/ResponsiveDesign.js";
import { LogoutLeave } from "../classes/LogoutLeave.js";

let url_dir = document.URL.substring(0, document.URL.lastIndexOf('/'));
url_dir = url_dir.substring(0, url_dir.lastIndexOf('/'));
url_dir = url_dir.substring(0, url_dir.lastIndexOf('/'));

const LOGOUT_TIMER = new LogoutTimer(url_dir + "/php/controller/logout_processing.php");
const CHAT = new Chat();
const RESPONSIVE_DESIGN = new ResponsiveDesign();
const LOGOUT_LEAVE = new LogoutLeave(url_dir + "/php/controller/logout_processing.php");

document.body.addEventListener("mousemove", (event) => {

  const TIMEOUT_ID = setTimeout(() => {
    // Réinitialiser le minuteur sur l'événement de souris
    LOGOUT_TIMER.resetLogoutTimer();
  }, 1000);

});

CHAT.getSendButton().addEventListener("click", (event) => {

  const MESSAGE = CHAT.getContent().value;

  CHAT.sendMessage(MESSAGE);
});

document.body.addEventListener('keypress', (event) => {

  const TIMEOUT_ID = setTimeout(() => {
    // Réinitialiser le minuteur sur l'événement de clavier
    LOGOUT_TIMER.resetLogoutTimer();
  }, 1000);

  if (event.key === 'Enter') {

    const MESSAGE = CHAT.getContent().value;

    CHAT.sendMessage(MESSAGE);
  }

});

window.addEventListener("pagehide", (event) => {
  // Déconnexion de l'utilisateur si il quitte la page sans se déconnecter.
  LOGOUT_LEAVE.logout();
});

CHAT.getScrollOverflow().scrollTo(0, 8000);
