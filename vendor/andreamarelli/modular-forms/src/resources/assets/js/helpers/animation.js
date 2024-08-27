export default {

    scrollPageTo(scrollTo){
        window.scroll({
            top: scrollTo,
            left: 0,
            behavior: 'smooth'
        });
    },

    scrollPageToAnchor(anchor) {
        this.scrollPageTo(document.querySelector('#'+anchor).offsetTop);
    },

    copyToClipboard(textToCopy, alertMessage) {
        let dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = textToCopy;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        this.showAlert(alertMessage);
    },

    showAlert(message){
        let element = document.createElement("div");
        // element.setAttribute("id", "tempAlert");
        element.style.display = 'none';
        element.className = 'alert-popup';
        element.innerHTML = message;
        document.body.appendChild(element);
        $(element).fadeTo(2000, 500).slideUp(500, function () {
            document.body.removeChild(element);
        });
    }

}
