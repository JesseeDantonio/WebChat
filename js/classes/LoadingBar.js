class LoadingBar {

    constructor() {
        this.ID = undefined;
        this.LOADING = document.querySelector('.loading');
        this.currentProgress = 0;
    }

    start() {
        this.ID = setInterval(function () {
            if (currentProgress < 100) {
                const increment = 100;
                this.currentProgress += increment;
                if (this.currentProgress > 100) {
                    reset();
                }
                setProgress(this.currentProgress);
            } else {
                reset();
            }
        }, 500);
    }

    reset() {
        clearInterval(this.ID);
        this.ID = undefined;
        setProgress(0);
        this.currentProgress = 0;
    }

    setProgress(progress) {
        this.LOADING.style.width = `${progress}%`;
    }


}