import React from 'react';
import Accordion from 'react-bootstrap/Accordion';
import { useState } from 'react';

function MesMessages(props) {
  const [messages,setMessages]=useState([]);

  return (
    <div className="container pt-5">
      <h4>Vos Messages</h4>
      {props.messages.length?
      <Accordion>
        {
          props.messages.map((message,key)=>{
            return (
              message&&<Accordion.Item eventKey={key} key={key}>
              <Accordion.Header>{new Date(message.created_at).toLocaleString('fr-FR')}</Accordion.Header>
              <Accordion.Body>
                  <p><strong>Envoyé par: </strong> {message.sender}</p>
                  <p>Contenu: </p>
                  <p>{message.content}</p>
              </Accordion.Body>
            </Accordion.Item>
            )
          })
        }
     
      
    </Accordion>
      :<div className='alert alert-danger'>Vous n'avez aucun message actuellement</div>}
    </div>
  )
}

export default MesMessages