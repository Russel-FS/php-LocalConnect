 
import toggleComponent from './components/toggle.js';

document.addEventListener('alpine:init', () => { 
    Alpine.data('toggleComponent', toggleComponent);
}); 