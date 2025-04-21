import './bootstrap';

import Alpine from 'alpinejs';
import.meta.glob([
    '../assets/img/**',
    '../assets/fonts/**',
]);
window.Alpine = Alpine;

Alpine.start();
