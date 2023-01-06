import React from 'react'
import ReactDOM from 'react-dom/client'
import { RouterProvider } from 'react-router-dom'
import App from './App'
import 'bootstrap/dist/css/bootstrap.min.css';
import SicoRouter from './Router';
import { ContextProvider } from './assets/Contexts/ContextProvider';

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <ContextProvider>
      <RouterProvider router={SicoRouter}/>
    </ContextProvider>
  </React.StrictMode>,
)
