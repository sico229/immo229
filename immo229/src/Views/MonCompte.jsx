import {React,useEffect,useState} from 'react'
import { useStateContext } from '../assets/Contexts/ContextProvider';
import axiosClient from './../AxiosClient';
import Loader from './Layouts/Inc/Loader';
import * as Icon from 'react-bootstrap-icons';
import "../assets/Css/MyAccount.css";
import MesAnnonces from './Components/MesAnnonces';
import { Outlet } from 'react-router-dom';
import MesMessages from './Components/MesMessages';
import MonProfil from './Components/MonProfil';

function MonCompte() {
  const {setUser,setToken,_setUser,user}=useStateContext()
  const [loader,setLoader]=useState(false);
  const [data,setData]=useState({})
  const [sections,setSections]=useState()
  const [messages,setMessages]=useState([]);
  
  const sectionSetter=(e)=>{
    const v=e.target.getAttribute('target')
    switch (v) {
      case "MonProfil":
        setSections(<MonProfil/>)
        break;
      case "MesAnnonces":
        setSections(<MesAnnonces annonc={data.annonces}/>)
        break;
      case "MesMessages":
        setSections(<MesMessages messages={data.messages} />)
        break;
    
      default:
        break;
    }
  }
  useEffect(()=>{
    axiosClient.get('/UserStats/'+JSON.parse(user).id).then((retour)=>{
    if(retour.data.data.messages){
      setMessages(retour.data.data.messages)
    }
    setData(retour.data.data)
    setLoader(true);
    })
  },[])

  const [section,setSection]=useState(null)
  return (
    loader? <div className="container-fluid MonCompte">
    <div className="lateral">
    
        <ul>
        <li target="MesAnnonces" onClick={sectionSetter}><span target="MesAnnonces"><Icon.FileEarmarkTextFill /></span><span target="MesAnnonces" className='sm-disabled'>Mes Annonces</span></li>
          <li target="MonProfil" onClick={sectionSetter}><span target="MonProfil" ><Icon.PersonLinesFill /></span><span target="MonProfil"  className='sm-disabled'>Mon Profil</span></li>          
          <li target="MesMessages" onClick={sectionSetter}><span target="MesMessages"><Icon.EnvelopeAtFill /></span><span target="MesMessages" className='sm-disabled'>Mes Messages</span><sup>{messages.length}</sup></li>
        </ul>
    </div>
    <div className="main">
      <Outlet/>
      {sections}
    </div>
</div>:<Loader/>
   
  )
}

export default MonCompte