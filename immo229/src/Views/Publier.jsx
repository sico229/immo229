import {React, useState} from 'react'
import { useStateContext } from '../assets/Contexts/ContextProvider';
import "../assets/Css/Publier.css"
import axiosClient from './../AxiosClient';
import { Modal } from 'react-bootstrap';
import { useNavigate } from 'react-router-dom';

function Publier() {
  const [show,setShow]=useState(false);
  const [ModalMessages,setModalMessages]=useState({
    title:"Annonce Enregistrée",
    body:"Votre annonce a été enregistrée avec succès"
  })
  const [TypeConstructions, setTypeConstruction]=useState(false);
  const [nombrePieces, setNombrePieces]=useState(false);
  const [superficie,setSuperficie]=useState(false);
  const [loyer,setLoyer]=useState(false);
  const [prix,setPrix]=useState(false);
  const [SoumissionBtn,setSoumissionBtn]=useState("btn btn-block btn-center btn-lg btn-success sender");
  const {user}=useStateContext()
  const navigate = useNavigate();

  const handleClose=()=>{
    setShow(false);

  }

  
  

  const [inputs,InputsHandler]=useState({
    typeAnnonce:"Type d'annonce",
    typeConstruction:"Entrée-couché",
    nombrePieces:"",
    superficie:"",
    quartier:"",
    ville:"",
    loyer:"",
    prix:"",
    description:"",
    fileList:""
    
  });
 

  const TypeAnnonceChangeHandler=(e)=>{
    InputsHandler({...inputs,"typeAnnonce":e.target.value})
    
    switch (e.target.value) {
      case "Je mets en location":
        setLoyer(true)
        setPrix(false)
        setTypeConstruction(["Entrée-couché","Chambre-Salon","Appartement vide","Appartement meublé","Boutique","Barragaque","Parcelle Vide","Parcelle Bâtie"]);
        break;
      case "Je mets en vente":
        setLoyer(false)
        setPrix(true)
        setTypeConstruction(["Parcelle Vide","Parcelle Bâtie","Barraque"]);
        break
      case "Je recherche":
        setTypeConstruction(["Entrée-couché","Chambre-Salon","Appartement vide","Appartement meublé","Boutique","Barragaque","Parcelle Vide","Parcelle Bâtie"]);
        break
      case "Type d'annonce":
        setTypeConstruction(false)
        break
    
      default:
        setTypeConstruction(false)
        break;
    }
    
  }

  const typeConstructionChangeHandler=(e)=>{
    
    InputsHandler({...inputs,"typeConstruction":e.target.value})
    
    switch (e.target.value) {
      case "Entrée-couché":
        setNombrePieces(false)
      case "Chambre-Salon":
        setNombrePieces(true)
        break
      case "Appartement vide":
        setNombrePieces(false)
        setNombrePieces(true)
      case "Appartement meublé":
        setNombrePieces(true)
        setNombrePieces(true)
        break
      case "Parcelle Bâtie":
        setNombrePieces(true)
        setSuperficie(true)
      default:
       
        break;
    }
  }

  const inputChangeHandler=(e)=>{
    
    InputsHandler({...inputs,[e.target.name]:e.target.value})
    
  }

  const filesChangeHandler=(e)=>{
    InputsHandler({...inputs,"fileList":e.target.files});
  }

  
  
  const submiter=(e)=>{
    e.preventDefault();
    const bouton=document.querySelector(".sender");            
    const form = new FormData();
    var images = document.querySelector(".imagesI").files;
    form.append("typeAnnonce", inputs.typeAnnonce);
    form.append("typeConstruction", inputs.typeConstruction);
    form.append("quartier", inputs.quartier);
    form.append("ville", inputs.ville);
    form.append("loyer", inputs.loyer);
    form.append("prix", inputs.prix);
    form.append("nbPieces", inputs.nombrePieces);
    form.append("surface", inputs.superficie);
    form.append("user",JSON.parse(user).token)
    form.append("description", inputs.description);
    for (let i = 0; i < images.length; i++) {
      form.append("Image[]", images[i]);
    }
    if(inputs.description!="" && inputs.typeAnnonce!="Type d'annonce" && inputs.ville!="" && inputs.quartier!=""){
      bouton.innerHTML=`   
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <span class="sr-only"> Enregistrement...</span>
    `;
    console.log(inputs)
      axiosClient.post('/Publier',form).then((res)=>{

        const data=res.data;
        bouton.innerHTML="Enregistrer mon annonce";
        if(data.status==200){
          setShow(true);
          InputsHandler({
            typeAnnonce:"Type d'annonce",
            typeConstruction:"",
            nombrePieces:"",
            superficie:"",
            quartier:"",
            ville:"",
            loyer:"",
            prix:"",
            description:"",
            fileList:""
          })
        }else{
          setModalMessages({
            title:"Connexion perdue",
            body:"Votre connexion a été restaurée et vous devez vous reconnecter"
          });
          setShow(true);
          localStorage.removeItem("user");
          localStorage.removeItem("ACCESS_TOKEN");
          navigate("/Login", { replace: true });
  
        }
      })
    }else{
      setModalMessages({
        title:"FORMULAIRE INCOMPLET",
        body:"Le formulaire n'est pas bien rempli. Veuillez furnir toutes les informations pour votre annonce"
      });
      setShow(true);
    }
  }
  

  return (
    <div className="container publier">
      <Modal show={show} onHide={handleClose} >
                    <Modal.Header closeButton>
                    <Modal.Title>{ModalMessages.title}</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>{ModalMessages.body}</Modal.Body>
                    
      </Modal>
      <div className="card col-md-6">
        <div className="card-head"><h4 className='w-100 text-center'>Publication d'Annonce</h4></div>
        <div className="card-body">
          <form action="" onSubmit={submiter} encType="multipart/form-data">
            <div className="row col-md-6 mx-0 my-2">
              <select className="form-select form-select-sm" aria-label=".form-select-sm example" onChange={TypeAnnonceChangeHandler} value={inputs.typeAnnonce}>
                <option>Type d'annonce</option>
                <option>Je mets en location</option>
                <option>Je mets en vente</option>
                <option>Je recherche</option>
              </select>
            </div>
            {
              TypeConstructions&&<div className="row col-md-6 mx-0 my-2">
              <select name='typeConstruction' className="form-select form-select-sm" aria-label=".form-select-sm example" onChange={typeConstructionChangeHandler}  value={inputs.typeConstruction}>
                {
                  TypeConstructions.map((typeconstruction,key)=>{
                    return <option key={key}>{typeconstruction}</option>
                  })
                }
              </select>
            </div>
            }
            {
              nombrePieces&&<div className="row w-100 mx-0 my-2">
              <label htmlFor="pieces">Nombre de pièces</label>
              <input type="text" name="nombrePieces" className='form-control' onChange={inputChangeHandler} value={inputs.nombrePieces} />
            </div>
            }
            {
              superficie&&
              <div className="row w-100 mx-0 my-2">
                <label htmlFor="superficie">Superficie</label>
                <input type="text" name="superficie" className='form-control' onChange={inputChangeHandler} value={inputs.superficie} />
              </div>
            }
            <div className="row w-100">
              <div className="col-6">
                <label htmlFor="quartier">Quartier</label>
                <input type="text" name="quartier" id="quartier" className='form-control' onChange={inputChangeHandler} value={inputs.quartier}/>
              </div>
              <div className="col-6">
                <label htmlFor="ville">Ville</label>
                <input type="text" name="ville" id="ville" className='form-control' onChange={inputChangeHandler} value={inputs.vile} />
              </div>
            </div>
            <div className="row w-100">
              
              <div className="col-6">
                {
                  loyer&&<><label htmlFor="loyer">Loyer</label>
                  <input type="number" name="loyer" id="loyer" className='form-control' onChange={inputChangeHandler} value={inputs.loyer} /></>
                }
                {
                  prix&&<><label htmlFor="loyer">Prix</label>
                  <input type="number" name="prix" id="loyer" className='form-control' onChange={inputChangeHandler} value={inputs.prix} /></>
                }
              </div>
            </div>
            <div className="mb-3 my-3">
              <label htmlFor="formFileMultiple" className="form-label">Photos</label>
              <input className="form-control imagesI" type="file" name="photos[]" id="formFileMultiple" multiple onChange={filesChangeHandler}/>
            </div>
            <div className="row w-100 my-5">
              <label htmlFor="description">Description</label>
              <textarea name="description"  cols="30" rows="10" className='form-control' onChange={inputChangeHandler} value={inputs.description}></textarea>
            </div>
            <div className="row w-100 my-2">
              <button className={SoumissionBtn} onClick={submiter}>Enregistrer mon annonce</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  )
}

export default Publier