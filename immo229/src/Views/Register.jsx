import React from 'react'
import { useState } from 'react';

import axiosClient from './../AxiosClient';
import { Modal } from 'react-bootstrap';
import { Navigate, useNavigate } from 'react-router-dom';
import { useStateContext } from '../assets/Contexts/ContextProvider';



function Register() {
  const [inputs, setInputs]=useState({
    nom:"",
    prenom:"",
    telephone:"",
    email:"",
    password:"",
    password_confirmation:""
  });
  const {setUser,setToken,_setUser}=useStateContext()
  const [show, setShow]=useState(false);
  const [retourmessage,setRetourmessage]=useState(null);
  const [ModalMessages, setModalMessages]=useState({
    "title":"Vous êtes enregistré",
    "body":<p>Votre compte a été créé avec succès et vous pouvez à présent publier gratuitement vos annonces immobilières</p>
  });

  const inputChangeandler=(e)=>{
    e.persist();
    setInputs({...inputs,[e.target.name]: e.target.value});
  }
  const navigate = useNavigate();

  function validatePhoneNumber(phoneNumber) {
    var phoneRegex = /^(20|21|22|23|50|51|52|53|54|55|56|57|58|59|60|61|62|63|64|65|66|67|68|69|90|91|92|93|94|95|96|97|98|99)\d{6}$/;
    return phoneRegex.test(phoneNumber);
  }

  const SaveForm=(e)=>{
    e.preventDefault();
    const loading=`<span class="spinner-border text-warning  spinner-border-sm" role="status" aria-hidden="true"></span>
    <span class="sr-only"> Création de compte...</span>`
    document.querySelector('.validator').innerHTML=loading
    axiosClient.post('/Register',inputs).then((res)=>{
      const data=res.data;
      console.log(data.status)
      if(data.status==200){
        const btn=document.querySelector('.validator')
        btn.classList.add('btn-disabled');
        btn.innerHTML="S'inscrire";       
       setToken(data.token);               
       _setUser(JSON.stringify(data.user));
       setTimeout(() => {        
        setModalMessages({
          'title':"Compte créé",
          "body":"Votre compte a été créé avec succès. Vous pouvez à présent publier gfratuitement vos annonces immobilirères sur immoZ229.com"
        })
        setShow(true);
        setRetourmessage(null);
        setInputs({
          nom:"",
          prenom:"",
          telephone:"",
          email:"",
          password:"",
          password_confirmation:""
        });
        navigate("/Publier", { replace: true });
       }, 2000);
      }else{
        setModalMessages({
          'title':"Formulaire invalide",
          "body":"Des informations sont erronées ou manquent."
        })
        const btn=document.querySelector('.validator')
        btn.classList.remove('btn-disabled');
        btn.innerHTML="S'inscrire";
        setShow(true);
         setRetourmessage(Object.values(data.messages));
      }
  })
  }



  const handleClose=()=>{
    setShow(false);
  }
  
  const numeroInputChangeandler=(e)=>{
    e.persist();
    setInputs({...inputs,telephone: e.target.value});
    
    if(!validatePhoneNumber(e.target.value)){
      e.target.style.color = 'red';
    }else{
      e.target.style.color="#212529"
    }
  }
  
  return (
    <div className="container RegisterContainer d-flex justify-content-center">
      <Modal show={show} onHide={handleClose} >
          <Modal.Header closeButton>
          <Modal.Title>{ModalMessages.title}</Modal.Title>
          </Modal.Header>
          <Modal.Body>{ModalMessages.body}</Modal.Body>                    
      </Modal>
      <form action="" className='col-md-6 my-5'>
          <div className="card p-2">
            {
          
              retourmessage&&              
              <div className="alert alert-danger">
                <h5>Oupp! Vous n'avez pas bien rempli le formulaire. Veuillez réessayer</h5>
                  <ul>
                  {retourmessage.map((ret,key)=>{
                    return <li key={key}>{ret}</li>
                  })}
                  </ul>
              </div>
            }
            <div className="cardHeader">
              <h2 className='w-100 text-center'>Création de compte</h2>
              <h6>Pour pouvoir publier vos annonces immobilières, veuillez vous inscrire</h6>
            </div>
            <div className="cardbody">
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="nom">Votre nom</label>
                  <input type="text" name="nom" className="form-control" onChange={inputChangeandler} value={inputs.nom} />
                </div>
                <div className="col-md-6">
                  <label htmlFor="nom">Votre Prénom</label>
                  <input type="text" name="prenom" className="form-control" onChange={inputChangeandler}  value={inputs.prenom}/>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="telephone">Votre N° de téléphone</label>
                  <input type="telephone" name="telephone" id="" className="form-control" onChange={numeroInputChangeandler}  value={inputs.telephone} />
                  
                </div>
                <div className="col-md-6">
                  <label htmlFor="email">Votre email</label>
                  <input type="email" name="email" className="form-control" onChange={inputChangeandler}  value={inputs.email} />
                </div>
              </div>
              <div className="row">
                <div className="col-md-8 my-3">
                  <label htmlFor="password">Définissez un mot de passe</label>
                  <input type="password" name="password"  className="form-control" onChange={inputChangeandler}  value={inputs.password} />
                </div>
                <div className="col-md-8">
                  <label htmlFor="password2">Veuillez confirmer votre mot de passe</label>
                  <input type="password" name="password_confirmation" className="form-control" onChange={inputChangeandler}  value={inputs.password2} />
                </div>
              </div>
              <div className="row container my-5">
                <button className="btn btn-block btn-center btn-success validator" onClick={SaveForm}>S'inscrire</button>
              </div>
            </div>
          </div>
          
      </form>
    </div>
  )
}

export default Register