class ListUsers {

    constructor() {
        this.ID_INTERVAL = setInterval(this.refresh, 5000);
    }

    refresh() {

        fetch('./../../php/controller/get_list_users_processing.php')
            .then(response => response.text())
            .then(messages => {
                document.querySelector('#list-container').innerHTML = messages;
            });

    }

}