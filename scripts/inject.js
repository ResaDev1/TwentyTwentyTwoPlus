/**
 * This script will injected to wordpress site
 * @version 0.0.1
 * @author The resadev team
 */

import { Switch } from "../blocks/switch/src/switch";

/**
 * @description New Switch object
 */
const sw = (elem) => new Switch({ element: elem });

/**
 * @function
 * @name changeState
 * @returns void changes state
 */
const changeState = (swi) => swi.autoChangeTheme();

/**
 * @function
 * @name btn
 */
const btn = (swit) => document.getElementById("switch-btn").addEventListener('click', () => changeState(swit));

/**
 * This function runst when script enjected
 */
const main = () => {
    const element = document.querySelector('body');
    let swit = sw(element);
    btn(swit);
};

window.addEventListener('DOMContentLoaded', main);