export class Chat {

    constructor() {
        this.ID_INTERVAL = setInterval(this.refreshMessages, 5000);
        this.SEND_BUTTON = document.body.querySelector("#sendButton");
        this.SCROLL_OVERFLOW = document.body.querySelector("#scroll-overflow");
        this.CONTENT = document.body.querySelector("#content");
    }

    refreshMessages() {
        fetch('./../../php/controller/get_messages_processing.php')
            .then(response => response.text())
            .then(messages => {
                document.querySelector('#messages-container').innerHTML = messages;
            });

    }

    sendMessage(MESSAGE) {

        if (!this.isEmpty(MESSAGE)) {

            this.SEND_BUTTON.disabled = true;
            this.CONTENT.disabled = true;

            const TIMEOUT_ID = setTimeout(() => {

                this.SEND_BUTTON.disabled = false;
                this.CONTENT.disabled = false;

            }, 3000);

            const DATA = new FormData();
            DATA.append('content', MESSAGE);
            fetch('./../../php/controller/send_message_processing.php', {
                method: 'POST',
                body: DATA
            })
                .then(response => response.text())
                .then(messages => {
                    document.querySelector('#messages-container').innerHTML = messages;
                    this.CONTENT.value = "";
                    this.SCROLL_OVERFLOW.scrollTo(0, 8000)
                });

        }
    }

    getSendButton() {
        return this.SEND_BUTTON;
    }

    getScrollOverflow() {
        return this.SCROLL_OVERFLOW;
    }

    getContent() {
        return this.CONTENT;
    }

    isEmpty(str) {
        return str.trim().length === 0;
    }
}