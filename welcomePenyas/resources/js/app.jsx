import './bootstrap';

import React from "react"
import ReactDOM from 'react-dom/client';        

// Elimina la importación del componente Alert
// import Alert from './components/Alert';

ReactDOM.createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        {alert('Preparate Jordi, voy a obtener la libertad por fin, junto a ti llegaré a ello, no pienso decepcionar a nadie aquí presente, al que menos a mi mismo.')}
    </React.StrictMode>
);