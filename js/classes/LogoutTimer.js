export class LogoutTimer {

    constructor(logoutPath) {
        this.logoutTimer = null;
        this.logoutTime = 600000; // Temps en millisecondes, soit 10 minutes. 600000
        this.logoutPath = logoutPath; // Chemin d'accès au processus de déconnexion PHP 
    }

    // Déconnexion
    logout() {
        window.location.href = this.logoutPath;
    }

    // Fonction qui initialise le minuteur
    initLogoutTimer() {
        if (this.logoutTimer !== null) {
            clearTimeout(this.logoutTimer);
        }

        this.logoutTimer = setTimeout(() => {
            this.logout()
        }, this.logoutTime);
    }

    // Fonction qui réinitialise le minuteur
    resetLogoutTimer() {
        this.initLogoutTimer();
    }
}