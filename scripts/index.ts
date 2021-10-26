import "../css/style.css";
import { Switch, ThemeState } from "./switch";

const THEME_HEADER_QUERY: string = "body .wp-site-blocks header nav ul";

// Main function
document.addEventListener("DOMContentLoaded", () => {
    let switchElement = new Switch({
        body: document.querySelector("body"),
    });

    let header = document.querySelector(THEME_HEADER_QUERY);

    // Append switch to header
    header.appendChild(switchElement.getElement);

    switchElement.getElement.addEventListener("click", () => {
        switchElement.changeStateAuto();
    });
});
