/**
 * Switch module for handle Switch Themes
 * @version 0.0.1
 * @author The resadev team
 */

const themes = { DARK: "dark", LIGHT: "light", SYSTEM: "system" };

/**
 * @name Switch
 * @description Handles Themes
 */
export class Switch {
    /**
     * @name state
     * @description State of theme
     */
    state = themes.SYSTEM;

    /**
     * @name element
     * @description Element for apply theme
     * @type Element
     */
    element;
    
    /**
     * @class
     * @param {Element} element for apply theme
     * @returns Switch
     */
    constructor({ element }) {
        // When class created
        this.element = element;

        if (!window.localStorage.getItem("theme"))
            window.localStorage.setItem("theme", themes.SYSTEM);

        element.classList.add(window.localStorage.getItem("theme"))
    }

    set state(theme) {
        this.state = theme;
    }
    
    /**
     * @name autoChangeState
     * @description Change state of theme auto
     */
    autoChangeTheme() {
        const { LIGHT, DARK, SYSTEM } = themes;

        switch (this.state) {
            case DARK:
                this.changeTheme(LIGHT);
                break;
            
            case LIGHT:
                this.changeTheme(SYSTEM);
                break;

            case SYSTEM:
                this.changeTheme(DARK);
                break;

            default:
                break;
        }
    }

    /**
     * @name changeTheme
     * @param state Next state
     */
    changeTheme(state) {
        // Select element and replace theme class to next theme
        this.element.classList.replace(this.state, state);
        window.localStorage.setItem('theme', state);
        this.state = state;
    }
}