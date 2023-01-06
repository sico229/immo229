import {createBrowserRouter} from "react-router-dom";
import Accueil from './Views/Accueil';
import Publier from './Views/Publier';
import Register from './Views/Register';
import NotFound from './Views/NotFound';
import DefaultLayout from "./Views/Layouts/DefaultLayout";
import AuthLayout from "./Views/Layouts/AuthLayout";
import MonCompte from './Views/MonCompte';
import Details from './Views/Details';
import MesAnnonces from "./Views/Components/MesMessages";
import MesMessages from "./Views/Components/MesMessages";
import EditAnnonce from './Views/Components/EditAnnonce';
const SicoRouter=createBrowserRouter([
    {
        path:"/",
        element:<DefaultLayout/>,
        children:[
            {
                path:"/",
                element:<Accueil/>
            },
            {
                path:"/Enregistrement",
                element:<Register/>
            }
            
            
        ]
    },
    {
        path:"/",
        element:<AuthLayout/>,
        children:[
            {
                path:"/Publier",
                element:<Publier/>
            },
            {
                path:"/MonCompte",
                element:<MonCompte/>,
                children:[
                    {
                        path:"/MonCompte/MesAnnonces",
                        element:<MesAnnonces/>
                    },
                    {
                        path:"/MonCompte/MonProfil",
                        element:<MonCompte/>
                    },
                    {
                        path:"/MonCompte/MesMessages",
                        element:<MesMessages/>
                    },
                    {
                        path:"/MonCompte/Edit/:numeroAnnonce",
                        element:<EditAnnonce/>
                    },
                ]
                
            },
            
        ]
    },

    {
        path:"/Details",
        element:<DefaultLayout/>,
        children:[
           {
            path:"/Details/:id",
            element:<Details/>
           }
        ]
    },    
 
    {
        path:"*",
        element:<NotFound/>
    }

])
export default SicoRouter;