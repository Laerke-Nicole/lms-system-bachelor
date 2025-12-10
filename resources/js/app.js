import './bootstrap';

// Import Bootstrap JavaScript
import * as bootstrap from 'bootstrap';
import { initMmenu } from './global/mmenu';
import { initPassword } from './password/passwordToggle';

document.addEventListener('DOMContentLoaded', () => {
    initMmenu();
    initPassword();
});
