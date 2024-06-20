function docload() {
    document.querySelectorAll(".uk-heading-line").forEach((el) => {
        if (!el.querySelector("span")) {
            let span = document.createElement('span');
            span.textContent = el.textContent
            el.textContent = ""
            el.appendChild(span)
        }
    });
}

window.addEventListener("load", docload);