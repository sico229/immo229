import React from 'react'
import { Outlet } from 'react-router-dom'
import Header from './Header';

function DefaultLayout() {
  
    
  
  return (
    <div>
        <Header/>
        <Outlet/>
    </div>
  )
}

export default DefaultLayout