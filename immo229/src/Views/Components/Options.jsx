import React from 'react'
import "../../assets/Css/Options.css"
import { useState } from 'react';
import Location from './Location';
import Vendre from './Vendre';
import Rechercher from './Rechercher';
function Options() {
    const [choix,setChoix]=useState(<Location/>);
  
    const choixSetter=(e)=>{   
        document.querySelectorAll('.boutonChoix').forEach(element => {
            element.classList.remove('active')
           });    
        e.target.classList.add("active")
        switch (e.target.getAttribute('target')) {
            case "location":                
               setChoix(<Location/> )
            break;
            case "vente":
                setChoix(<Vendre/>)
            break;
            case "rechercher":
                setChoix(<Rechercher/>)
            break;
        
            default:
                break;
        }
    }

  return (
    <div className="container-fluid options">
        <div>
            <div className="tete">
                <div target="location" className='boutonChoix active' onClick={choixSetter}>A Louer</div>
                <div target="vente" className='boutonChoix' onClick={choixSetter}>A Vendre</div>
                <div target="rechercher" className='boutonChoix' onClick={choixSetter}>Rechercher</div>
            </div>
            <div className='p-2'>
            {choix}
            </div>
        </div>
    </div>
  )
}

export default Options