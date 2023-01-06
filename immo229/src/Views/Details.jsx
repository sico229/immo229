import React from 'react'
import { useState, useEffect } from 'react';
import { useParams, Navigate, Form } from 'react-router-dom';
import axiosClient from './../AxiosClient';
import Loader from './Layouts/Inc/Loader';
import "../assets/Css/Details.css";
import Slider from "react-slick";
import CardAnnonce from './Components/CardAnnonce';
import { Modal, Button } from 'react-bootstrap';
function Details(props) {
  const [annonce,setAnnonce]=useState();
  const [loader,setLoader]=useState(true);
  const [similaires,setSimilaires]=useState();
  const [similaires2,setSimilaires2]=useState();
  const params=useParams()
  const [show,setShow]=useState(false);
  const [retourmessage,setRetourmessage]=useState(false);
  
  const [emailVisiteur,setemailVisiteur]=useState("")
  const [contenuMessage,setcontenuMessage]=useState("")
  var settings = {
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay:true,
    focusOnSelect:true,
    responsive:[ { breakpoint: 768, settings: { slidesToShow: 1 } } ]
  };
  useEffect(()=>{
    axiosClient.get('/Details/'+params.id).then((e)=>{
      setLoader(false)
      if(e.data.status==200){
        setAnnonce(e.data.annonce);
        setSimilaires(e.data.similaires)
        setSimilaires2(e.data.similaire2)
      }else{
        <Navigate to="/"/>
      }
    })

  },[])

  const appercu=(e)=>{
   
     document.querySelector('.MainView').setAttribute('src',e.target.getAttribute("src"))
  }

  const massageEmailHandler=(e)=>{  
    setemailVisiteur(e.target.value)
  }
  const massageInputHandler=(e)=>{  
    setcontenuMessage(e.target.value)
  }

  const message=()=>{
    setShow(true)
  }

  const SendMessageHandler=(e)=>{
    e.preventDefault();
    const encours=`<span class="spinner-border text-warning  spinner-border-sm" role="status" aria-hidden="true"></span>
    <span class="sr-only"> Envoi en cours...</span>`;
      e.target.innerHTML=encours;
    const data={email:emailVisiteur,message:contenuMessage,annonce:annonce.id}
    axiosClient.post('/Message',data).then((res)=>{
      setemailVisiteur("");
      setcontenuMessage("");

      if(res.data.status==200){
        document.querySelector('.envoyeur').classList.add("d-none")
        setRetourmessage(res.data.message)
        setTimeout(()=>{
  setShow(false);
  setRetourmessage(null)
        },5000)
      }
      

    })
  }
  
  const handleClose=()=>{
    setShow(false)
  }
 
  return (
    
    
      loader?<Loader/>:

      
      annonce?
      <div className="container Detail">
        <Modal show={show} onHide={handleClose}>
        <Modal.Header closeButton>
          <Modal.Title>Envoyer un message à l'annonceur</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {
            retourmessage&&<div className="alert alert-success">{retourmessage}</div>
          }
          <form action="">
            <input type="text" value={emailVisiteur} onChange={massageEmailHandler} name="senderEmail" placeholder='Votre N° de téléphone ou votre email' className='form-control' />
            <div className="form-group my-5">
              <textarea  value={contenuMessage} onChange={massageInputHandler} name="contenu"  cols="30" rows="10" placeholder='Votre message ici'className='form-control'></textarea>
            </div>
          </form>
        </Modal.Body>
        <Modal.Footer>
          <button className='btn btn-sm btn-warning' onClick={handleClose}>
            Annuler
          </button>
          <button className='btn btn-sm btn-success envoyeur' onClick={SendMessageHandler}>
                    Envoyer
          </button>
        </Modal.Footer>
      </Modal>
          <div className="row">
            <div className="col-md-6 image">
              <img src={annonce.images[0].url} alt="" className='MainView img img-fluid' />
             <div className="mini">
              {
                annonce.images.map((image,key)=>{return <img key={key} src={image.url} onMouseEnter={appercu} alt="" className="img w-100" />})
              }
             </div>
            </div>
            <div className="col-md-6 py-2 px-2">
              <p><strong>{annonce.typeAnnonce}</strong></p>
              <p>{annonce.description}</p>
              <p>{annonce.ville} - {annonce.quartier}</p>
              
                {
                  annonce.typeAnnonce="Location"
                  ?
                  <p>Loyer - {annonce.prix}F/mois</p>
                  :
                  <p>Loyer - {annonce.prix}</p>
                }
                <div>
                  Annonceur: {annonce.user.nom} {annonce.user.prenom} - Tel: {annonce.user.telephone}
                </div>
              <div><button className="btn btn-success" onClick={message}>Envoyer un message à l'annonceur</button></div>
            </div>
            
          </div>
          <div className="similaires">
          <h3>Annonces Similaires</h3>
          

          <Slider {...settings}>
                {
                  similaires.map((similaire,key)=>{
                    return <CardAnnonce key={key} annonce={similaire}/>

                  })

                  
                }
                {
                  similaires2.map((similaire,key)=>{
                    return <CardAnnonce annonce={similaire}/>

                  })

                  
                }
          
          </Slider>
          
          </div>
      </div>
      :
      <>Annonce Indisponible</>
    
  )
}

export default Details