import "../css/style.css";
import { Switch } from "./switch";

// Add switch to Header
document.addEventListener("DOMContentLoaded", () => {
    const header: Element = document.querySelector(
        "body .wp-site-blocks header nav ul"
    );

    let switchElement = new Switch({
        body: document.querySelector("body"),
    });

    // Append switch to header
    header.appendChild(switchElement.getElement);

    switchElement.getElement.addEventListener("click", () => {
        switchElement.changeStateAuto();
    });
});

/**
 * @name handleWindowClick
 * @description Handle Window click event
 * @param {Event} event
 * @returns void
 */
function handleWindowClick(event: MouseEvent): void {
    // First get click taget
    const target = event.target;

    const nav: Element = document.querySelector("nav .has-modal-open");
    const body: Element = document.querySelector("body");
    const html: Element = document.querySelector("html");

    switch (target) {
        case body:
            // Close nav
            html.classList.remove("has-modal-open");
            nav.classList.remove("is-menu-open");
            break;

        default:
            break;
    }
}

// On window click
window.addEventListener("click", handleWindowClick);
