/**
 * Switch for Light/Dark theme
 */

const LIGHT_MODE_SVG: string =
    '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0 c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2 c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1 C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06 c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41 l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41 c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36 c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"/></svg>';

const DARK_MODE_SVG: string =
    '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36c-0.98,1.37-2.58,2.26-4.4,2.26 c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"/></svg>';

const SYSTEM_MODE_SVG: string =
    '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M20 15.31L23.31 12 20 8.69V4h-4.69L12 .69 8.69 4H4v4.69L.69 12 4 15.31V20h4.69L12 23.31 15.31 20H20v-4.69zM12 18V6c3.31 0 6 2.69 6 6s-2.69 6-6 6z"/></svg>';


/**
 * @name clearInnerHTML
 * @description Clears inner html of element and set some new data. 
 * @param {Element} element target element
 * @param {string} html for replace after clear
 * @returns void
 */
function clearInnerHTML(element: Element, html: string): void {
    element.innerHTML = "";
    element.innerHTML = html;
}

/**
 * @enum
 */
export enum ThemeState {
    DARK,
    LIGHT,
    SYSTEM,
}

/**
 * @function
 * @name returnSvg
 * @description Recives state returns svg
 * @param state ThemeState
 * @returns string SVG
 */
function returnSvg(state: ThemeState): string {
    switch (state) {
        case ThemeState.LIGHT:
            return LIGHT_MODE_SVG;
        case ThemeState.DARK:
            return DARK_MODE_SVG;
        case ThemeState.SYSTEM:
            return SYSTEM_MODE_SVG;
        default:
            break;
    }
}
/**
 * @function
 * @name themeStateToString
 * @description Covert ThemeState to string
 * @param state ThemeState
 * @returns string
 */
function themeStateToString(state: ThemeState): string {
    switch (state) {
        case ThemeState.DARK:
            return "dark";

        case ThemeState.LIGHT:
            return "light";

        case ThemeState.SYSTEM:
            return "system";

        default:
            break;
    }
}

/**
 * @name themeStateFromString
 * @description Coverts string to ThemeState
 * @param text
 * @returns ThemeState
 */
function themeStateFromString(text: string): ThemeState {
    switch (text) {
        case "dark":
            return ThemeState.DARK;

        case "light":
            return ThemeState.LIGHT;

        case "system":
            return ThemeState.SYSTEM;

        default:
            break;
    }
}

/**
 * @name SwitchOptions
 * @description Options for Switch class
 * @interface
 */
interface SwitchOptions {
    /**
     * Element For change color
     */
    body: HTMLBodyElement;
}

/**
 * @name Switch
 * @description Switch element for switch between themes
 */
export class Switch {
    /**
     * @name themeState
     * @description Current theme color/mode
     */
    private themeState: ThemeState;

    /**
     * @name element
     * @description Switch Element
     */
    private element: Element;

    /**
     * @name options
     * @description Options of Switch
     */
    private options: SwitchOptions;

    /**
     * @class Creates Switch class
     */
    constructor(options: SwitchOptions) {
        // If theme is not set to storage. set default item
        if (!localStorage.getItem("theme"))
            localStorage.setItem("theme", "system");

        this.options = options;

        // Find default State
        this.themeState = themeStateFromString(localStorage.getItem("theme"));
        this.options.body.classList.add(themeStateToString(this.themeState));
        this.element = this.switchElement();
    }

    /**
     * @name changeStateAuto
     * @description Change theme state auto, by reading
     *              Local storage.
     */
    public changeStateAuto(): void {
        let resultSelection: string;
        switch (localStorage.getItem("theme")) {
            case "dark":
                resultSelection = "light";
                break;

            case "light":
                resultSelection = "system";
                break;

            case "system":
                resultSelection = "dark";
                break;

            default:
                break;
        }

        localStorage.setItem("theme", resultSelection);

        this.changeState(themeStateFromString(resultSelection));
    }

    /**
     * @function
     * @name changeState
     * @param state ThemeState , replace current theme
     * @returns void
     */
    public changeState(state: ThemeState): void {
        this.options.body.classList.replace(
            themeStateToString(this.themeState),
            themeStateToString(state)
        );

        this.themeState = state;

        // Change changeState button icon
        clearInnerHTML(this.element, returnSvg(state));
    }

    /**
     * @name switchElement
     * @description Returns Switch element
     */
    private switchElement(): Element {
        // Switch div
        let switchDiv = document.createElement("div");

        switchDiv.innerHTML = returnSvg(this.themeState);
        switchDiv.classList.add("switch-theme-btn");

        return switchDiv;
    }

    /**
     * Returns SwitchElement
     */
    get getElement() {
        return this.element;
    }

    /**
     * Get Theme state
     * See current theme
     */
    get getThemeState() {
        return this.themeState;
    }

    /*
     * Get theme state as stirng
     */
    get getThemeStateAsString() {
        return themeStateToString(this.themeState);
    }
}
