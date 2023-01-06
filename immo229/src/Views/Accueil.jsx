import React from 'react'
import { useState, useEffect } from 'react';
import Loader from './Layouts/Inc/Loader';
import axiosClient from './../AxiosClient';
import "../assets/Css/Accueil.css";
import CardAnnonce from './Components/CardAnnonce';
import Options from './Components/Options';
import "../assets/Css/CardAnnonce.css";
function Accueil() {
  const [annonces,setAnnonces]=useState(null);
  useEffect(()=>{
    axiosClient.get('/Annonces').then((e)=>{
      if(e.status==200){
        console.log(e.data[0].images[0].url)
        setAnnonces(e.data)
               
      }
    })
  },[]);

  return (
    
      annonces? 
      <>
      <Options/>
      <div className="accueilContainer">
        <div className="mainContainer">
            
              {
                annonces.map((annonce,key)=>{
                  return (
                    <CardAnnonce key={key} annonce={annonce}/>
                  )
                })
              }
            
        </div>
        <div className="sideBar">Side</div>
      </div>
      </>
       : 
      <Loader/>
    
  )
}

export default Accueil