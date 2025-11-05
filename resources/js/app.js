import '../scss/app.scss';
import './bootstrap';

// Import Bootstrap JavaScript
import * as bootstrap from 'bootstrap';
import { initMmenu } from './global/mmenu';

document.addEventListener('DOMContentLoaded', () => {
    initMmenu();
});
