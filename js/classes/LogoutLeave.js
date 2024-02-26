export class LogoutLeave {


    constructor(logoutPath) {
        this.logoutPath = logoutPath;
    }

    // Déconnexion
    logout() {
        fetch(this.logoutPath);
    }


}