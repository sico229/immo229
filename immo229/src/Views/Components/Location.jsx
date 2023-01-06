import React from 'react'

function Location() {
  return (
    <div>
      <h5>Location</h5>
      <p>Vous recherchez un bien immobilier precis? Nous vous aiderons à vite le retrouver</p>
      <div className="form-group d-flex justify-content-between">
        <select className='form-control'>
          <option >Type de construction</option>
        </select>
        <input type="text" name="quartier" className='form-control' placeholder='quartier' />
        <input type="number" name="budget" className='form-control' placeholder='loyer maxi' />
      </div>
      <div className="my-3 w-100 d-flex justify-content-center">
        <button className="btn btn-block btn-center btn-success w-50">Rechercher</button>
      </div>
    </div>
  )
}

export default Location