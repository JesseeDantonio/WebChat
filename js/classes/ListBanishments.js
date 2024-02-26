class ListBanishments {

    constructor() {
        this.ID_INTERVAL = setInterval(this.refresh, 5000);
    }

    refresh() {
        fetch('./../../php/controller/get_list_bans_processing.php')
            .then(response => response.text())
            .then(messages => {
                document.querySelector('#list-container').innerHTML = messages;
            });

    }
}