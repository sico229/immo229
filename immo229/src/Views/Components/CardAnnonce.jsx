import React from 'react'
import * as Icon from 'react-bootstrap-icons';
import { Navigate, redirect, useNavigate } from 'react-router-dom';
function CardAnnonce(props) {
  let navigate = useNavigate();
  const routeChange = () => {
    let path = `/Details/`+props.annonce.id;
    navigate(path);
  };
  
  return (
    <div className="card shadow-sm" onClick={routeChange}>
                  <div className={props.annonce.typeAnnonce+' typeAnnonce'} >{props.annonce.typeAnnonce}</div>
                    {
                      props.annonce.images[0]?
                      <img src={props.annonce.images[0].url} alt={props.annonce.images[0].url} className='bd-placeholder-img card-img-top' />
                      :
                      <img src="" alt="" className='bd-placeholder-img card-img-top' />
                    }
                  
      
                  <div className="card-body">
                  <p className="card-text text-success">{props.annonce.typeConstruction}</p>
                    <p className="card-text">{props.annonce.description}</p>                    
                    <p className="card-text"><strong>{props.annonce.ville} {props.annonce.quartier}</strong></p>
                    {
                      props.annonce.typeAnnonce=="Location"?
                      <p className="card-text">Loyer: <strong>{props.annonce.prix}F/Mois</strong></p>
                      :
                      <p className="card-text">Prix: <strong>{props.annonce.prix}F</strong></p>
                    }
                    
                    <div>
                    
                    <Icon.PersonFill/> {props.annonce.user.nom}
                    </div>
                    <div className='d-flex justify-content-between'>
                    
                    <span><Icon.HandThumbsUpFill/>{props.annonce.likes }</span>
                      <small className=""> <Icon.CalendarDateFill/>{props.annonce.datePublication}</small>
                    </div>
                  </div>
                  </div>
  )
}

export default CardAnnonce