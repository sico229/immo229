import React from "react";
import { Outlet } from "react-router-dom";

function Accueil() {
    return <div>
        accueil
        <Outlet/>
        </div>;
}

export default Accueil;
