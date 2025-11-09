import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import SimpleIndiaMap from './Components/SimpleIndiaMap';

// Add CSS for the loading spinner
const style = document.createElement('style');
style.textContent = `
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
`;
document.head.appendChild(style);

// Initialize React when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Check for map container
    const mapContainer = document.getElementById('india-map-container');
    if (mapContainer) {
        const root = createRoot(mapContainer);
        root.render(
            <React.StrictMode>
                <SimpleIndiaMap />
            </React.StrictMode>
        );
    }
});

// Initialize Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
