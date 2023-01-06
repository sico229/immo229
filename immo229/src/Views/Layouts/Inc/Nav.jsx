import React from 'react'
import { Link, Route, useNavigate } from 'react-router-dom'
import * as Icon from 'react-bootstrap-icons';
import { useStateContext } from '../../../assets/Contexts/ContextProvider';
import {Modal, Button} from 'react-bootstrap';
import { useState, useRef } from 'react';
import axiosClient from './../../../AxiosClient';


function Nav() {
    const {user,token}=useStateContext()
    const [show,setShow]=useState(false);
    const [close,setClose]=useState(false);
    const [retourModal,setRetourModal]=useState(null);
    const [retour,setRetour]=useState(null);
    const navigate = useNavigate();
    const handleClose=()=>{
        setShow(false);
    }
    const [credentials,setCredentials]=useState({
        username:"",
        password:""
    })

   
    const PublierAnnonce=()=>{       
            setShow(true);
        
    }

    const {setUser,setToken,_setUser}=useStateContext()

    const NavLoginHandler=(e)=>{
        e.preventDefault()
        const bouton=e.target;
        bouton.innerHTML=`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="sr-only">Connexion...</span>
        `;
        axiosClient.post('/Login',credentials).then((data)=>{ 
            const bouton=document.querySelector('.NavLogger');
            bouton.innerHTML="Se Connecter";
            
            if(data.data.status===200){               
                setToken(data.data.token);               
                _setUser(JSON.stringify(data.data.user));
                setShow(false);
                navigate("/Publier", { replace: true });
            }else{
                
                setRetourModal(data.data.message);
            }        
           
        }).catch(err=>{
            const response=err.response;
            if(response && response.status===422){
                console.log(response.data)
            }
        })

    }

    const CredentialInputHandler=(e)=>{
        e.persist();
        setCredentials({ ...credentials, [e.target.name]: e.target.value });
    }

    const NavLogout=()=>{
        
        axiosClient.post('/Logout',{
            "email":JSON.parse(user).email,
            "token":token
        }).then((e)=>{
            setToken(null);
            setUser(null);
            localStorage.removeItem("user");
            localStorage.removeItem("token");
            alert('Vous êtes déconnecté avec succès');
         
        })
    }

 
    
  return (
    <nav>
        {
            user?<Link to="/Publier" className='btn btn-rounded PublierBtn' >Publier Une Annonce</Link>:<Link to="" className='btn btn-rounded PublierBtn' onClick={PublierAnnonce}>Publier Une Annonce</Link>
        }
        <div>
            
            {
                !user?
                <>                
                <button className="btn btn-rounded" onClick={()=>{return setShow(true)}}><Icon.LockFill />Se Connecter</button>
                <Link to="/Enregistrement" className="btn btn-rounded"> <Icon.PersonFill />Créer Compte</Link>
                <Modal show={show} onHide={handleClose} >
                    <Modal.Header closeButton>
                    <Modal.Title>Vous devez vous connecter d'abord</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <div className='retourModals'>
                            {
                                retourModal&&<div className="alert alert-danger">{retourModal}</div>
                            }
                        </div>
                        <form action="" >
                            <div className="form-group">
                                <label htmlFor="">Votre N° de téléphone ou votre email</label>
                                <input type="email" name="username" className='form-control' value={credentials.username} onChange={CredentialInputHandler} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Votre mot de passe</label>
                                <input type="password" name="password" className='form-control'value={credentials.password} onChange={CredentialInputHandler} />
                            </div>
                        </form>
                    </Modal.Body>
                    <Modal.Footer>
                    <p>Vous n'avez pas de compte? <Link to="/Enregistrement" onClick={()=>{setShow(false)}}>Cliquez ici pour en créer un</Link></p>
                    <Button className='NavLogger' variant="primary" onClick={NavLoginHandler} >
                        Se Connecter
                    </Button>
                    </Modal.Footer>
                </Modal>
                </>
                :<>
                <Link to="/MonCompte" className="btn btn-rounded" title='Cliquez ici pour accéder à votre compte'>{JSON.parse(user).nom}</Link>
                
                <button className="btn btn-rounded headerLogger btn-danger text-light" onClick={NavLogout}> <Icon.BoxArrowRight />Se Déconnecter</button>
                </>
            }
            
            
                     
        </div>
    </nav>
  )
}

export default Nav