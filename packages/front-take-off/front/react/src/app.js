import App from "./App";
import React from 'react';
import {createRoot} from 'react-dom/client';

jQuery(function () {
    const root = document.getElementById('app');

    if(root){
        createRoot(root).render(<App />);
    }
});
