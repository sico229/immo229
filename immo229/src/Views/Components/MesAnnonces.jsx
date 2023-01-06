import React from 'react';
import * as Icon from 'react-bootstrap-icons';
import { useState } from 'react';
import { Link } from 'react-router-dom';

function MesAnnonces(props) {
 const [an,setAn]=useState([]);
if(props.annonc.length){
  
}
  
  return (
    <div className='container pt-5'>
      <h4>Vos Annonces</h4>
       {props.annonc?<><table className="table table-responsive table-striped table-hover">
        <thead className='table-dark'>
          <tr className='text-center'>
            <th>N°</th>
            <th>Date de Publication</th>
            <th>Type d'annonce</th>
            <th>Quartier</th>
            <th>Loyer</th>
            <th>Description</th>
            <th>Nbrs de Likes</th>
            <th colSpan={2}>Actions</th>
          </tr>
        </thead>
        <tbody>
          {
            props.annonc.reverse().map((annonce,key)=>{
              return(
                <tr className='text-center' key={key}>
                <td>{annonce.id}</td>
                <td>{annonce.datePublication}</td>
                <td>{annonce.typeAnnonce}</td>
                <td>{annonce.quartier}</td>
                <td>{annonce.loyer}</td>
                <td title={annonce.description}>{annonce.description.substr(0,15)}...</td>
                <td>{annonce.likes}</td>
                <td><button className="btn btn-sm btn-danger"  title='Cliquez ici pour supprimer cette annonce'><Icon.Trash3Fill  color="white"/></button></td>
                <td><Link to={"Edit/"+annonce.numeroAnnonce} className="btn btn-sm btn-info"><Icon.FileEarmarkTextFill color="white"  title='Cliquez ici pour modifier cette annonce'/></Link></td>
              </tr>
              )
            })
          }
        </tbody>
      </table></>:<div className='alert alert-danger'>Vous n'avez pas d'annonces en ligne</div>}
    </div>
  )
}

export default MesAnnonces